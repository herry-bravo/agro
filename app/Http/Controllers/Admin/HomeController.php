<?php

namespace App\Http\Controllers\Admin;

use App\SalesOrder;
use App\Onhand;
use App\PosOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class HomeController
{
    public function index(Request $request)
    {
        $now          = Carbon::now();
        $currentYear  = $now->year;
        $currentMonth = $now->month;

        // Sales this month
        $salesThisMonth = SalesOrder::whereYear('ordered_date', $currentYear)
            ->whereMonth('ordered_date', $currentMonth)
            ->sum('total_payment') ?? 0;

        $salesCountMonth = SalesOrder::whereYear('ordered_date', $currentYear)
            ->whereMonth('ordered_date', $currentMonth)
            ->count();

        // On-hand total qty
        $onhandQty = Onhand::sum('transaction_quantity') ?? 0;

        // POS sales today
        $posToday = PosOrder::whereDate('order_date', $now->toDateString())
            ->sum('total') ?? 0;

        // Monthly revenue (credit on accounts starting with '6') & cost (debit on '5') for current year
        $monthlyRevenue = array_fill(0, 12, 0);
        $monthlyCost    = array_fill(0, 12, 0);

        $revenueRows = DB::table('bm_gl_lines')
            ->whereYear('effective_date', $currentYear)
            ->whereNull('deleted_at')
            ->where('code_combination_id', 'like', '6%')
            ->select(DB::raw('MONTH(effective_date) as m'), DB::raw('SUM(ISNULL(entered_cr,0)) as total'))
            ->groupBy(DB::raw('MONTH(effective_date)'))
            ->get();

        foreach ($revenueRows as $row) {
            $monthlyRevenue[(int)$row->m - 1] = (float)$row->total;
        }

        $costRows = DB::table('bm_gl_lines')
            ->whereYear('effective_date', $currentYear)
            ->whereNull('deleted_at')
            ->where('code_combination_id', 'like', '5%')
            ->select(DB::raw('MONTH(effective_date) as m'), DB::raw('SUM(ISNULL(entered_dr,0)) as total'))
            ->groupBy(DB::raw('MONTH(effective_date)'))
            ->get();

        foreach ($costRows as $row) {
            $monthlyCost[(int)$row->m - 1] = (float)$row->total;
        }

        // Recent sales orders
        $recentSales = SalesOrder::with('customer')
            ->orderBy('ordered_date', 'desc')
            ->limit(8)
            ->get();

        return view('admin.home.index', compact(
            'salesThisMonth', 'salesCountMonth',
            'onhandQty', 'posToday',
            'monthlyRevenue', 'monthlyCost',
            'recentSales', 'currentYear'
        ));
    }

    public function register(Request $request)
    {
        $user               = new User();
        $user->name         = $request->name;
        $user->password     = Hash::make($request->password);
        $user->email        = $request->email;
        $user->user_status  = 0;
        $user->save();

        return view('auth.login');
    }
}
