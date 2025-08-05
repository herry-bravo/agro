<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionTypeRequest;
use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\StoreRcvRequest;
use App\PurchaseOrder;
use App\PurchaseOrderDet;
use App\TrxStatuses;
use App\RcvHeader;
use App\RcvDetail;
use App\Grn;
use App\Onhand;
use App\PurchaseRequisition;
use App\RequisitionDetail;
use App\UomConversion;
use App\MaterialTxns;
use App\ItemMaster;
use App\Subinventories;
use Gate;
use App\User;
use App\Vendor;
use App\GlHeader;
use App\GlLines;
use App\HPCount;
use App\AccountCode;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ReceivesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $grn = RcvHeader::orderBy('id', 'DESC')->get('receipt_num');
        $vendor = Vendor::All();
        return view('admin.rcv.index', compact('vendor','grn'));
    }

    public function create(){
        $header_id = request()->get('header_id');
		$order_head = PurchaseOrder::where('po_head_id','=',$header_id)->get()->first();
        // dd($order_head);
        $orders = PurchaseOrderDet::where('po_header_id','=',$header_id)->get();
        // abort_if(Gate::denies('receive_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		// Grn::create();
		// $grn = Grn::latest('id')->first();
		$users = User::all();
		$subInventories = Subinventories::all();

		// $orders = PurchaseOrderDet::where('line_status','=',2)->get();
		// $order_head = PurchaseOrder::where('status','=',2)->get();
		// $vendor = DB::table('bm_vendor_header')
        //      ->join('bm_po_header_all', 'bm_po_header_all.vendor_id', '=', 'bm_vendor_header.vendor_id')
        //      ->select('bm_po_header_all.vendor_id','bm_vendor_header.vendor_name')
        //      ->where('bm_po_header_all.status',2)
        //      ->groupBy('bm_po_header_all.vendor_id','bm_vendor_header.vendor_name')
        //      ->get();
        $today = Carbon::today()->format('Y-m-d');

        // Hitung jumlah record dengan created_at hari ini
        $countToday = DB::table('bm_po_header_all') // ganti dengan tabel yang menyimpan data ini
            ->whereDate('created_at', $today)
            ->count();

        // Nomor urut (mulai dari 1)
        $urut = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        $dt = Carbon::now()->format('dmy');
        // Nomor yang akan ditampilkan
        $inv =$dt .''. $urut;
        $countReset = 'NX/IN/' . $dt .''. $urut ;
		return view('admin.rcv.create',compact('users','inv','orders','order_head','countReset','subInventories'));
    }

    public function store(Request $request){
        // dd(intval($request->tax_rate));
        // dd($request->note);
        // $id = RcvHeader::latest('id')->first();
        // $head =RcvHeader::findorNew($request->id);
        // $head->shipment_header_id=str_pad($id->id+1, 6, "0", STR_PAD_LEFT);
        $id = RcvHeader::latest('id')->first();
        $head = RcvHeader::findOrNew($request->id);
        // Jika belum ada data, mulai dari 1
        $nextId = $id ? $id->id + 1 : 1;
        // $head->shipment_header_id = str_pad($nextId, 6, "0", STR_PAD_LEFT);
        $head->shipment_header_id = str_pad($nextId, 6, "0", STR_PAD_LEFT);
        $head->vendor_id = $request->vendor_id;
        $head->organization_id = $request->organization_id;
        $head->receipt_num = $request->no_rcv;
        $head->currency_code = $request->currency_code;
        $head->conversion_date = $request->conversion_date;
        $head->conversion_rate = intval($request->tax_rate);
        $head->vendor_site_id = $request->vendor_site_id;
        $head->ship_to_location_id = $request->warehouse;
        $head->transaction_type = "RECEIVE";
        $head->receipt_source_code = $request->type_lookup_code;
        $head->attribute1 = $request->po_number;
        $head->invoice_status_code = 0;
        $head->created_by = $request->created_by;
        $head->attribute2 = $request->address1;
        $head->last_updated_by = $request->updated_by;
        $head->comments = $request->note;
        $head->gl_date = now();
        $head->created_at = now();
        $head->updated_at = now();
        // dd($head);
        try {
        DB::beginTransaction();
        $head->save();
        
        // dd($nextId);
        // Simpan header dulu agar ID tersedia
        $shipmentHeaderId = $head->shipment_header_id;

        // Ambil detail input dari form
        $item_codes  = $request->input('inventory_item_id');
        $descriptions = $request->input('description_item');
        $category = $request->input('category_code');
        $line_ids = $request->input('line_id');
        $uoms = $request->input('po_uom_code');
        $quantities = $request->input('purchase_quantity');
        $costs = $request->input('purchase_cost');
        $dates = $request->input('need_by_date');
        $po_line_id = $request->input('po_line_id');
        $base_qty = $request->input('base_qty');
        // dd( str_replace(',', '', str_replace('.', '', $costs)));
        // Validasi jumlah data
        $count = count($item_codes);
        foreach ($item_codes as $i => $item_code) {
            // Pastikan semua data tersedia
            if (
                !isset(
                    $line_ids[$i], $quantities[$i], $descriptions[$i], $category[$i],
                    $uoms[$i], $costs[$i], $dates[$i], $po_line_id[$i], $base_qty[$i]
                )
            ) {
                continue; // skip jika ada data yang kurang
            }

            // Validasi: tidak boleh lebih besar dari base_qty
            if ($quantities[$i] > $base_qty[$i]) {
                return back()->with('error', 'Cannot receive more than purchase quantity on line ' . ($i + 1));
            }
            if ($request->note == "on") {
                    $cost =$cost = (int) explode(',', str_replace('.', '', $request->purchase_cost[$i]))[0];
                    $qty = $request->base_qty[$i];
                    $subtot = $cost * $qty;
                    $attribute2 = $subtot + ($subtot * ($request->tax_rate / 100));
                    // dd($attribute2);
                } else {
                    $cost =$cost = (int) explode(',', str_replace('.', '', $request->purchase_cost[$i]))[0];
                    $qty = $request->base_qty[$i];
                    $subtot = $cost * $qty;
                    $attribute2 = $subtot - ($subtot * ($request->tax_rate / 100));
                }
                 // Average
            $purchase_quantity = floatval($quantities[$i]);
            $purchase_cost = (float) str_replace(['.', ','], ['', '.'], $costs[$i]);
            // Ambil data qty lama dan item_cost lama
            $item = DB::table('bm_mtl_system_item')->where('inventory_item_id', $item_code)->first();
            $qty_lama = DB::table('bm_inv_onhand_quantities_detail')
            ->where('inventory_item_id', $item_code)
            ->sum('primary_transaction_quantity');
            
            $item_cost_lama = floatval($item->item_cost ?? 0);
            
            // Hitung total harga lama dan baru
            $harga_lama_total = $item_cost_lama * $qty_lama;
            $harga_baru_total = $purchase_cost * $purchase_quantity;
            
            // Hitung qty total
            $total_qty = $qty_lama + $purchase_quantity;
            
            // Hindari pembagian nol
            if ($total_qty > 0) {
                $new_item_cost = ($harga_lama_total + $harga_baru_total) / $total_qty;
            } else {
                $new_item_cost = 0;
            }

            // Update item_cost
            DB::table('bm_mtl_system_item')
            ->where('inventory_item_id', $item_code)
            ->update([
                'item_cost' => $purchase_cost,
            ]);
            // Average
            // Simpan ke RcvDetail
            $rcv = RcvDetail::create([
                'shipment_line_id' => $line_ids[$i],
                'created_by' => auth()->user()->id,
                'last_update_login' => auth()->user()->id,
                'shipment_header_id' => $shipmentHeaderId,
                'line_num' => $line_ids[$i],
                'category_id' => $category[$i],
                'quantity_received' => $quantities[$i],
                'uom_code' => $uoms[$i],
                'description' => $descriptions[$i],
                'item_id' => $item_code,
                'vendor_item_num' => $request->vendor_id,
                'vendor_lot_num' => $request->vendor_site_id,
                'po_header_id' => $shipmentHeaderId,
                'po_line_id' => $po_line_id[$i],
                'amount' => intval( $subtot),
                'requested_amount' => intval( $purchase_cost),
                'created_at' => $dates[$i],                
                'updated_at' => $dates[$i],
            ]);
            
            // Hitung sisa base_qty dan update ke PurchaseOrderDet
            $sisa_qty = (int)((float)$base_qty[$i] - (float)$quantities[$i]);

            PurchaseOrderDet::where('po_header_id', $request->po_head)
                ->where('line_number', $line_ids[$i])
                ->update([
                    'base_qty' => $sisa_qty,
                    'quantity_receive' => $quantities[$i]
                ]);
            PurchaseOrder::where('po_head_id', $request->po_head)
                ->update([
                    'source' => 1,
                ]);

                // Jika quantity > 0, update ke Onhand
            if ((float)$quantities[$i] > 0) {
                $onhand = Onhand::where('inventory_item_id', $item_code)
                    ->where('subinventory_code', $request->warehouse)
                    ->first();

                if ($onhand) {
                    $onhand->primary_transaction_quantity += (int)$quantities[$i];
                    $onhand->save();
                } else {
                    Onhand::create([
                        'inventory_item_id' => $item_code,
                        'subinventory_code' => $request->warehouse,
                        'primary_transaction_quantity' => (int)$quantities[$i],
                        'transaction_uom_code' => $uoms[$i],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
           
        }

        // for ($i = 0; $i < $count; $i++) {
        //     if ($quantities[$i] > $base_qty[$i]) {
        //         return back()->with('error', 'Cannot receive more than purchase quantity on line ' . ($i + 1));
        //     }
        //     RcvDetail::create([
        //         'shipment_line_id' => $line_ids[$i],
        //         'created_by' => auth()->user()->id,
        //         'last_update_login' => auth()->user()->id,
        //         'shipment_header_id' => $shipmentHeaderId,
        //         'line_num' => $line_ids[$i],
        //         'category_id' => $category[$i],
        //         'quantity_received' => $quantities[$i],
        //         'uom_code' => $uoms[$i],
        //         'description' => $descriptions[$i],
        //         'item_id' => $item_codes[$i],
        //         'vendor_item_num' => $request->vendor_id,
        //         'vendor_lot_num' => $request->vendor_site_id,
        //         'po_header_id' => $request->po_head,
        //         'po_line_id' => $po_line_id[$i],
        //         'amount' =>  str_replace(',', '', str_replace('.', '', $costs[$i])),
        //         'created_at' => $dates[$i],
        //         'updated_at' => $dates[$i],
        //     ]);
        //      $sisa_qty = (int) ((float) $base_qty[$i] - (float) $quantities[$i]);

        //     PurchaseOrderDet::where('po_header_id', $request->po_head)
        //         ->where('line_number', $line_ids[$i]) // tambahkan baris ini jika ada `po_line_id` di tabel
        //         ->update(['base_qty' => $sisa_qty,'quantity_receive' => $quantities[$i]]);
        //         }
        //     // Transaksi ke tabel Onhand
        //     $onhand = Onhand::where('inventory_item_id', $item_codes[$i])
        //         ->where('subinventory_code', $request->warehouse)
        //         ->first();

        //     if ($onhand) {
        //         // Jika data onhand sudah ada → update jumlah
        //         $onhand->primary_transaction_quantity += (int) $quantities[$i];
        //         $onhand->save();
        //     } else {
        //         // Jika belum ada → insert data baru
        //         Onhand::create([
        //             'inventory_item_id' => $item_codes[$i],
        //             'subinventory_code' => $request->warehouse,
        //             'primary_transaction_quantity' => (int) $quantities[$i],
        //             'transaction_uom_code' =>$uoms[$i],
        //             'created_by' =>auth()->user()->id,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }







            // $checked_array=$request->line_number;
            // $line_id=1;
            // dd($checked_array);
            // foreach ($request->check as $key => $value){
            //     if(in_array($request->check[$key],$checked_array)){
            //         $uom_conversion = UomConversion::where('inventory_item_id', $request->inventory_item_id[$key])->first();
            //         if ($uom_conversion){
            //             if( $request->po_uom_code[$key]== $uom_conversion->interior_unit_code){
            //                 $base_uom = $uom_conversion->uom_code;
            //                 $base_qty = $request->purchase_quantity[$key] / $uom_conversion->conversion_rate;
            //                 $transfer_cost = $request->unit_price[$key] * $uom_conversion->conversion_rate;
            //                 // dd($transfer_cost);
            //             }else{
            //                 $base_uom =  $request->po_uom_code[$key];
            //                 $base_qty = $request->purchase_quantity[$key];
            //                 $transfer_cost = $request->unit_price[$key];
            //             }
            //         }else{
            //             $base_uom =  $request->po_uom_code[$key];
            //             $base_qty = $request->purchase_quantity[$key];
            //             $transfer_cost = $request->unit_price[$key];
            //         }
            //         $data = array(
            //             'po_header_id'=>isset($request->po_header_id[$key])? $request->po_header_id[$key] :'',
			// 				'po_line_location_id'=>isset($request->no_id[$key])? $request->no_id[$key] :'',
			// 				'quantity_received'=>isset($request->purchase_quantity[$key])? $request->purchase_quantity[$key] :'',
			// 				'quantity_delivered'=>0,
			// 				'quantity_returned'=>0,
			// 				'quantity_accepted'=>isset($request->purchase_quantity[$key])? $request->purchase_quantity[$key] :'',
			// 				'quantity_rejected'=>0,
            //                 'secondary_quantity_received'=>$base_qty,
            //                 'secondary_uom_code'=>$base_uom,
            //                 'transfer_cost'=>$transfer_cost,
			// 				'shipment_unit_price'=>isset($request->unit_price[$key])? $request->unit_price[$key] :'',
			// 				'po_line_id'=>isset($request->po_line_id[$key])? $request->po_line_id[$key] :'',
			// 				'product_category'=>isset($request->attribute2[$key])? $request->attribute2[$key] :'',
			// 				'uom_code'=>isset($request->po_uom_code[$key])? $request->po_uom_code[$key] :'',
			// 				'item_description'=>isset($request->item_description[$key])? $request->item_description[$key] :'',
			// 				'item_id'=>isset($request->inventory_item_id[$key])? $request->inventory_item_id[$key] :'',
			// 				'tax_name'=>isset($request->tax_name[$key])? $request->tax_name[$key] :'',
			// 				'shipment_header_id'=> $head->shipment_header_id,
			// 				'shipment_line_id'=>$line_id,
			// 				'to_subinventory'=>isset($request->subinventory[$key])? $request->subinventory[$key] :'1000',
			// 				'created_at'=> date('Y-m-d H:i:s'),
			// 				'updated_at'=> date('Y-m-d H:i:s'),
            //         );
            //         // dd($data);
            //         /*check existing PO and update [po_quantity,quantity_receive] */
            //         $po_lines=PurchaseOrderDet::find($data['po_line_location_id'], ['po_quantity', 'quantity_receive','line_status']);
            //         $available_qty=$po_lines->po_quantity-$po_lines->quantity_receive;
            //         if($data['quantity_received']<=$available_qty){
            //          $new_rcv_qty=$po_lines->quantity_receive+$data['quantity_received'];
            //          if($new_rcv_qty==$po_lines->po_quantity){
            //                 $line_status=12;
            //             }else{
            //                 $line_status=$po_lines->line_status;
            //              }
            //         }else{
            //             break;
            //         }
            //         /* end Check PO quantity and Received*/

            //         RcvDetail::create($data);
            //         PurchaseOrderDet::where("id", $data['po_line_location_id'])->update(["quantity_receive" => $new_rcv_qty,"line_status" => $line_status]);
            //         /* Service (SVR) not included in onhand Transaction*/
            //         $type_code=ItemMaster::where(['inventory_item_id'=>$data['item_id'],'type_code'=>'SVR'])->first();
            //         if(!$type_code)
            //         {
            //                 /* Onhand Transaction*/
            //                 $onhand=Onhand::where(['inventory_item_id'=>$data['item_id'],'subinventory_code'=>$data['to_subinventory'],'inv_striping_category'=>$data['product_category']])->first();
            //                 if(!$onhand)
            //                 {
            //                     $stock = array(
            //                         'inventory_item_id'=>$data['item_id'],
            //                         'subinventory_code'=>$data['to_subinventory'],
            //                         'inv_striping_category'=>$data['product_category'],
            //                         'primary_transaction_quantity'=>$base_qty,
            //                         'transaction_uom_code'=>$base_uom,
            //                         'created_by'=>$request->created_by,
            //                         'created_at'=> date('Y-m-d H:i:s'),
            //                         'updated_at'=> date('Y-m-d H:i:s'),
            //                     );
            //                     // dd($stock);
            //                 Onhand::create($stock);
            //                 }else{
            //                      // dd(existing stock);
            //                 $update_stock=	$onhand->primary_transaction_quantity+$base_qty;
            //                     $onhand=Onhand::where(['inventory_item_id'=>$data['item_id'],'subinventory_code'=>$data['to_subinventory'],'inv_striping_category'=>$data['product_category']])->update(["primary_transaction_quantity"=>$update_stock]);
            //                 }
            //         }
            //         $trx = array(
            //             'transaction_id'=>MaterialTxns::all()->count()+1,
            //             'last_updated_by'=>$request->updated_by,
            //             'created_by'=>$request->created_by,
            //             'inventory_item_id'=>$data['item_id'],
            //             'organization_id'=>'222',
            //             'subinventory_code'=>$data['to_subinventory'],
            //             'transaction_type_id'=>1,
            //             'transaction_action_id'=>1,
            //             'transaction_source_type_id'=>1,
            //             'secondary_uom_code'=>$base_uom,
            //             'secondary_transaction_quantity'=>$base_qty,
            //             'transaction_source_name'=>"Purchase Order Receipt",
            //             'transaction_quantity'=>$data['quantity_received'],
            //             'transaction_cost'=>$data['transfer_cost'],
            //             'transaction_uom'=>$data['uom_code'],
            //             'product_category'=>$data['product_category'],
            //             'primary_quantity'=>$data['quantity_received'],
            //             'shipment_number'=>$request->attribute1,
            //             'transaction_date'=>$request->gl_date,
            //             'transaction_reference'=>$request->segment1,
            //             'currency_code'=>DB::table('bm_po_header_all')->where('segment1',$request->segment1)->first()->currency_code,
            //             'country_of_origin_code'=>DB::table('bm_party_site')->where('site_code',$head->vendor_site_id)->first()->country ?? DB::table('bm_vendor_header')->where('vendor_id',$request->vendor_id)->first()->country,
            //             'receiving_document'=>isset($request->attribute1)? $request->attribute1 : $request->packing_slip,
            //             'source_line_id'=>$data['po_line_id'],
            //             'attribute_category'=>$request->receipt_num,
            //         );
            //         // dd($trx);
            //         MaterialTxns::create($trx);

            //     }
            //     $line_id++;

            //     //update po status

            // }
        DB::commit();
            return redirect()->back()->with('success', 'Receive berhasil disimpan');
        }catch (Throwable $e){
            \DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan: '.$e->getMessage());
        }
    }
    public function edit($id)
    {
        // dd('id');
        $child = RcvDetail::where('id',$id)->first()->shipment_header_id;
        $parent = RcvHeader::where('shipment_header_id',$child)->first();
        $detail = RcvDetail::where('shipment_header_id', $parent->shipment_header_id)
        ->where('quantity_received', '>', 0)
        ->get();
        $ppn= AccountCode::where('account_code','3202')->first();

        return view('admin.rcv.edit',compact('ppn','child','parent','detail'));
    }

    public function update(Request $request)
    {   
        $header_id = DB::table('bm_gl_je_headers')->get()->last();
        $head = GlHeader::findorNew($request->id);
        $id=$header_id->id+1;
        $head->je_source=$request->po_number;
        $head->default_effective_date=Carbon::parse($request->created_at)->format('Y-m-d');
        $head->period_name=Carbon::parse($request->created_at)->format('M y');
        $head->external_reference=$request->po_number;
        $head->currency_code=$request->currency_code;
        $head->je_header_id =$id;
        $head->name=$request->no_rcv;
        $head->created_by=auth()->user()->id;
        $head->last_updated_by=auth()->user()->id;
        $head->je_batch_id=$request->po_number;
        $head->running_total_dr=intval($request->running_total_dr);
        $head->running_total_cr=intval($request->running_total_cr);
        RcvHeader::where('id', $request->id)->update([
            'invoice_status_code' => 1
        ]);
        try {
			\DB::beginTransaction();
		    $head->save();
            foreach($request->code_combinations as $key =>$code_combinations){
                $data = array(
                    'je_header_id'=>$id,
                    'je_line_num'=> $key+1,
                    'last_updated_by'=>(int) auth()->user()->id,
                    'ledger_id'=>$request->po_number ?? '',
                    'code_combination_id'=>$request->accDes[$key],
                    'period_name'=>Carbon::parse($request->created_at)->format('M y'),
                    'effective_date'=>Carbon::parse($request->created_at)->format('Y-m-d'),
                    'status'=>(int)$request->status,
                    'created_by'=>(int)auth()->user()->id,
                    'entered_dr'=>(int) str_replace(',', '', $request->dr[$key]),
                    'entered_cr'=>(int) str_replace(',', '', $request->cr[$key]),
                    'description'=>$request->desc [$key],
                    // 'reference_1'=>$request->bill_to,
                    'tax_code'=>(int)$request->taxe_rate,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                // dd($data);
            GlLines::create($data);
          }
           \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
		}
        return view('admin.glmanual.index')->with('success', 'Data Stored');
    
	}

    public function show(Request $request)
    {
        $pdf = PDF::loadView('admin.rcv.product-label', compact('request'));
       // $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
    }

    public function destroy(PurchaseRequisition $purchaseRequisition)
    {
       abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseRequisition->delete();
		//dd($purchaseRequisition);

        //return redirect()->route('admin.purchase-requisition.index');
    }

    public function massDestroy(MassDestroyTransactionTypeRequest $request)
    {
        TransactionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function rcv_direct(Request $request)
    {
		Grn::create();
		$grn = Grn::latest('id')->first();
        $vendor = Vendor::All();
        HPCount::create();
        $id = HPCount::latest('id')->first();
        $head = HPCount::findorNew($id->id+1);
        $po_number='2'.str_pad($id->id+1, 7, "0", STR_PAD_LEFT);

		return view('admin.rcv.supplierDirect',compact('vendor','grn','po_number'));
    }

    public function rcv_direct_store(Request $request)
    {
        try {
        \DB::beginTransaction();

            //Create Purchase Requitation
            $pr_id = PurchaseRequisition::latest('id')->first();
            $pr_head = PurchaseRequisition::findorNew($pr_id->id+1);
            $pr_head->segment1='PR'.str_pad($pr_id->id+1, 6, "0", STR_PAD_LEFT);
            $number=$pr_head->segment1;
            $pr_header_id = PurchaseRequisition::latest()->first();
            $pr_header_id = $pr_header_id->id +1;
            $pr_head =PurchaseRequisition::findorNew($request->id);
            $pr_head->req_header_id = $pr_header_id;
            $pr_head->segment1=$number;
            $pr_head->authorized_status=2;
            $pr_head->transaction_date=date('Y-m-d');
            $pr_head->created_by=$request->created_by;
            $pr_head->reference=$request->ref;
            $pr_head->updated_by=$request->updated_by;
            $pr_head->requested_by=$request->created_by;
            $pr_head->attribute1='WE2105';
            $pr_head->app_lvl=12;
            $pr_head->description='Local Material order';
            // dd($pr_head);
			$pr_head->save();

            // Create Purchase Order
            $po_header_id = PurchaseOrder::latest()->first();
            $po_head = PurchaseOrder::findorNew($request->id);
            $po_head->po_head_id = $po_header_id->id+1;
            $po_head->segment1=$request->segment1;
            $po_head->status=12;
            $po_head->agent_id=$request->agent_id;
            $po_head->organization_id=isset($request->organization_id)? $request->organization_id :182;
            $po_head->created_by=$request->created_by;
            $po_head->vendor_id=$request->vendor_id;
            $po_head->rate=1;
            $po_head->rate_date=date('Y-m-d');
            $po_head->type_lookup_code=$request->type_lookup_code;
            $po_head->ship_to_location=$request->ship_to_location;
            $po_head->bill_to_location=$request->bill_to_location;
            $po_head->currency_code=$request->currency_code;
            $po_head->rate_date=$request->rate_date;
            $po_head->source=$request->source;
            // dd($head);
            $po_head->save();

            // receive
            $id = RcvHeader::latest('id')->first();
            $head =RcvHeader::findorNew($request->id);
            $head->shipment_header_id=str_pad($id->id+1, 6, "0", STR_PAD_LEFT);
            $head->vendor_id=$request->vendor_id;
            $head->vendor_site_id=$request->vendor_id;
            $head->organization_id=isset($request->organization_id)? $request->organization_id :182;
            $head->receipt_num=$request->receipt_num;
            $head->num_of_containers = $request->num_of_containers;
            $head->currency_code=$request->currency_code;
            $head->gl_date=$request->rate_date;
            $head->ship_to_location_id=$request->ship_to_location;
            $head->bill_of_lading=$request->bill_of_lading;
            $head->freight_terms=$request->freight_terms;
            $head->transaction_type="RECEIVE";
            $head->receipt_source_code=$request->type_lookup_code;
            $head->packing_slip=$request->packing_slip;
            $head->conversion_rate=1;
            $head->conversion_date=date('Y-m-d');
            $head->waybill_airbill_num=$request->waybill_airbill_num;
            $head->comments=$request->comments;
            $head->invoice_status_code=0;
            $head->created_by=auth()->user()->id;
            $head->last_updated_by=$request->updated_by;
            // $head->gl_date=$request->gl_date;
            $head->created_at=date('Y-m-d H:i:s');
            $head->updated_at=date('Y-m-d H:i:s');
            // dd($head);
            $head->save();
            $line_number=1;
            foreach($request->inventory_item_id as $key =>$inventory_item_id){
                    $pr_data = array(
                        'header_id'=>$pr_header_id,
                        'line_id'=>$key+1 ,
                        'split_line_id'=>$key+1 ,
                        'inventory_item_id'=>$request->inventory_item_id[$key],
                        'quantity'=>$request->quantity[$key],
                        'attribute1'=>$request->description_item[$key],
                        'pr_uom_code'=>$request->pr_uom_code[$key],
                        'requested_date'=>date('Y-m-d'),
                        'estimated_cost'=>0,
                        'created_by'=>auth()->user()->id,
                        'updated_by'=>$request->updated_by,
                        'purchase_status'=>3,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    RequisitionDetail::create($pr_data);

                    //Calculation
                    $wg = $request->attribute1[$key] + $request->attribute_integer1[$key] + $request->attribute_integer3 [$key]; // Water + Gross + PROHIBITIVE
                    $tolerance = $request->attribute2[$key] + $request->attribute_integer2[$key]; // Toleraance
                    $qty_accepted = $request->quantity [$key] - ($request->quantity [$key] * ($wg - $tolerance) / 100); // Result
                    // dd($qty_accepted);

                    $po_data = array(
                        'po_header_id'=>$po_head->po_head_id,
                        'line_id'=> $line_number,
                        'inventory_item_id'=>$request->inventory_item_id [$key],
                        'po_uom_code'=>$request->pr_uom_code [$key],
                        'unit_price'=>0,
                        'need_by_date'=>date('Y-m-d'),
                        'po_quantity'=>$request->quantity [$key],
                        'base_uom'=> $request->pr_uom_code [$key],
                        'base_qty'=>$request->quantity [$key],
                        'attribute2'=>'',
                        'line_type_id'=>1,
                        'line_status'=>12,
                        'quantity_receive'=>$qty_accepted,
                        'organization_id'=>222,
                        'tax_name'=>$request->tax_id,
                        'source_line_id'=>'',
                        'item_description'=>$request->description_item [$key],
                        'attribute1'=>$number,
                        'line_number'=>$line_number,
                        'created_by_id'=>auth()->user()->id,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    // dd($data);
                    PurchaseOrderDet::create($po_data);
                    $po_detail = PurchaseOrderDet::latest('id')->first();


                    $data = array(
                            'po_header_id'=>$po_head->po_head_id,
							'po_line_location_id'=>$po_detail->id,
							'quantity_received'=>$request->quantity [$key],
							'po_quantity'=>$request->quantity [$key],
							'quantity_delivered'=>0,
							'quantity_returned'=>0,
							'quantity_accepted'=>$qty_accepted,
							'quantity_rejected'=>0,
                            'secondary_quantity_received'=>$request->quantity [$key],
                            'tax_name'=>$request->tax_id,
                            'secondary_uom_code'=>$request->pr_uom_code [$key],
							'shipment_unit_price'=>0,
							'po_line_id'=>$po_detail->line_id,
							'uom_code'=>$request->pr_uom_code [$key],
							'item_description'=>$request->description_item [$key],
							'item_id'=>$request->inventory_item_id [$key],
							'shipment_header_id'=> $head->shipment_header_id,
							'shipment_line_id'=>$line_number,
							'to_subinventory'=>isset($request->subinventory[$key])? $request->subinventory[$key] :'1000',
							'transfer_percentage'=>$request->transfer_percentage [$key], //BM Tolerance
							'attribute1'=>$request->attribute1[$key], //Gross
							'attribute2'=>$request->attribute2[$key], // Gros Tolerance
							'attribute_integer1'=>$request->attribute_integer1[$key], //Water
							'attribute_integer2'=>$request->attribute_integer2 [$key], //Supplier Tolerance
							'attribute_integer3'=>$request->attribute_integer3 [$key], // Prohibitive
							'created_at'=> date('Y-m-d H:i:s'),
							'updated_at'=> date('Y-m-d H:i:s'),
                    );
                    // dd($data);
                    RcvDetail::create($data);

                    /* Onhand Transaction*/
                    $onhand=Onhand::where(['inventory_item_id'=>$data['item_id'],'subinventory_code'=>$data['to_subinventory']])->first();
                    if(!$onhand){
                        $stock = array(
                            'inventory_item_id'=>$data['item_id'],
                            'subinventory_code'=>$data['to_subinventory'],
                            'primary_transaction_quantity'=>$request->quantity [$key],
                            'transaction_uom_code'=>$request->pr_uom_code [$key],
                            'created_by'=>$request->created_by,
                            'created_at'=> date('Y-m-d H:i:s'),
                            'updated_at'=> date('Y-m-d H:i:s'),
                        );
                    Onhand::create($stock);
                    }else{
                     $update_stock=	$onhand->primary_transaction_quantity+$request->quantity [$key];
                        $onhand=Onhand::where(['inventory_item_id'=>$data['item_id'],'subinventory_code'=>$data['to_subinventory']])->update(["primary_transaction_quantity"=>$update_stock]);
                    }
                    $trx = array(
                        'transaction_id'=>MaterialTxns::all()->count()+1,
                        'last_updated_by'=>$request->updated_by,
                        'created_by'=>$request->created_by,
                        'inventory_item_id'=>$data['item_id'],
                        'organization_id'=>'222',
                        'subinventory_code'=>$data['to_subinventory'],
                        'transaction_type_id'=>1,
                        'transaction_action_id'=>1,
                        'transaction_source_type_id'=>1,
                        'secondary_uom_code'=>$request->pr_uom_code [$key],
                        'secondary_transaction_quantity'=>$request->quantity [$key],
                        'transaction_source_name'=>"Purchase Order Receipt",
                        'transaction_quantity'=>$data['quantity_received'],
                        'transaction_uom'=>$data['uom_code'],
                        'primary_quantity'=>$data['quantity_received'],
                        'transaction_date'=> date('Y-m-d'),
                        'transaction_reference'=>$request->segment1,
                        'currency_code'=>DB::table('bm_po_header_all')->where('segment1',$request->segment1)->first()->currency_code,
                        'receiving_document'=>$request->packing_slip,
                        'source_line_id'=>$data['po_line_id'],
                        'attribute_category'=>$request->receipt_num,
                    );
                    // dd($trx);
                    MaterialTxns::create($trx);

                $line_number++;
            }
        \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
        }

        return redirect()->route('admin.rcv.index')->with('success', 'Receive Data  is Inputed');

    }

    public function rcv_direct_edit(Request $request)
    {
        $rcv = RcvHeader::where('receipt_num',$request->grn)->first();
        $rcv_detail =RcvDetail::where('shipment_header_id',$rcv->shipment_header_id)->get();
        $detail =RcvDetail::where('shipment_header_id',$rcv->shipment_header_id)->first();
        $vendor = Vendor::All();
        $tax =\App\Tax::where('type_tax_use','=','Purchase')->get();

		return view('admin.rcv.supplierDirectEdit',compact('rcv','rcv_detail','vendor','tax','detail'));
    }

}
