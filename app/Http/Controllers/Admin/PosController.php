<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\AccountCode;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\Customer;
use App\Exports\PosSessionExport;
use App\GlHeader;
use App\GlLines;
use App\ItemMaster;
use App\Onhand;
use App\PosOrder;
use App\PosOrderLine;
use App\PosPayment;
use App\PosSession;
use App\SalesOrder;
use App\SalesOrderDetail;
use App\Subinventories;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PosController extends Controller
{
    public function index()
    {
        $sessions       = PosSession::with('cashier')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $subinventories = Subinventories::orderBy('sub_inventory_name')->get();
        $anyOpenSession = PosSession::where('status', 'open')->with('cashier')->latest()->first();
        $myOpenSession  = PosSession::where('status', 'open')->where('cashier_id', Auth::id())->latest()->first();

        return view('admin.pos.index', compact('sessions', 'subinventories', 'anyOpenSession', 'myOpenSession'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subinventory_code'=> 'required|string',
        ]);

        $openSession = PosSession::where('status', 'open')->with('cashier')->first();
        if ($openSession) {
            return redirect()->route('admin.pos.index')
                ->with('error', 'Tidak dapat membuka sesi baru. Sesi ' . $openSession->session_number
                    . ' milik ' . ($openSession->cashier->name ?? '-')
                    . ' masih aktif. Harap tutup sesi tersebut terlebih dahulu.');
        }

        $count  = DB::table('bm_pos_sessions')->count() + 1;
        $number = 'POS' . str_pad($count, 5, '0', STR_PAD_LEFT);

        $session = PosSession::create([
            'session_number'   => $number,
            'org_id'           => Auth::user()->org_id ?? null,
            'subinventory_code'=> $request->subinventory_code,
            'cashier_id'       => Auth::id(),
            'opening_cash'     => $request->opening_cash ?? 0,
            'status'           => 'open',
            'opened_at'        => now(),
            'notes'            => $request->notes,
            'created_by'       => Auth::id(),
            'last_updated_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.pos.show', $session->id)
            ->with('success', 'Sesi POS ' . $number . ' berhasil dibuka.');
    }

    public function show($id)
    {
        $session        = PosSession::findOrFail($id);
        $subinventories = Subinventories::orderBy('sub_inventory_name')->get();

        if ($session->status !== 'open') {
            return redirect()->route('admin.pos.index')
                ->with('error', 'Sesi ini sudah ditutup.');
        }

        $sessionExpired = \Carbon\Carbon::parse($session->opened_at)->startOfDay()
            ->lt(\Carbon\Carbon::now()->startOfDay());

        return view('admin.pos.session', compact('session', 'subinventories', 'sessionExpired'));
    }

    public function switchWarehouse(Request $request, $id)
    {
        $request->validate(['subinventory_code' => 'required|string']);

        $session = PosSession::findOrFail($id);

        if ($session->status !== 'open') {
            return response()->json(['success' => false, 'message' => 'Session is closed.'], 422);
        }

        $session->update([
            'subinventory_code' => $request->subinventory_code,
            'last_updated_by'   => Auth::id(),
        ]);

        return response()->json([
            'success'           => true,
            'subinventory_code' => $request->subinventory_code,
        ]);
    }

    public function closeSession(Request $request, $id)
    {
        $session = PosSession::findOrFail($id);

        if ($session->status !== 'open') {
            return redirect()->route('admin.pos.index')
                ->with('error', 'Sesi ini sudah ditutup.');
        }

        // Sesi hanya bisa ditutup setelah berganti hari
        $openedDay = \Carbon\Carbon::parse($session->opened_at)->startOfDay();
        $today     = \Carbon\Carbon::now()->startOfDay();
        if ($openedDay->eq($today)) {
            return redirect()->route('admin.pos.show', $session->id)
                ->with('error', 'Sesi belum dapat ditutup. Sesi dibuka hari ini ('
                    . \Carbon\Carbon::parse($session->opened_at)->format('d M Y')
                    . ') dan hanya dapat ditutup setelah berganti hari.');
        }

        $session->update([
            'closing_cash'    => $request->closing_cash ?? 0,
            'status'          => 'closed',
            'closed_at'       => now(),
            'notes'           => $request->notes,
            'last_updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.pos.report', $session->id)
            ->with('success', 'Sesi POS berhasil ditutup.');
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'session_id'                => 'required|integer',
            'use_ppn'                   => 'sometimes|boolean',
            'discount_amount'           => 'sometimes|numeric|min:0',
            'items'                     => 'required|array|min:1',
            'items.*.inventory_item_id' => 'required|integer',
            'items.*.quantity'          => 'required|numeric|min:0.0001',
            'items.*.unit_price'        => 'required|numeric|min:0',
            'payments'                  => 'required|array|min:1',
            'payments.*.method'         => 'required|in:cash,transfer',
            'payments.*.amount'         => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $session  = PosSession::findOrFail($request->session_id);

            $openedDay = \Carbon\Carbon::parse($session->opened_at)->startOfDay();
            $today     = \Carbon\Carbon::now()->startOfDay();
            if ($openedDay->lt($today)) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please close this session and open a new session.',
                    'expired' => true,
                ], 422);
            }

            $usePPN   = filter_var($request->input('use_ppn', true), FILTER_VALIDATE_BOOLEAN);
            $taxRate  = $usePPN ? 11 : 0;
            $taxMult  = 1 + ($taxRate / 100);

            $grandTotal = 0;
            $grandUntax = 0;
            $grandTax   = 0;

            foreach ($request->items as $item) {
                $lineGross   = ($item['quantity'] * $item['unit_price']) - ($item['discount'] ?? 0);
                $grandTotal += $lineGross;
                $grandUntax += $usePPN ? $lineGross / $taxMult : $lineGross;
            }
            $grandTax      = $grandTotal - $grandUntax;
            $discountAmt   = (float) ($request->input('discount_amount', 0));
            $effectiveTotal = max(0, $grandTotal - $discountAmt);
            $amountPaid    = collect($request->payments)->sum('amount');
            $change        = max(0, $amountPaid - $effectiveTotal);

            // --- POS Order ---
            $posCount   = DB::table('bm_pos_orders')->count() + 1;
            $orderNum   = 'PINV' . str_pad($posCount, 5, '0', STR_PAD_LEFT);

            $posOrder = PosOrder::create([
                'order_number'    => $orderNum,
                'session_id'      => $session->id,
                'cashier_id'      => Auth::id(),
                'customer_id'     => $request->customer_id ?? null,
                'customer_name'   => $request->customer_name ?: 'Walk-in Customer',
                'org_id'          => $session->org_id,
                'order_date'      => now(),
                'subtotal'        => round($grandUntax, 2),
                'tax_amount'      => round($grandTax, 2),
                'total'           => round($grandTotal, 2),
                'amount_paid'     => $amountPaid,
                'change_amount'   => $change,
                'status'          => 'paid',
                'created_by'      => Auth::id(),
            ]);

            // --- POS Lines ---
            foreach ($request->items as $item) {
                $lineGross = ($item['quantity'] * $item['unit_price']) - ($item['discount'] ?? 0);
                $lineUntax = $usePPN ? $lineGross / $taxMult : $lineGross;
                PosOrderLine::create([
                    'pos_order_id'     => $posOrder->id,
                    'inventory_item_id'=> $item['inventory_item_id'],
                    'item_code'        => $item['item_code'] ?? '',
                    'item_description' => $item['item_description'] ?? '',
                    'quantity'         => $item['quantity'],
                    'uom'              => $item['uom'] ?? 'PCS',
                    'unit_price'       => $item['unit_price'],
                    'discount'         => $item['discount'] ?? 0,
                    'tax_rate'         => $taxRate,
                    'subtotal'         => round($lineUntax, 2),
                    'total_line'       => round($lineGross, 2),
                    'created_by'       => Auth::id(),
                ]);
            }

            // --- Payments ---
            foreach ($request->payments as $pay) {
                PosPayment::create([
                    'pos_order_id'     => $posOrder->id,
                    'payment_method'   => $pay['method'],
                    'amount'           => $pay['amount'],
                    'reference_number' => $pay['reference'] ?? null,
                    'created_by'       => Auth::id(),
                ]);
            }

            // --- Sales Order ---
            $soHeaderId = DB::table('bm_order_headers_all')->count() + 1;
            $soCount    = DB::table('bm_order_headers_all')
                ->where('order_number', 'like', 'POSO%')->count() + 1;
            $soNumber   = 'POSO' . str_pad($soCount, 5, '0', STR_PAD_LEFT);

            // customer_id harus integer (FK) — null untuk walk-in
            $custId = $request->customer_id ? (int) $request->customer_id : null;

            $so = SalesOrder::create([
                'header_id'            => $soHeaderId,
                'order_number'         => $soNumber,
                'cust_po_number'       => $orderNum,
                'attribute2'           => 'POS',
                'invoice_to_org_id'    => $custId,
                'deliver_to_org_id'    => $custId,
                'ordered_date'         => now(),
                'total_payment'        => (int) round($grandTotal),
                'total_payment_untax'  => (int) round($grandUntax),
                'open_flag'            => 12,
                'tax_exempt_flag'      => $taxRate,
                'org_id'               => $session->org_id,
                'attribute1'           => 'IDR',
                'attribute3'           => 'POS',
                'inv_number'           => $orderNum,
                'created_by'           => Auth::id(),
                'updated_by'           => Auth::id(),
            ]);

            // --- SO Lines ---
            $lineNum = 1;
            foreach ($request->items as $item) {
                $lineGross = ($item['quantity'] * $item['unit_price']) - ($item['discount'] ?? 0);
                SalesOrderDetail::create([
                    'header_id'              => $soHeaderId,
                    'line_id'                => $lineNum,
                    'line_number'            => $lineNum,
                    'split_line_id'          => $lineNum,
                    'inventory_item_id'      => (int) $item['inventory_item_id'],
                    'user_description_item'  => $item['item_description'] ?? '',
                    'ordered_quantity'       => (float) $item['quantity'],
                    'order_quantity_uom'     => $item['uom'] ?? 'PCS',
                    'unit_selling_price'     => (int) round($item['unit_price']),
                    'disc'                   => (int) round($item['discount'] ?? 0),
                    'unit_percent_base_price'=> (int) round($lineGross),
                    'flow_status_code'       => 12,
                    'fulfilled_quantity'     => (float) $item['quantity'],
                    'org_id'                 => $session->org_id,
                ]);
                $lineNum++;
            }

            // --- Delivery Header (auto-complete) ---
            $latestDeliv = DB::table('bm_wsh_new_deliveries')->latest('delivery_id')->first();
            $delivIdNum  = $latestDeliv ? (intval($latestDeliv->delivery_id) + 1) : 1;
            $delivId     = str_pad($delivIdNum, 4, '0', STR_PAD_LEFT);
            $delivName   = date('ym') . $delivId;

            $delivery = DeliveryHeader::create([
                'delivery_id'      => $delivId,
                'delivery_name'    => $delivName,
                'sold_to_party_id' => $custId,          // integer atau null
                'ship_to_party_id' => $custId,
                'order_number'     => $soNumber,
                'status_code'      => 12,
                'lvl'              => 12,
                'attribute1'       => 'IDR',
                'currency_code'    => 'IDR',
                'organization_id'  => $session->org_id,
                'planned_flag'     => 1,
                'accept_flag'      => 1,
                'accepted_by'      => Auth::id(),
                'accepted_date'    => now(),
                'actual_ship_date' => now(),
                'confirm_date'     => now(),
                'on_or_about_date' => now(),
                'created_by'       => Auth::id(),
            ]);

            // --- Delivery Details ---
            foreach ($request->items as $item) {
                DeliveryDetail::create([
                    'delivery_detail_id'      => $delivId,
                    'source_header_number'    => $soNumber,
                    'source_header_id'        => $soHeaderId,
                    'inventory_item_id'       => (int) $item['inventory_item_id'],
                    'item_description'        => $item['item_description'] ?? '',
                    'requested_quantity'      => (float) $item['quantity'],
                    'requested_quantity_uom'  => $item['uom'] ?? 'PCS',
                    'shipped_quantity'        => (float) $item['quantity'],
                    'delivered_quantity'      => (float) $item['quantity'],
                    'cust_po_number'          => $orderNum,
                    'unit_price'              => (int) round($item['unit_price']),
                    'currency_code'           => 'IDR',
                    'released_status'         => 'C',
                    'created_by'              => Auth::id(),
                ]);
            }

            // --- Stock Deduction from Session Subinventory ---
            $subCode = $session->subinventory_code;
            if ($subCode) {
                foreach ($request->items as $item) {
                    $onhand = Onhand::where('inventory_item_id', (int) $item['inventory_item_id'])
                        ->where('subinventory_code', $subCode)
                        ->first();
                    if ($onhand) {
                        $onhand->primary_transaction_quantity =
                            (float) $onhand->primary_transaction_quantity - (float) $item['quantity'];
                        $onhand->save();
                    }
                    // If no onhand record exists, skip silently — allow POS to proceed
                }
            }

            // --- GL Journal Entry ---
            try {
                $lastGl  = DB::table('bm_gl_je_headers')->latest('id')->first();
                $glId    = $lastGl ? ($lastGl->id + 1) : 1;
                $period  = now()->format('M y');
                $effDate = now()->format('Y-m-d');

                $cashAcc = AccountCode::where('account_code', '1101')->value('account_code') ?? '1101';
                $revAcc  = AccountCode::where('account_code', '6100')->value('account_code') ?? '6100';
                $ppnAcc  = AccountCode::where('account_code', '3202')->value('account_code') ?? '3202';
                $discAcc = AccountCode::where('account_code', '5100')->value('account_code') ?? '5100';

                $glLabel = $usePPN ? 'POS+PPN' : 'POS-NonPPN';
                // DR total = effectiveTotal + discountAmt = grandTotal; CR total = grandTotal ✓
                GlHeader::create([
                    'je_header_id'          => $glId,
                    'je_source'             => $glLabel . $orderNum,
                    'je_category'           => 'POS',
                    'external_reference'    => $orderNum,
                    'name'                  => 'POS - ' . ($request->customer_name ?: 'Walk-in') . ($usePPN ? '' : ' (Non-PPN)'),
                    'currency_code'         => 'IDR',
                    'default_effective_date'=> $effDate,
                    'period_name'           => $period,
                    'status'                => 1,
                    'running_total_dr'      => (int) round($grandTotal),
                    'running_total_cr'      => (int) round($grandTotal),
                    'created_by'            => Auth::id(),
                    'last_updated_by'       => Auth::id(),
                ]);

                if ($usePPN) {
                    $glLines = [
                        [1, $cashAcc, (int) round($effectiveTotal), 0,                       'POS Kas - '          . $orderNum],
                        [2, $revAcc,  0,                            (int) round($grandUntax), 'POS Penjualan DPP - '. $orderNum],
                        [3, $ppnAcc,  0,                            (int) round($grandTax),   'POS PPN Keluaran - ' . $orderNum],
                    ];
                    if ($discountAmt > 0) {
                        $glLines[] = [4, $discAcc, (int) round($discountAmt), 0, 'POS Diskon - ' . $orderNum];
                    }
                } else {
                    $glLines = [
                        [1, $cashAcc, (int) round($effectiveTotal), 0,                       'POS Kas (Non-PPN) - '      . $orderNum],
                        [2, $revAcc,  0,                            (int) round($grandTotal), 'POS Penjualan (Non-PPN) - '. $orderNum],
                    ];
                    if ($discountAmt > 0) {
                        $glLines[] = [3, $discAcc, (int) round($discountAmt), 0, 'POS Diskon - ' . $orderNum];
                    }
                }

                foreach ($glLines as [$lineNum, $accCode, $dr, $cr, $desc]) {
                    GlLines::create([
                        'je_header_id'       => $glId,
                        'je_line_num'        => $lineNum,
                        'code_combination_id'=> $accCode,
                        'period_name'        => $period,
                        'effective_date'     => $effDate,
                        'status'             => 1,
                        'entered_dr'         => $dr,
                        'entered_cr'         => $cr,
                        'accounted_dr'       => $dr,
                        'accounted_cr'       => $cr,
                        'description'        => $desc,
                        'currency_code'      => 'IDR',
                        'created_by'         => Auth::id(),
                        'last_updated_by'    => Auth::id(),
                    ]);
                }
            } catch (\Throwable $glEx) {
                \Log::warning('POS GL creation failed: ' . $glEx->getMessage());
            }

            // --- Update PosOrder with references ---
            $posOrder->update([
                'so_number'      => $soNumber,
                'so_id'          => $so->id,
                'invoice_number' => $orderNum,
                'delivery_number'=> $delivName,
                'delivery_id'    => $delivery->id,
            ]);

            DB::commit();

            return response()->json([
                'success'      => true,
                'order_number' => $orderNum,
                'so_number'    => $soNumber,
                'total'        => round($grandTotal, 2),
                'change'       => $change,
                'message'      => 'Transaksi berhasil!',
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getItems(Request $request)
    {
        $sessionId = $request->get('session_id');

        // Resolve subinventory from session (one query, cached by session)
        $subCode = $sessionId
            ? PosSession::where('id', $sessionId)->value('subinventory_code')
            : null;

        // Fetch ALL active items — no term filter (filtering done client-side)
        $items = ItemMaster::select(
                'inventory_item_id', 'item_code', 'description',
                'primary_uom_code', 'item_cost', 'category_code'
            )
            ->orderBy('item_code')
            ->get();

        // Single query to get all onhand qty for the subinventory
        if ($subCode) {
            $onhands = Onhand::where('subinventory_code', $subCode)
                ->pluck('primary_transaction_quantity', 'inventory_item_id');

            $items = $items->map(function ($item) use ($onhands) {
                $item->stock_qty = (float) ($onhands[$item->inventory_item_id] ?? 0);
                return $item;
            });
        } else {
            $items = $items->map(function ($item) {
                $item->stock_qty = null;
                return $item;
            });
        }

        return response()->json($items->values());
    }

    public function report($id)
    {
        $session = PosSession::with('cashier')->findOrFail($id);

        $orders = PosOrder::with(['lines', 'payments', 'cashier', 'createdBy'])
            ->where('session_id', $id)
            ->where('status', 'paid')
            ->get();

        $orderIds      = $orders->pluck('id');
        $totalCash     = PosPayment::whereIn('pos_order_id', $orderIds)->where('payment_method', 'cash')->sum('amount');
        $totalTransfer = PosPayment::whereIn('pos_order_id', $orderIds)->where('payment_method', 'transfer')->sum('amount');
        $totalRevenue  = $orders->sum('total');
        $totalTax      = $orders->sum('tax_amount');

        return view('admin.pos.report', compact(
            'session', 'orders', 'totalCash', 'totalTransfer', 'totalRevenue', 'totalTax'
        ));
    }

    public function exportPdf($id)
    {
        $session = PosSession::with('cashier')->findOrFail($id);

        $orders = PosOrder::with(['lines', 'payments', 'cashier', 'createdBy'])
            ->where('session_id', $id)
            ->where('status', 'paid')
            ->get();

        $orderIds      = $orders->pluck('id');
        $totalCash     = PosPayment::whereIn('pos_order_id', $orderIds)->where('payment_method', 'cash')->sum('amount');
        $totalTransfer = PosPayment::whereIn('pos_order_id', $orderIds)->where('payment_method', 'transfer')->sum('amount');
        $totalRevenue  = $orders->sum('total');
        $totalTax      = $orders->sum('tax_amount');

        $pdf = PDF::loadView('admin.pos.report_pdf', compact(
            'session', 'orders', 'totalCash', 'totalTransfer', 'totalRevenue', 'totalTax'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_POS_' . $session->session_number . '_' . now()->format('Ymd') . '.pdf');
    }

    public function exportExcel($id)
    {
        $session = PosSession::findOrFail($id);
        $filename = 'Laporan_POS_' . $session->session_number . '_' . now()->format('Ymd') . '.xlsx';

        return Excel::download(new PosSessionExport($id), $filename);
    }

    public function getCustomers(Request $request)
    {
        $q = trim($request->get('q', ''));

        // Tanpa filter status agar sesuai dengan data di halaman /admin/customer
        $customers = Customer::select('id', 'cust_party_code', 'party_name', 'address1', 'city')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('party_name', 'like', '%' . $q . '%')
                        ->orWhere('cust_party_code', 'like', '%' . $q . '%');
                });
            })
            ->orderBy('party_name')
            ->limit(20)
            ->get();

        return response()->json($customers);
    }
}
