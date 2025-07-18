<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\SalesOrderDetail;
use App\SalesOrder;
use App\RcvHeader;
use App\User;
use Gate;
use App\Terms;
use App\PriceList;
use App\Customer;
use App\CurrencyGlobal;
use App\MissExpenses;
use App\Onhand;
use App\RcvDetail;
use App\PurchaseOrderDet;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\DeliveryDistrib;
use App\Subinventories;
use App\Grn;
use App\BankAccount;
use App\ApPayment;
use App\Tax;
use App\Faktur;
use App\GlHeader;
use App\GlLines;
use Carbon\Carbon;
use App\Http\Requests\StoreRcvRequest;
use Exception;
use Illuminate\Http\Response;
use Throwable;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;
use Yajra\DataTables\Facades\DataTables;

class SearchController extends Controller
{
	public function customer_name(Request $request){
        $term = $request['term'];
		$results = array();
		$queries = \App\Customer::where('party_name', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$results[$key]['value'] = $value->party_name;
			$results[$key]['value2'] = $value->cust_party_code;
		}
		return \Response::json($results);
	}

	public function item_code(Request $request){

		$term = $request['term'];
		$results = array();
		$queries = \App\ItemMaster::where('item_code', 'LIKE', '%'.$term.'%')->Orwhere('description', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->item_code." - ".$value->description;
			$qry[$key]['value1'] = $value->inventory_item_id;
		}
		return \Response::json($qry);
	}

	public function item_detail(Request $request){

		$term = $request['id'];
		$results = array();
		$queries = \App\ItemMaster::where('inventory_item_id', '=',$term)->get();
		foreach ($queries as $key => $value)
		{
			  $qry[] = array("inv_id" => $value->inventory_item_id,
                             "uom"=>$value->primary_uom_code,
                             "description"=>$value->description,
                             "item_code"=>$value->item_code,
                             "type_code"=>$value->type_code,
                            "attribute2"=>$value->attribute2);
		}
		return \Response::json($qry);
	}


	public function asettoGL(Request $request){
         if (!$request->filled('depreciation_date')) {
            return back()->withErrors(['depreciation_date' => 'Depreciation date can not be empty']);
        }
        $lastHeader = DB::table('bm_gl_je_headers')->latest('id')->first(); // Lebih efisien daripada get()->last()
        $newId = $lastHeader ? $lastHeader->id + 1 : 1;

        $head = new GlHeader(); // Buat instance baru
        $head->je_header_id = $newId;
        $head->name = $request->aset_name;
        $head->created_by = auth()->user()->id;
        $head->last_updated_by = auth()->user()->id;
        $head->je_batch_id = $newId;
        $head->default_effective_date = $request->depreciation_date;
        $head->period_name = Carbon::parse($request->depreciation_date)->format('M-y');
        $head->external_reference = $request->invoice;
        $head->currency_code = $request->currency_id;
        $head->running_total_dr = $request->depreciated_value;
        $head->running_total_cr = $request->depreciated_value;

        // Create new GlLines - child1
        $child1 = new GlLines();
        $child1->je_header_id = $newId;
        $child1->je_line_num = 1;
        $child1->last_updated_by = auth()->user()->id;
        $child1->ledger_id = $newId;
        $child1->code_combination_id = 8500;
        $child1->period_name = Carbon::parse($request->depreciation_date)->format('M-y');
        $child1->effective_date = $request->depreciation_date;
        $child1->created_by = auth()->user()->id;
        $child1->entered_dr = $request->depreciated_value;
        $child1->entered_cr = null; // NULL bukan string
        $child1->description = DB::table('bm_acc_all_id')->where('account_code', 8500)->value('description');
        $child1->currency_code = $request->currency_id;
        $child1->created_at = $request->depreciation_date;
        $child1->updated_at = $request->depreciation_date;

        // Create new GlLines - child2
        $child2 = new GlLines();
        $child2->je_header_id = $newId;
        $child2->je_line_num = 2;
        $child2->last_updated_by = auth()->user()->id;
        $child2->ledger_id = $newId;
        $child2->code_combination_id = 2500;
        $child2->period_name = Carbon::parse($request->depreciation_date)->format('M-y');
        $child2->effective_date = $request->depreciation_date;
        $child2->created_by = auth()->user()->id;
        $child2->entered_dr = null; // NULL bukan string
        $child2->entered_cr = $request->depreciated_value;
        $child2->description = DB::table('bm_acc_all_id')->where('account_code', 2500)->value('description');
        $child2->currency_code = $request->currency_id;
        $child2->created_at = $request->depreciation_date;
        $child2->updated_at = $request->depreciation_date;

        DB::table('bm_line_depreciation')->where('id', $request->line_id)->update(['move_posted_check' => 2]);

        $head->save();
        $child1->save();
        $child2->save();

        return redirect()->route('admin.asset.index')->with('success', 'Data Stored');
    }
	public function vendor(Request $request){

        // dd('tesj');
		$term = $request['term'];
		$results = array();
		$queries = \App\Vendor::where('vendor_name', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$queries[$key]['value'] = $value->vendor_name;
		}
		return \Response::json($queries);
	}
	public function Site(Request $request){

		$term = $request['term'];
		$results = array();

		$queries = \App\Site::where('address1', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$queries[$key]['value'] = $value->address1;
		}
        // dd($queries);
		return \Response::json($queries);
	}
    public function supplier_site(Request $request){
        $term = $request['term'];
		$results = array();

		$queries = \App\Site::where([['address1', 'LIKE', '%'.$term.'%']])->take(1)->get();
		foreach ($queries as $key => $value)
		{
            $queries[$key]['value'] = $value->address1;
		}
        // dd($queries);
		return \Response::json($queries);
	}
    public function purchase_item(Request $request)
    {
        $term = $request->input('term');

        $queries = \App\ItemMaster::select('bm_mtl_system_item.*', 'qt.id')
            ->leftJoin('bm_po_lines_all as qt', 'qt.inventory_item_id', '=', 'bm_mtl_system_item.inventory_item_id')
            ->where(function ($query) use ($term) {
                $query->where('bm_mtl_system_item.item_code', 'LIKE', "%{$term}%")
                    ->orWhere('bm_mtl_system_item.description', 'LIKE', "%{$term}%");
            })
            ->whereNull('qt.deleted_at')
            ->whereNull('bm_mtl_system_item.deleted_at')
            ->take(3)
            ->get();

        $results = [];

        foreach ($queries as $value) {
            $results[] = [
                'value'  => $value->item_code . " " . $value->description,
                'value1' => $value->id,
                'value2' => $value->inventory_item_id,
            ];
        }

        return response()->json($results);
    }

	public function purchase_price($vendor_id,$item_id,$pr_uom,$vendor_site)
	{
        $queries=\App\PurchaseOrder::RightJoin('bm_po_lines_all as line','line.po_header_id','=','bm_po_header_all.id')
                                    ->where([['bm_po_header_all.vendor_id','=',$vendor_id],['bm_po_header_all.vendor_site_id','=',$vendor_site],['bm_po_header_all.status','=',14],['line.inventory_item_id','=',$item_id],['line.po_uom_code','=',$pr_uom],['line.line_type_id','=','2']])
                                    ->latest('unit_price')->first();
        return isset($queries->unit_price) ? $queries->unit_price :0;
	}

	public function purchase_item_det(Request $request){
       // abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$term = $request['id'];
		$term2 = $request['itemId'];
		$results = array();

		$queries=\App\ItemMaster::select('bm_mtl_system_item.inventory_item_id','bm_mtl_system_item.item_cost','bm_mtl_system_item.description','bm_mtl_system_item.primary_uom_code','bm_mtl_system_item.category_code','bm_mtl_system_item.attribute2','qt.unit_price','qt.id','qt.po_uom_code')
		  ->leftJoin('bm_po_lines_all as qt','qt.inventory_item_id','=','bm_mtl_system_item.inventory_item_id')
        //   ->leftJoin('bm_inv_uom_conversions as conv','conv.inventory_item_id','=','bm_mtl_system_item.inventory_item_id')
          ->Where([['bm_mtl_system_item.description','=',$term2],['qt.deleted_at','=',NULL],['qt.line_type_id','=',2]])
          ->Orwhere([['bm_mtl_system_item.inventory_item_id','=',$term2],['qt.deleted_at','=',NULL]])
          ->latest('qt.created_at')->take(1)->get();
// dd($queries);
		foreach ($queries as $key => $value)
		{
			  $qry[] = array("id" => $value->inventory_item_id,"description"=> $value->description, "price" => $value->item_cost,"uom"=>isset($value->po_uom_code)?$value->po_uom_code:$value->primary_uom_code,"pr_uom"=>$value->primary_uom_code,"category"=>$value->category_code,"sub_category"=>isset($value->attribute2)? $value->attribute2:'');
		}

        // dd($qry);
		return \Response::json($qry);
	}

	public function acc_category(Request $request) {
		$term = $request['term'];
		$results = array();
		$queries = \App\Category::where('category_code', 'LIKE', '%'.$term.'%')->first();
		/*foreach ($queries as $key => $value)
		{
			$queries[$key]['value'] = $value->address1;
		} */
		return \Response::json($queries);
	}
    public function sub_category(Request $request) {
		$term = $request['term'];
		$results = array();
		$queries = \App\SubCategory::where('sub_cat_code', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->sub_cat_code;
			$qry[$key]['value1'] = $value->sub_cat_name;
		}
		return \Response::json($qry);
	}

    public function ref_aju(Request $request) {
		$term = $request['term'];
		$results = array();
		$qr = RcvHeader::groupBy('attribute1')
                        ->selectRaw('attribute1')
                        ->where('attribute1','LIKE','%'.$term.'%')
                        ->take(5)
                        ->get();
		foreach ($qr as $key => $value)
		{
            $qry[] = array("attribute1" => $value->attribute1);

			$qry[$key]['value'] = $value->attribute1;

		}
		return \Response::json($qry);
	}


    public function price_list(Request $request) {

		$term = $request['term'];
		$results = array();
		$queries = \App\ItemMaster::where('item_code', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->item_code." - ".$value->description;
			$qry[$key]['value1'] = $value->inventory_item_id;
		}
		return \Response::json($qry);
	}

    public function price_list_detail(Request $request){

        $term = $request['id'];
		$results = array();
		$queries = \App\ItemMaster::where('inventory_item_id', '=',$term)->get();
		foreach ($queries as $key => $value)
		{
            $qry[] = array(
                "line_id" => $value->inventory_item_id,
                "uom"=>$value->primary_uom_code,
                "description"=>$value->description
            );
		}
		return \Response::json($qry);
	}

    public function taxesmaster(Request $request) {
        // dd($request['keyword']);
        $term1 = $request['keyword'];
        $term2 = $request['currsales'];
        $term3 = $request['sellingPrice'];
        $queries=\App\Tax::where('tax_code','LIKE', '%'.$term1.'%')
            ->take(5)->get();
        foreach ($queries as $key => $value)
        {
            $qry[$key]['value1'] = $value->tax_code;
            $qry[$key]['value2'] = isset($value->tax_rate)?$value->tax_rate:0;
            $qry[$key]['value3'] = isset($value->id)?$value->id:0;
        }
        // dd($qry);

        return \Response::json($qry);
    }
    public function sales_order(Request $request) {
        $term1 = $request['test'];
        $term2 = $request['currsales'];
        $term3 = $request['sellingPrice'];
        $queries=\App\ItemMaster::select('bm_mtl_system_item.*')
            ->where('bm_mtl_system_item.description','LIKE', '%'.$term1.'%')
            ->orWhere('bm_mtl_system_item.item_code','LIKE', '%'.$term1.'%')
            ->take(5)->get();
        // $queries=\App\ItemMaster::select('bm_mtl_system_item.*','head.id','head.currency','line.unit_price', 'head.price_list_name')
        // ->LeftJoin('bm_dc_price_list_lines as line','line.inventory_item_id','=','bm_mtl_system_item.inventory_item_id')
        // ->leftJoin('bm_dc_price_list as head', 'head.id', '=', 'line.header_id')
        // ->where('bm_mtl_system_item.description','LIKE', '%'.$term1.'%')
        // ->orWhere('bm_mtl_system_item.item_code','LIKE', '%'.$term1.'%')
        // ->where('head.currency', '=', $term2)
        // ->where('head.id','=',$term3)
        // ->orWhere('head.id', NULL)
        // ->orderByRaw("CASE WHEN head.id  = '$term3' THEN head.id END DESC")
        // ->take(5)->get();
        // dd($queries);

        foreach ($queries as $key => $value)
        {
            $qry[$key]['value'] = $value->item_code." - ".$value->price_list_name." ".$value->description. " - ".floatval($value->unit_price);
            $qry[$key]['value1'] = $value->inventory_item_id;
            $qry[$key]['value2'] = isset($value->id)?$value->id:0;
            $qry[$key]['value3'] = isset($value->currency)?$value->currency:0;
        }
        return \Response::json($qry);
    }

    public function sales_order_detail(Request $request){

        $term = $request['id'];
        $term2 = $request['currencyL'];
        $term3 = $request['priceL'];
        $results = array();
        $qry = []; // Inisialisasi awal untuk mencegah undefined variable
        $queries=\App\ItemMaster::select('bm_mtl_system_item.*')
        ->where('bm_mtl_system_item.inventory_item_id', '=', $term)
        ->get();
        // $queries = \App\ItemMaster::leftJoin('bm_dc_price_list_lines', 'bm_dc_price_list_lines.inventory_item_id', '=', 'bm_mtl_system_item.inventory_item_id')
        //     ->leftJoin('bm_dc_price_list', 'bm_dc_price_list.id', '=', 'bm_dc_price_list_lines.header_id')
        //     ->leftjoin('bm_mtl_item_sub_inventories', 'bm_mtl_system_item.shipping_inventory', '=', 'bm_mtl_item_sub_inventories.sub_inventory_name')
        //     ->select(
        //         'bm_mtl_system_item.inventory_item_id',
        //         'bm_dc_price_list.currency',
        //         'bm_dc_price_list_lines.packing_type',
        //         'bm_dc_price_list_lines.unit_price',
        //         'bm_dc_price_list_lines.discount',
        //         'bm_dc_price_list_lines.id',
        //         'bm_dc_price_list_lines.uom',
        //         'bm_dc_price_list_lines.header_id',
        //         'bm_mtl_system_item.description as desc',
        //         'bm_dc_price_list.effective_date',
        //         'bm_dc_price_list.price_list_name',
        //         'bm_mtl_item_sub_inventories.sub_inventory_name',
        //         'bm_mtl_item_sub_inventories.description'
        //     )
        //     ->where('bm_dc_price_list_lines.header_id', '=', $term3)
        //     ->where('bm_mtl_system_item.inventory_item_id', '=', $term)
        //     ->where('bm_dc_price_list.currency', '=', $term2)
        //     ->orderByRaw("CASE WHEN bm_dc_price_list_lines.header_id  = '$term3' THEN bm_dc_price_list_lines.header_id END DESC")
        //     ->get();
        // dd($queries);

        foreach ($queries as $key => $value) {
            $qry[] = array(
                "line_id" => $value->inventory_item_id,
                "currency" => isset($value->currency) ? $value->currency : 0,
                "packingtype" => isset($value->packing_type) ? $value->packing_type : 0,
                "unitprice" => floatval($value->min_o_qty),
                "discount" => floatval($value->discount),
                "description" => $value->description,
                "uom" => $value->uom,
                "effective_date" => isset($value->effective_date) ? $value->effective_date : 0,
                "price_list_name" => isset($value->price_list_name) ? $value->price_list_name : 0,
                "shipping_inventory" => $value->sub_inventory_name,
                "subinventory" => $value->description,
                "header_id" => isset($value->header_id) ? $value->header_id : 0,
                "id" => isset($value->id) ? $value->id : 0,
            );
        }

        // dd($qry);

        return \Response::json($qry);

	}
    public function copyLinesselected(Request $request){
        $idReturn=$request->input('idReturn');
        $return = SalesOrderDetail::where('id',null)->get();
        $header_id = SalesOrderDetail::where('id',$idReturn)
            ->get()->first();
        if(!is_null($idReturn)){
            $return = SalesOrderDetail::select('bm_order_lines_all.*','bm_mtl_system_item.item_code','bm_order_headers_all.order_number','bm_order_headers_all.price_list_id')
            ->join('bm_mtl_system_item','bm_mtl_system_item.description','=','bm_order_lines_all.user_description_item')
            ->join('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->whereIn('bm_order_lines_all.id',$idReturn)
            ->where('bm_order_headers_all.deleted_at','=',null)
            ->get();
        }

        return Datatables::of($return,compact('idReturn'))->make(true);
    }

    public function searchSplitLine(Request $request){
        $idSplit=$request->input('idSplit');
        // dd($idReturn);
        $split = SalesOrderDetail::where('id',null)->get();
        if(!is_null($idSplit)){
            $split = SalesOrderDetail::where([['id',$idSplit],['flow_status_code',6]])->orWhere([['id',$idSplit],['flow_status_code',5]])
            ->get();

        }
        return Datatables::of($split,compact('idSplit'))->make(true);
    }

    // delivey --Heryy-- updateed at --21-06-2022--
    public function rcv_customer(Request $request){
        $vendor = $request->input('vendor_id');
        $ordernumber = $request->input('ordernum');
        if($ordernumber==null&&$vendor==null){
            $datamodel = SalesOrderDetail::where('id',null);
        }else{
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.order_number'
            ,'bm_order_headers_all.invoice_to_org_id','bm_cust_site_uses_all.party_name')
            ->join('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->join('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->where('bm_order_lines_all.flow_status_code',6)
            ->where('bm_order_headers_all.order_number', 'like','6%')
            ->where('bm_order_headers_all.order_number', 'like','%'.$ordernumber.'%')
            ->where('bm_cust_site_uses_all.party_name', 'like','%'.$vendor.'%')
            ->get();
        }
        return Datatables::of($datamodel)->make(true);
    }
    public function shipment_search(Request $request){
        $billto = $request->input('xhead');
        $shipto = $request->input('xlineid');
        $orderfrom = $request->input('xorderfrom');
        $orderto = $request->input('xorderto');

        $vendor = DB::raw("
            party_name like '$billto%'
            AND site_code like '$shipto%'
        ");

        $order_number = DB::raw("
            LOWER(order_number) = LOWER ('$orderfrom')
            OR LOWER(order_number) = LOWER ('$orderto')
        ");

        $flag = DB::raw("
            shipping_interfaced_flag is null
            AND booked_flag = 1
            AND flow_status_code = 6
            AND order_number like '5%'
        ");



        $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
        'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
        'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
        'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
        ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
        ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
        ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
        ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
        ->whereRaw($flag)
        ->where('bm_order_headers_all.deleted_at',Null)
        ->orderBy('id','ASC')
        ->get();

        if($billto==null&&$shipto==null&&$orderfrom==null&&$orderto==null){
            $datamodel;
        }
        elseif(!is_null($billto&&$shipto)&&$orderfrom==null&&$orderto==null){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.site_code','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->whereRaw($vendor)
            ->where('bm_order_headers_all.deleted_at',Null)
            // ->where('bm_cust_site_uses_all.party_name', 'like','%'.$billto.'%')
            // ->where('bm_party_site.site_code', 'like','%'.$shipto.'%')
            // ->whereRaw($filter)
            ->get();
        }elseif(!is_null($orderfrom&&$orderto)&&$billto==null&&$shipto==null){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.site_code','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->where('bm_order_headers_all.deleted_at',Null)
            ->whereBetween('bm_order_headers_all.order_number', [$orderfrom,$orderto])
            // ->whereRaw($filter)
            ->get();
        }
        elseif(!is_null($billto)){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.site_code','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->whereRaw($vendor)
            ->where('bm_order_headers_all.deleted_at',Null)
            ->whereBetween('bm_order_headers_all.order_number', [$orderfrom,$orderto])
            // ->whereRaw($filter)
            ->get();
        }
        elseif(!is_null($shipto)){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.site_code','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->whereRaw($vendor)
            ->where('bm_order_headers_all.deleted_at',Null)
            ->whereBetween('bm_order_headers_all.order_number', [$orderfrom,$orderto])
            ->get();
        }
        return Datatables::of($datamodel)->make(true);
	}
    public function shipment_search_item(Request $request){
        $billto = $request->input('party_name');
        $shipto = $request->input('site_code');
        $orderfrom = $request->input('order_numberfrom');
        $orderto = $request->input('order_numberto');

        $vendor = DB::raw("
            party_name like '$billto%'
            AND site_code like '$shipto%'
        ");

        $order_number = DB::raw("
            LOWER(order_number) = LOWER ('$orderfrom')
            OR LOWER(order_number) = LOWER ('$orderto')
        ");

        $flag = DB::raw("
            shipping_interfaced_flag is null
            AND booked_flag = 1
            AND flow_status_code = 6
            AND order_number like '5%'
        ");

        $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.conversion_rate','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
        'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
        'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
        'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
        ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
        ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
        ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
        ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
        ->whereRaw($flag)
        ->orderBy('id','DESC')
        ->get();

        if($billto==null&&$shipto==null&&$orderfrom==null&&$orderto==null){
            $datamodel;
        }
        elseif(!is_null($billto&&$shipto)&&$orderfrom==null&&$orderto==null){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.conversion_rate','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.id','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->whereRaw($vendor)
            // ->where('bm_cust_site_uses_all.party_name', 'like','%'.$billto.'%')
            // ->where('bm_party_site.site_code', 'like','%'.$shipto.'%')
            // ->whereRaw($filter)
            ->get();

        }elseif(!is_null($orderfrom&&$orderto)&&$billto==null&&$shipto==null){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.conversion_rate','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.id','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->whereBetween('bm_order_headers_all.order_number', [$orderfrom,$orderto])
            // ->whereRaw($filter)
            ->get();
        }
        elseif(!is_null($billto)){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.conversion_rate','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.id','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->whereRaw($vendor)
            ->whereBetween('bm_order_headers_all.order_number', [$orderfrom,$orderto])
            // ->whereRaw($filter)
            ->get();
        }
        elseif(!is_null($shipto)){
            $datamodel = SalesOrderDetail::select('bm_order_lines_all.*','bm_order_headers_all.conversion_rate_date','bm_order_headers_all.conversion_rate','bm_order_headers_all.order_number','bm_order_headers_all.cust_po_number',
            'bm_order_headers_all.user_item_description','bm_order_headers_all.attribute1',
            'bm_order_headers_all.attribute2','bm_mtl_system_item.item_code','bm_cust_site_uses_all.party_name','bm_cust_site_uses_all.cust_party_code',
            'bm_order_headers_all.invoice_to_org_id','bm_trx_statuses.trx_name')
            ->leftjoin('bm_order_headers_all','bm_order_headers_all.header_id','=','bm_order_lines_all.header_id')
            ->leftjoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_order_headers_all.invoice_to_org_id')
            ->leftjoin('bm_party_site','bm_party_site.id','=','bm_order_headers_all.deliver_to_org_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_order_lines_all.inventory_item_id')
            ->leftjoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_order_lines_all.flow_status_code')
            ->orderBy('id','DESC')
            ->whereRaw($flag)
            ->whereRaw($vendor)
            ->whereBetween('bm_order_headers_all.order_number', [$orderfrom,$orderto])
            ->get();
        }
        return Datatables::of($datamodel)->make(true);
	}

    // addd by shindi 07/05/2022
    public function data_return(Request $request)
	{
		if($request->input('order')&& $request->input('grn')){
            $order=$request->input('order');
            $grn=$request->input('grn');
        }elseif(!($request->input('order') && $request->input('grn')))
        {
            $grn="";
            $order="";
        }

        $qry = DB::table('bm_c_rcv_shipment_header_id ')
                ->leftjoin('bm_c_rcv_transactions_id', 'bm_c_rcv_transactions_id.shipment_header_id', '=', 'bm_c_rcv_shipment_header_id.shipment_header_id')
                ->leftjoin('bm_po_lines_all', 'bm_po_lines_all.id', '=', 'bm_c_rcv_transactions_id.po_line_location_id')
                ->leftjoin('bm_mtl_system_item', 'bm_mtl_system_item.inventory_item_id', '=', 'bm_c_rcv_transactions_id.item_id')
                ->leftjoin('bm_po_header_all','bm_po_header_all.id','=','bm_c_rcv_transactions_id.po_header_id')
                ->select('bm_po_lines_all.po_header_id', 'bm_po_lines_all.line_id','bm_po_lines_all.id','bm_c_rcv_transactions_id.item_id','bm_mtl_system_item.item_code',
                        'bm_po_lines_all.po_quantity', 'bm_c_rcv_transactions_id.uom_code' ,'bm_c_rcv_transactions_id.item_description', 'bm_po_lines_all.unit_price','bm_c_rcv_transactions_id.transfer_cost','bm_c_rcv_transactions_id.secondary_uom_code','bm_c_rcv_transactions_id.product_category',
                            DB::raw('sum(bm_c_rcv_transactions_id.quantity_received) as rcv,sum(bm_c_rcv_transactions_id.quantity_returned) as rtn'
                            )
                        )
                ->where('bm_po_header_all.type_lookup_code',1) // Dokumen PO
                ->where('bm_po_header_all.status',2)  // Po Approved
                ->where('bm_po_lines_all.line_type_id',1)
                ->where('bm_c_rcv_shipment_header_id.receipt_num','=',$grn) // get vendor id --> Grn
                ->where('bm_po_header_all.segment1','=',$order) // segment = po code -- id = tabel id
                ->where('bm_po_lines_all.quantity_receive', '>', 0)
                ->groupBy('bm_po_lines_all.po_header_id', 'bm_po_lines_all.line_id',
                        'bm_po_lines_all.id','bm_c_rcv_transactions_id.item_id','bm_mtl_system_item.item_code',
                        'bm_po_lines_all.po_quantity', 'bm_c_rcv_transactions_id.uom_code' ,'bm_c_rcv_transactions_id.item_description', 'bm_po_lines_all.unit_price','bm_c_rcv_transactions_id.transfer_cost','bm_c_rcv_transactions_id.secondary_uom_code','bm_c_rcv_transactions_id.product_category')
                ->get();


		$recordsFiltered = count($qry);
        return response()->json([
		    'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsFiltered,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$qry
        ]);
	}

	public function subinventory(Request $request){

        // dd('test');
		$term = $request['term'];
		$results = array();
		$queries = \App\Subinventories::where('sub_inventory_name', 'LIKE', '%'.$term.'%')->orWhere('description','LIKE','%'.$term.'%')->take(10)->get();
		foreach ($queries as $key => $value)
		{
			//$qry[$key]['value'] = $value->sub_inventory_name." - ".$value->description;
		//	$qry[$key]['value1'] = $value->sub_inventory_name;
			$qry[] = array("subinv_code" => $value->sub_inventory_name,"value1"=>$value->sub_inventory_name,"value"=> $value->sub_inventory_name." - ".$value->description);
		}
        // dd($qry);
		return \Response::json($qry);
	}

    public function search_coa(Request $request){
        if($request['term']){
            $term = $request['term'];
        }else{
            $term="";
        }
            $results = array();
            $queries = \App\AccountCode::where('account_code', 'LIKE', '%'.$term.'%')->orWhere('description','LIKE','%'.$term.'%')->take(5)->get();
            if(!empty($queries)){
                foreach ($queries as $key => $value)
                {
                    //$qry[$key]['value'] = $value->sub_inventory_name." - ".$value->description;
                //	$qry[$key]['value1'] = $value->sub_inventory_name;
                    $qry[] = array("coa" => $value->account_code,"value1"=>$value->account_code,"value"=> $value->account_code." - ".$value->description);
                }
                if(!empty($qry)){
                    return \Response::json($qry);
                }
            }
        }

    // Added by shindi 10 Mei 2022
    public function data_receive(Request $request)
	{
		if($request->input('supplier')&& $request->input('orderno')){
			$filter=$request->input('supplier');
			$orderno=$request->input('orderno');
		}else{
			$filter="";
			$orderno="";
		}
		$qry = DB::table('bm_po_header_all')
             ->leftjoin('bm_po_lines_all', 'bm_po_header_all.po_head_id', '=', 'bm_po_lines_all.po_header_id')
             ->leftjoin('bm_vendor_header', 'bm_po_header_all.vendor_id', '=', 'bm_vendor_header.vendor_id')
             ->leftjoin('bm_mtl_system_item', 'bm_po_lines_all.inventory_item_id', '=', 'bm_mtl_system_item.inventory_item_id')
             ->select('bm_po_header_all.rate','bm_po_header_all.rate_date','bm_mtl_system_item.item_code','bm_po_lines_all.inventory_item_id','bm_po_lines_all.quantity_receive','bm_po_lines_all.item_description','bm_po_lines_all.line_id','bm_po_lines_all.po_header_id','bm_po_lines_all.po_quantity','bm_po_lines_all.unit_price','bm_po_lines_all.id','bm_po_lines_all.po_uom_code','bm_po_lines_all.base_uom','bm_po_lines_all.tax_name','bm_mtl_system_item.receiving_inventory','bm_po_lines_all.attribute2')
             ->where('bm_po_header_all.type_lookup_code',1)
             ->where('bm_po_header_all.status',2)
             ->where('bm_po_lines_all.line_status',2)
             ->where('bm_po_lines_all.line_type_id',1)
             ->where('bm_po_lines_all.deleted_at',NULL)
             ->where('bm_vendor_header.vendor_id',"=",$filter)
             ->where('bm_po_header_all.segment1',"=",$orderno)
             ->get();

		$recordsFiltered = count($qry);
		 return response()->json([
		  'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsFiltered,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$qry
        ]);
	}



    //Search Cost Center
    public function cost_center(Request $request) {
		$term = $request['term'];
		$results = array();
		$queries = \App\CcBook::where('cc_name', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->cc_name;
			$qry[$key]['value1'] = $value->cost_center;
		}
		return \Response::json($qry);
	}

    //Filter BOM
    public function bom_code(Request $request){

		$term = $request['term'];
		$results = array();
        $queries = \App\Bom::select('parent_inventory_it','parent_item')
                            ->where('parent_item', 'LIKE', '%'.$term.'%')
                            ->groupBy('parent_inventory_it','parent_item')->get();

		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->parent_item;
			$qry[$key]['id'] = $value->parent_inventory_it;
			$qry[$key]['value1'] = $value->completion_subinventory;
		}
		return \Response::json($qry);
	}

	public function bom_detail(Request $request){

		$term = $request['id'];
		$results = array();
		$queries = \App\Bom::where('parent_inventory_it',$term)->get();
        // dd($queries);
		foreach ($queries as $key => $value)
		{
			  $qry[] = array("id" => $value->parent_inventory_it,
                             "item_code"=>$value->parent_item,
                             "des"=>$value->parent_description,
                             "completion_subinventory"=>$value->completion_subinventory);
		}
		return \Response::json($qry);
	}
    public function search_bom(Request $request){
        $parent = $request['parent'];
		// $results = array();
		$queries = \App\Bom::select('parent_inventory_it','parent_item','parent_description','completion_subinventory')
                            ->where('parent_inventory_it',$parent)
                            ->groupBy('parent_inventory_it','parent_item','parent_description','completion_subinventory')->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->parent_item;
			$qry[$key]['value1'] = $value->completion_subinventory;
		}
        // dd($qry);
		return \Response::json($qry);
    }

    public function workOrder_search(Request $request){
        $rowperpage = $request->get("length"); // total number of rows per page
        $start = $request->get("start");

        $totalRecords = DB::table('bm_bom_bill_of_mtl_interface ')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = DB::table('bm_bom_bill_of_mtl_interface ')->select('count(*) as allcount')->count();

        $parent=$request->input('parent');
        $qry = DB::table('bm_bom_bill_of_mtl_interface ')
                ->select('child_inventory_id', 'child_item', 'child_description', 'uom', 'usage','supply_subinventory')
                ->skip($start)
                ->take($rowperpage)
                ->where('parent_inventory_it',$parent) // Dokumen PO
                ->get();

		$recordsFiltered = count($qry);
        return response()->json([
		    'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsFiltered,
            'recordsFiltered'=>$recordsFiltered,
            "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
            'data'=>$qry
        ]);
    }
	public function product_category(Request $request) {
		$term = $request['term'];
		$results = array();
		$queries = \App\Category::where('category_code', 'LIKE', '%'.$term.'%')->OrWhere('category_name','LIKE','%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value1'] = $value->category_name;
            $qry[$key]['value'] = $value->category_code;
		}
		return \Response::json($qry);
	}
    public function product_subcategory(Request $request) {
		$term = $request['term'];
		$results = array();
		$queries = \App\SubCategory::where('sub_cat_code', 'LIKE', '%'.$term.'%')->OrWhere('sub_cat_name','LIKE','%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value1'] = $value->sub_cat_name;
            $qry[$key]['value'] = $value->sub_cat_code;
		}
		return \Response::json($qry);
	}
	  public function product_subcategory_det(Request $request) {
		$term = $request['term'];
		$results = array();
		$queries = \App\SubCategory::where('sub_cat_code', 'LIKE', '%'.$term.'%')->OrWhere('sub_cat_name','LIKE','%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[] = array("subcategory" => $value->sub_cat_name);
		}
		return \Response::json($qry);
	}

    public function data_grn(Request $request)
	{
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');

        if (!empty($request->get('search'))) {
            $searchValue=$request->get('search');

        }else{
            $searchValue="";
        }

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        //$searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\RcvHeader::count();
        $totalRecordswithFilter = \App\RcvHeader::select('count(*) as allcount')->where([['receipt_num', 'like', '%' . $searchValue . '%']])
        ->count();

        $records = RcvHeader::select(\DB::raw('bm_po_header_all.segment1,bm_c_rcv_shipment_header_id.currency_code,bm_c_rcv_shipment_header_id.shipment_header_id, bm_c_rcv_shipment_header_id.invoice_status_code,
                 bm_c_rcv_shipment_header_id.packing_slip,bm_c_rcv_shipment_header_id.currency_code,bm_c_rcv_shipment_header_id.vendor_id,bm_c_rcv_shipment_header_id.receipt_num,bm_c_rcv_shipment_header_id.gl_date, SUM(bm_c_rcv_transactions_id.quantity_received * shipment_unit_price) as receive_amount'))
                 ->leftJoin('bm_c_rcv_transactions_id', 'bm_c_rcv_shipment_header_id.shipment_header_id', '=', 'bm_c_rcv_transactions_id.shipment_header_id')
                 ->leftjoin('bm_po_header_all', 'bm_po_header_all.id', '=', 'bm_c_rcv_transactions_id.po_header_id')
                 ->groupby('bm_c_rcv_transactions_id.shipment_header_id','bm_c_rcv_shipment_header_id.shipment_header_id','bm_c_rcv_shipment_header_id.receipt_num', 'bm_c_rcv_shipment_header_id.invoice_status_code',
                 'bm_c_rcv_shipment_header_id.vendor_id','bm_c_rcv_shipment_header_id.currency_code','bm_c_rcv_shipment_header_id.gl_date','bm_c_rcv_shipment_header_id.packing_slip','bm_po_header_all.segment1','bm_c_rcv_shipment_header_id.currency_code')
                 ->where(function($query) use($searchValue) {
                     $query
                     ->Orwhere('receipt_num', 'LIKE', '%'.$searchValue.'%')
                     ->where('bm_c_rcv_shipment_header_id.invoice_status_code','=',0)
                     ->Orwhere('packing_slip', 'LIKE', '%'.$searchValue.'%');
                 })
                 ->get();
        $data_arr = array();
        foreach ($records as $record) {

            $data_arr[] = array(
                "receipt_num" => $record->receipt_num,
                "segment1" => $record->segment1 ?? '',
                "vendor_name" => $record->vendor->vendor_name,
                "vendor_id" => $record->vendor_id,
                "packing_slip" => $record->packing_slip,
                "currency_code" => $record->currency_code ?? '',
                "receive_amount" => number_format($record->receive_amount,2),
                "gl_date" => $record->gl_date->format('d-M-Y'),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);

	}

    public function acc_code(Request $request)
    {
        abort_if(Gate::denies('acc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\AccountCode::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\AccountCode::select('count(*) as allcount')->where('account_code', 'like', '%' . $searchValue . '%')
        ->orWhere('description', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\AccountCode::orderBy('account_code','asc')
            ->where('account_code', 'like', '%' . $searchValue . '%')
            ->orWhere('description', 'like', '%' . $searchValue . '%')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        $data_arr = array();

        foreach ($records as $record) {
            $data_arr[] = array(
                "id" =>  (string)$record->id,
                "account_code" => $record->account_code,
                "parent_code" => $record->parent_code,
                "description" => $record->description,
                "type" => $record->type,
                "account_group" => $record->account_group,
                "level" => $record->level,
                "created_at" => $record->created_at?$record->created_at->format('d-m-Y'):'NULL',
                "updated_at" => $record->updated_at?$record->updated_at->format('d-m-Y'):'NULL'
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    //Search AP Item
    public function ap_item(Request $request){

		$term = $request['term'];
		$results = array();
		$queries = \App\ItemMaster::where('item_code', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->item_code." - ".$value->description;
			$qry[$key]['value1'] = $value->inventory_item_id;
		}
		return \Response::json($qry);
	}

	public function ap_item_detail(Request $request){
        //sales
		$term = $request['id'];
		$results = array();
		$queries = \App\ItemMaster::where('inventory_item_id', '=',$term)->get();
		foreach ($queries as $key => $value)
		{
			  $qry[] = array("inv_id" => $value->inventory_item_id,
                             "description"=>$value->description,
                             "item_code"=>$value->item_code,
                             "uom"=>$value->primary_uom_code,
                             "type_code"=>$value->type_code,
                             "accDes"=>$value->payable_account_code,
                            'acc'=>$value->category->inventory_account_code, //inventory_account
                             'acc_des'=>$value->category->inventory->description, //inventory_account
                             'payable'=>$value->category->payable_account_code, //payable_account
                             'payable_des'=>$value->category->payable->description, //payable_account
                            );

		}
		return \Response::json($qry);
	}

    // search AR Item
    public function ar_item(Request $request){

		$term = $request['term'];
		$results = array();
		$queries = \App\ItemMaster::where('item_code', 'LIKE', '%'.$term.'%')->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->item_code." - ".$value->description;
			$qry[$key]['value1'] = $value->inventory_item_id;
		}
		return \Response::json($qry);
	}

	public function ar_item_detail(Request $request){
        //sales
		$term = $request['id'];
		$results = array();
		$queries = \App\ItemMaster::where('inventory_item_id', '=',$term)->get();
		foreach ($queries as $key => $value)
		{
			  $qry[] = array("inv_id" => $value->inventory_item_id,
                             "description"=>$value->description,
                             "item_code"=>$value->item_code,
                             "uom"=>$value->primary_uom_code,
                             "acc"=>$value->category->inventory_account_code,
                             "acc_ar"=>$value->category->attribute1,
                             "type_code"=>$value->type_code,
                             "accDes"=>$value->category->inventory_account_code."  ".$value->category->inventory->description,
                             "accDes_ar"=>$value->category->attribute1."  ".$value->category->acc->description,
                             "accDes_ar2"=>$value->category->acc->description
                            );

		}
		return \Response::json($qry);
	}

    public function acc_search(Request $request){

		$term = $request['term'];
		$results = array();
		$queries = \App\AccountCode::where('account_code', 'LIKE', '%'.$term.'%')
                                    ->orWhere('description', 'LIKE', '%'.$term.'%')
                                    ->take(5)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->account_code." - ".$value->description;
			$qry[$key]['value1'] = $value->account_code;
		}
		return \Response::json($qry);
	}

	public function acc_search_detail(Request $request){

		$term = $request['id'];
		$results = array();
		$queries = \App\AccountCode::where('account_code', '=',$term)->get();
		foreach ($queries as $key => $value)
		{
			  $qry[] = array("acc" => $value->account_code,
                             "accDes"=>$value->account_code." - ".$value->description,
                             "dess"=>$value->description);
		}
		return \Response::json($qry);
	}
    public function rcv_report(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $min = $request->get('min') ?? Carbon::now()->startOfYear();
        $max = $request->get('max') ?? Carbon::now()->endOfYear();
        $vendor = $request->get('vendor') ?? '%';
        $rev = $request->get('rev') ?? '';

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        $header_id = \App\PurchaseOrder::where('segment1',$searchValue)->first();
        $head_id = $header_id->po_head_id ?? '';

        // Total records
        $totalRecords = \App\RcvDetail::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\RcvDetail::select('count(*) as allcount')->whereHas('rcvheader', function ($header) use ($searchValue){
            $header->Where('receipt_num', 'like', '%' . $searchValue . '%')->OrWhere('packing_slip', 'like', '%' . $searchValue . '%');})
            ->OrwhereHas('PurchaseOrder', function ($po) use ($searchValue){
                $po->Where('segment1', 'like', '%' . $searchValue . '%');})
        ->count();
        $records = \App\RcvDetail::orderBy('bm_c_rcv_transactions_id.created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->leftjoin('bm_c_rcv_shipment_header_id','bm_c_rcv_shipment_header_id.shipment_header_id','=','bm_c_rcv_transactions_id.shipment_header_id')
            ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_c_rcv_transactions_id.item_id')
            ->where(function($query) use($vendor,$min,$max,$rev,$searchValue){
                $query->WhereBetween('gl_date',[$min,$max])
                    ->Where('vendor_id','like','%' . $vendor . '%');
            })
            ->where('po_header_id','like','%' . $head_id . '%')
            ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,
                "transaction_type" => $raw->transaction_type,
                "PO" =>$raw->PurchaseOrder->segment1 ?? $raw->sales->order_number ?? '',
                "vendor_name" =>$raw->PurchaseOrder->vendor->vendor_name ?? '',
                "vendor_site" =>$raw->RcvHeader->vendor_site->address1 ?? '',
                "country" =>$raw->RcvHeader->vendor_site->country ?? $raw->PurchaseOrder->vendor->country ?? '',
                "item_code" => $raw->item_code,
                "sub_category" =>  $raw->product_category ?? $raw->attribute2,
                "packing_slip" =>  $raw->packing_slip,
                "po_quantity" => $raw->purchaseorderdet->po_quantity?? '',
                "currency" => $raw->RcvHeader->currency_code??'',
                "aju_number" => $raw->RcvHeader->attribute1??'NULL',
                "unit_price" => $raw->purchaseorderdet->unit_price?? '',
                "quantity_received" => number_format((float)$raw->quantity_received-$raw->quantity_returned,3, '.', '') ?? $raw->quantity_received,
                "quantity_accepted" => number_format((float)$raw->quantity_accepted, 3, '.', '') ,
                "conv_qty" => number_format((float)$raw->secondary_quantity_received, 0, '.', '') ??($raw->quantity_received ||$raw->quantity_returned),
                "gl_date" => $raw->gl_date,
                "uom" => $raw->uom_code,
                "grn" => $raw->receipt_num,
                "comments" => $raw->RcvHeader->comments??'NULL',
                "item_desc" => $raw->item_description,

            );
        }
        // dd($data_arr);
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function rcv_index(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $totalRecords = \App\RcvDetail::select('count(*) as allcount')->count();
       
        $records = \App\RcvDetail::where('quantity_received', '>', 0)->get();

        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,
                "po" =>$raw->RcvHeader->attribute1,
                "vendor" =>$raw->RcvHeader->vendor->vendor_name,
                "rcv_num" =>$raw->RcvHeader->receipt_num,
                "wh" =>$raw->RcvHeader->warehouse->description,
                "idr" =>$raw->RcvHeader->currency_code,
                "category" =>$raw->category->description,
                "uom" =>$raw->uom_code,
                "item" => Str::limit($raw->itemmaster->description, 10, '...'),
                "date" => $raw->created_at ? $raw->created_at->format('d-M-Y') : '-',
                "qty" => (intval($raw->quantity_received) == $raw->quantity_received) ? intval($raw->quantity_received) : $raw->quantity_received,
                "status" =>$raw->RcvHeader->invoice_status_code,
            );
        }
        // dd($data_arr);
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function po_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\PurchaseOrder::select('count(*) as allcount')->where('type_lookup_code','=',1)->count();
        $totalRecordswithFilter = \App\PurchaseOrder::select('count(*) as allcount')->Where([['segment1', 'like', '%' . $searchValue . '%'],['type_lookup_code','=',1]])->count();

        // Get records, also we have included search filter as well
        $records = \App\PurchaseOrder::orderBy('created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->OrWhere('segment1', 'like', '%' . $searchValue . '%')
            ->where('type_lookup_code','=',1)
            ->get();
        $data_arr = array();
        // dd($records);
        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,
                "order_number" => $raw->segment1,
                "po_head_id" => $raw->po_head_id,
                "vendor_id" =>$raw->vendor_id,
                "vendor_name" =>$raw->vendor->vendor_name ??'',
                "currency" => $raw->currency_code,
                "rate_date" =>  $raw->rate_date,
                "agent_id" => $raw->user->name ?? '',
                "status" => $raw->trxStatuses->trx_name ?? '',
                "created_at" => $raw->created_at->format('d-m-Y'),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function item_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\ItemMaster::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\ItemMaster::select('count(*) as allcount')->Where('item_code', 'like', '%' . $searchValue . '%')->Orwhere('description','like', '%' . $searchValue . '%')->Orwhere('mapping_item','like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = \App\ItemMaster::orderBy('created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->Where('item_code', 'like', '%' . $searchValue . '%')
            ->Orwhere('description','like', '%' . $searchValue . '%')
            ->Orwhere('mapping_item','like', '%' . $searchValue . '%')
            ->get();
        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->inventory_item_id,
                "item_code" => $raw->item_code,
                "description" =>$raw->description,
                "type_code" =>$raw->type_code,
                "primary_uom_code" => $raw->primary_uom_code,
                "category_code" =>  $raw->category->category_name?? '',
                "sub_category" =>  $raw->attribute2,
                "receiving_inventory" =>  $raw->receiving_inventory?? $raw->shipping_inventory ,
                "location" => $raw->attribute1,
                "img_path" => $raw->img_path,
                "created_at" => optional($raw->created_at)->format('d-m-Y') ?? '-',        
                "updated_at" => optional($raw->updated_at)->format('d-m-Y') ?? '-',
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    public function op_unit(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $search_arr = $request->get('search');
        $rowperpage = $request->get("length");

        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        $totalRecords = \App\OperationUnit::select('count(*) as allcount')->where('id','=',1)->count();
        $totalRecordswithFilter = \App\OperationUnit::select('count(*) as allcount')->Where('name', 'like', '%' . $searchValue . '%')->Orwhere('name','like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = \App\OperationUnit::orderBy('created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,
                "unit_id" => $raw->unit_id,
                "image_id" => $raw->unit_id,
                "short_name" =>$raw->short_name,
                "name" =>$raw->name,
                "capacity" => $raw->capacity,
                "range_capacity_max" =>  $raw->range_capacity_max,
                "range_capacity_min" => $raw->range_capacity_min,
                "machine_status" => $raw->machine_status,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function trf_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\MaterialTxns::select('count(*) as allcount')->where('transaction_type_id',12)->count();
        $totalRecordswithFilter = \App\MaterialTxns::select('count(*) as allcount')->where('transaction_type_id',12)->count();

        // Get records, also we have included search filter as well
        $records = \App\MaterialTxns::orderBy('created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->Where([['transaction_type_id',12]])
       //     ->Orwhere('description','like', '%' . $searchValue . '%')
            ->get();
        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->inventory_item_id,
                "item_code" => $raw->itemmaster->item_code,
                "product" => $raw->itemmaster->item_code."-".$raw->itemmaster->description ,
                "description" =>$raw->itemmaster->description,
                "category" =>$raw->itemmaster->attribute2,
                "type_code" =>$raw->transaction_uom,
                "transaction_reference" => $raw->transaction_reference,
                "subinventory_code" =>$raw->subinventory->description."-".$raw->subinventory_code,
                "transfer_subinventory" => $raw->tfsubinventory->description ."-".$raw->transfer_subinventory,
                "transaction_quantity" => number_format($raw->transaction_quantity,0),
                "primary_uom_code" => $raw->transaction_uom,
                "transaction_date" => $raw->transaction_date->format('d-M-Y'),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function pr_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\PurchaseRequisition::select('count(*) as allcount')->whereNotNull('authorized_status')->count();
        $totalRecordswithFilter = \App\PurchaseRequisition::select('count(*) as allcount')->whereNotNull('authorized_status')->count();

        // Get records, also we have included search filter as well
        $records = \App\PurchaseRequisition::orderBy('bm_req_header_all.created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->whereNotNull('authorized_status')
            ->get();
        $data_arr = array();

        foreach ($records as $raw) {
            //   if ($raw->app_lvl==0 & $raw->authorized_status != 13){
            //         $status = "Submit To ".$raw->createdby->userManager->name ?? '#NA';
            //     }elseif($raw->app_lvl==1){
            //         $status = "Next Approval ".$raw->applvl->name ?? '#NA';
            //     }elseif (in_array($raw->app_lvl, [2,3,4])){
            //     $status = "Next Approval ".$raw->applvl->name ?? '';
            //     }elseif ($raw->app_lvl==12 & $raw->authorized_status != 13){
            //         $status="Approved";
            //     }elseif ($raw->authorized_status == 13){
            //         $status="Rejected";
            //     }else{
            //         $status=$raw->TrxStatuses->trx_name ?? '';
            //     }

            $data_arr[] = array(
                "id" =>$raw->id,
                "pr_number" => $raw->segment1 ?? '',
                "user" =>$raw->user->name ??'',
                "status" => $status ?? '' ,
                "created_at" => $raw->created_at->format('d-m-Y'),
                "action" =>$raw->user->name ?? '',
                "authorized_status" =>$raw->authorized_status,
                "intattribute1" =>$raw->intattribute1,
                "created_by" =>$raw->created_by,
                "app_lvl" =>$raw->app_lvl,
                "login" =>auth()->user()->id,
                "user_manager" =>auth()->user()->userManager->name ?? '',
                "usrmgr" =>(int)$raw->getAppMgr->user_manager ?? '',
                "userstatus" =>auth()->user()->user_status ?? '',
                // "userstatus" =>$raw->RequisitionDetail->header_id,
            );
            // dd($data_arr);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function pr_detail(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\RequisitionDetail::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\RequisitionDetail::select('count(*) as allcount')->count();

        // Get records, also we have included search filter as well
        $records = \App\RequisitionDetail::orderBy('bm_req_det_all.created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        $data_arr = array();
        // dd($records);
        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,

            );
            dd($data_arr);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    public function pr_detail_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\PurchaseRequisitionDet::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\PurchaseRequisitionDet::select('count(*) as allcount')->count();

        // Get records, also we have included search filter as well
        $records = \App\PurchaseRequisitionDet::orderBy('bm_req_det_all.purchase_status','asc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            if($raw->purchase_status==3){ //created in PO
                $status = 'Imported to Purchase';
            }elseif($raw->purchase_status==2){
                $status = 'Need to Import';
            }elseif($raw->purchase_status==13){
                $status = 'Rejected';
            }else{
                $name = $raw->pr_header->applvl->name ?? $raw->pr_header->createdby->userManager->name ?? '#NA';
                $status = 'Waiting Approval from '.$name;
            }
            $data_arr[] = array(
                "id" =>$raw->id,
                "pr_number" => $raw->pr_header->segment1 ?? '',
                "cost_center" => $raw->pr_header->ccbook->cc_name ?? '',
                "item" => $raw->itemMaster->item_code." - ".$raw->itemMaster->description,
                "qty" => $raw->quantity,
                "user" =>$raw->user->name ?? '',
                "status" => $status ,
                "action" =>$raw->user->name ?? '',
                "purchase_status" =>$raw->purchase_status ?? '',
                "intattribute1" =>$raw->intattribute1,
                "created_by" =>$raw->created_by,
                "app_lvl" =>$raw->pr_header->app_lvl  ?? '',
                "uom" =>$raw->pr_uom_code,
                "login" =>auth()->user()->id,
                "user_manager" =>auth()->user()->userManager->name ?? '',
                // "usrmgr" =>(int)$raw->pr_header->getAppMgr->user_manager ?? '',
                "userstatus" =>auth()->user()->user_status ?? '',
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    public function uom_conversion(Request $request)
    {
        $term = $request->input('term');
        $term2 = $request->input('term2');

        $queries = \App\UomConversion::where('uom_code', 'LIKE', "%{$term}%")
            ->where('inventory_item_id', $term2)
            ->get();

        $results = [];

        foreach ($queries as $value) {
            $results[] = [
                'value'  => $value->interior_unit_code,
                'value1' => $value->conversion_id,
                'value2' => $value->uom_code,
            ];
        }

        return response()->json($results);
    }


    public function uom_conversion_detail(Request $request)
    {
		$term = $request['term'];
		$results = array();
		$queries = \App\UomConversion::where('conversion_id','=', $term )->get();
		foreach ($queries as $key => $value)
		{
			$qry[] = array("uom_conversion" => $value->interior_unit_code,
                             "rate"=>$value->conversion_rate);
		}
		return \Response::json($qry);
	}

    public function ap_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords =\App\AccPayHeader::select('count(*) as allcount')->where('job_definition_name','Payable')->count();
        $totalRecordswithFilter =\App\AccPayHeader::select('count(*) as allcount')->where('job_definition_name','Payable')->count();

        // Get records, also we have included search filter as well
        $records =\App\AccPayHeader::orderBy('created_at','ASC')
            ->where('job_definition_name','Payable')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($records as $raw) {
            if ($raw->routing_status_lookup_code  == 0){
                $status = '<a class="badge bg-secondary text-white">Draft</a>';
            }else if ($raw->routing_status_lookup_code == 1){
                $status = '<a class="badge bg-warning text-white">Validate</a>';
            }else if ($raw->routing_status_lookup_code == 2){
                $status = '<a class="badge bg-success text-white">Account Posted</a>';
            }else if ($raw->routing_status_lookup_code == 4){
                $status = '<a class="badge bg-primary text-white">'.$raw->payment_status_flag.'</a>';
            }else{
                $status = '<a class="badge bg-danger text-white">Cancel</a>';
            }
            $data_arr[] = array(
                "id" =>$raw->id,
                "invoiceID" =>$raw->invoice_id,
                "vendorID" =>$raw->vendor->vendor_name,
                "invoice" =>$raw->invoice_num,
                "voucher_num" =>$raw->voucher_num,
                "invoice_date" =>$raw->invoice_date->format('d-M-Y'),
                "invoice_received_date" => isset($raw->invoice_received_date) ? $raw->invoice_received_date->format('d-M-Y') : '',
                "gl_date" =>$raw->gl_date,
                "currency" =>$raw->invoice_currency_code,
                "tax_amount" =>number_format($raw->total_tax_amount,2),
                "invoice_amount" =>number_format($raw->invoice_amount,2),
                "status" =>$status,
            );
        }
        // dd($data_arr);
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function credit_memo(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords =\App\AccPayHeader::select('count(*) as allcount')->where('job_definition_name','Credit Memo')->count();
        $totalRecordswithFilter =\App\AccPayHeader::select('count(*) as allcount')->where('job_definition_name','Credit Memo')->count();

        // Get records, also we have included search filter as well
        $records =\App\AccPayHeader::orderBy('created_at','ASC')
            ->where('job_definition_name','Credit Memo')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($records as $raw) {
            if ($raw->routing_status_lookup_code  == 0){
                $status = '<a class="badge bg-secondary text-white">Draft</a>';
            }else if ($raw->routing_status_lookup_code == 1){
                $status = '<a class="badge bg-warning text-white">Validate</a>';
            }else if ($raw->routing_status_lookup_code == 2){
                $status = '<a class="badge bg-info text-white">Account Posted</a>';
            }else if ($raw->routing_status_lookup_code == 4){
                $status = '<a class="badge bg-primary text-white">'.$raw->payment_status_flag.'</a>';
            }else{
                $status = '<a class="badge bg-danger text-white">Cancel</a>';
            }
            $data_arr[] = array(
                "id" =>$raw->invoice_id,
                "invoiceID" =>$raw->invoice_id,
                "vendorID" =>$raw->vendor->vendor_name,
                "invoice" =>$raw->invoice_num,
                "voucher_num" =>$raw->voucher_num,
                "invoice_date" =>$raw->invoice_date->format('d-M-Y'),
                "invoice_received_date" => isset($raw->invoice_received_date) ? $raw->invoice_received_date->format('d-M-Y') : '',
                "gl_date" =>$raw->gl_date,
                "currency" =>$raw->invoice_currency_code,
                "tax_amount" =>number_format($raw->total_tax_amount,2),
                "invoice_amount" =>number_format($raw->invoice_amount,2),
                "status" =>$status,
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function po_atp(Request $request){

        $draw = $request->get('draw');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        $records = \App\PurchaseOrderDet::LeftJoin('bm_atp_reply_id',[['bm_atp_reply_id.po_header_id','=','bm_po_lines_all.po_header_id'],['bm_atp_reply_id.po_line_id','=','bm_po_lines_all.line_id']])
            ->select('bm_po_lines_all.line_id','bm_po_lines_all.po_header_id','bm_po_lines_all.inventory_item_id','bm_po_lines_all.item_description','bm_po_lines_all.po_quantity','bm_po_lines_all.unit_price', DB::raw('SUM(atp_qty) as atp_qty'))
            ->where('bm_po_lines_all.po_header_id','=',$searchValue)
            ->groupBy('bm_po_lines_all.line_id','bm_po_lines_all.po_header_id','bm_po_lines_all.inventory_item_id','bm_po_lines_all.item_description','bm_po_lines_all.po_quantity','bm_po_lines_all.unit_price')
            ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->line_id,
                "po_header_id" =>$raw->po_header_id,
                "inventory_item_id" =>$raw->inventory_item_id,
                "product" =>$raw->item_code ."-".$raw->item_description ,
                "qty" =>$raw->po_quantity-$raw->atp_qty,
                "price" =>$raw->unit_price,
                "description" =>$raw->item_description,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $records->count(),
            "iTotalDisplayRecords" =>$records->count(),
            "aaData" => $data_arr,
        );

        return json_encode($response);
	}
    public function atp_data(Request $request){

        $draw = $request->get('draw');
        $order_arr = $request->get('order');
        $ordernumber = $request->get('ordernumber');
        $search_arr = $request->get('search');
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        $records = \App\AtpReply::orderBy('created_at','desc')
            ->select('*')
          ->where([['order_number','=',$ordernumber],['reference','=',$searchValue]])
            ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,
                "inventory_item_id" =>$raw->inventory_item_id,
                "product" =>$raw->item_code ."-".$raw->item_description ,
                "qty" =>$raw->atp_qty,
                "price" =>$raw->atp_price,
                "description" =>$raw->item_description,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $records->count(),
            "iTotalDisplayRecords" =>$records->count(),
            "aaData" => $data_arr,
        );

        return json_encode($response);
	}

    public function data_missExpense(Request $request)
    {
        $term = $request['lineId']; //rcv header id
        $aju = $request['aju'];
        $rate = $request['rate']; // rate
        // $price = $request['price']; // price
        $logistic = $request['logistic']; // total EMKL
        $cont = $request['cont']; // Container
        $kso = $request['kso']; // Container


        $queries = RcvDetail::leftJoin('bm_c_rcv_shipment_header_id as rh','rh.shipment_header_id','=','bm_c_rcv_transactions_id.shipment_header_id')
                            ->select('bm_c_rcv_transactions_id.*')
                            ->where('rh.attribute1',$aju)->get();

        $qty=0;
		foreach ($queries as $key => $value)
		{
            $qty += $value->secondary_quantity_received ?? $value->intattribute2;
        }
            $price = round($value->transfer_cost,3);

            $total = $qty * $price; //get total original price
            $conversion = $total * $rate; // total Conversion

            $asuransi1 = ($total * 0.0008)+2 +0.45 ; // get persentace asurance

                if ($asuransi1 <= 17.45){
                    $asuransi1 = 17.45;
                }

            $asuransi =  round($asuransi1 ,2)* $rate; // asurance X rate

            $lc = (($total * 4 * 0.001) + 15) * $rate; // lc cost
            $pph = 0.025 * $conversion;
            $totalCost = $asuransi + $lc + $kso+ $logistic+$pph; // total cost
            $itemCost = $totalCost /  $qty ; // cost per item
            $priceItem = round((($conversion / $qty ) + $itemCost),0) ; // price per item

            $qry[] = array(
                "price" => $price,
                "lc" => $lc,
                "asuransi" => $asuransi,
                "kso" =>$kso,
                "totalCost" =>$totalCost,
                "itemCost" =>$itemCost,
                "priceItem" =>$priceItem
            );

		return \Response::json($qry);
    }

    public function data_sales(Request $request)
	{
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = DB::table('bm_view_order_planning')->select('count (*) as allcount')->count();
        $totalRecordswithFilter = DB::table('bm_view_order_planning')->select('count (*) as allcount')->count();

        // Get records, also we have included search filter as well
        $records = DB::table('bm_view_order_planning')
                    ->where(function($query) use($searchValue) {
                        $query
                        ->orWhere('user_description_item', 'like', '%' . $searchValue . '%')
                        ->orWhere('opration', 'like', '%' . $searchValue . '%');
                    })
                    ->orderBy('schedule_ship_date','asc')
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();

        $data_arr = array();

        foreach ($records  as  $key => $record) {

            $data_arr[] = array(
                "id" => $key +1,
                "sales_header_id" =>   $record->sales_header_id,
                "order_number" =>   $record->order_number,
                "cust_po_number" =>   $record->cust_po_number,
                "customer_name" => $record->party_name,
                "invoice_to_org_id" => $record->invoice_to_org_id,
                "inventory_item_id" =>   $record->inventory_item_id,
                "item_code" =>   $record->user_description_item,
                "width" =>   $record->width,
                "length" =>   $record->attribute_number_l,
                "gsm" =>   $record->attribute_number_gsm,
                "ordered_quantity" =>  (float) $record->qty,
                "schedule_ship_date" =>date('d-M-Y',strtotime($record->schedule_ship_date)),
                "opration" =>   $record->opration,
                "roll" =>   $record->roll,
                "shipping_inventory" =>   $record->shipping_inventory,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);

	}

    public function mtl_trx_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\MaterialTxns::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\MaterialTxns::select('count(*) as allcount')->count();

        // Get records, also we have included search filter as well
        $records = \App\MaterialTxns::orderBy('created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
         // ->Where([['transaction_type_id',12]])
       //   ->Orwhere('description','like', '%' . $searchValue . '%')
            ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->inventory_item_id,
                "item_code" => $raw->itemmaster->item_code,
                "description" =>$raw->itemmaster->description,
                "primary_qty" =>isset($raw->secondary_transaction_quantity) ? number_format($raw->secondary_transaction_quantity,2) : number_format($raw->transaction_quantity,2),
                "secondary_uom" =>isset($raw->secondary_uom_code) ? $raw->secondary_uom_code : $raw->transaction_uom,
                "category" =>$raw->itemmaster->attribute2,
                "type_code" =>$raw->transaction_uom,
                "transaction_reference" => $raw->transaction_reference,
                "receiving_document" => $raw->receiving_document,
                "subinventory_code" =>$raw->subinventory->description ?? ''."-".$raw->subinventory_code,
                "attribute_category" =>$raw->attribute_category,
                "transfer_subinventory" => isset($raw->tfsubinventory->description)? $raw->tfsubinventory->description:''."-". $raw->transfer_subinventory,
                "transaction_quantity" => number_format($raw->transaction_quantity,2),
                "primary_uom_code" => $raw->transaction_uom,
                "transaction_cost" => (float)$raw->transaction_cost,
                "transaction_date" => $raw->transaction_date->format('d-M-Y'),
                "transaction_source_name" => $raw->transaction_source_name,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    //Quality Managament
    public function qm_report(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $min = $request->get('min') ?? Carbon::now()->startOfYear();
        $max = $request->get('max') ?? Carbon::now()->endOfYear();
        $vendor = $request->get('vendor') ?? '%';
        $rev = $request->get('rev') ?? '';

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\QualityManagement::select('count(*) as allcount')->count();
        // $totalRecordswithFilter = \App\QualityManagement::select('count(*) as allcount')->whereHas('rcvheader', function ($header) use ($searchValue){
        //     $header->Where('receipt_num', 'like', '%' . $searchValue . '%')->OrWhere('packing_slip', 'like', '%' . $searchValue . '%');})
        //     ->OrwhereHas('PurchaseOrder', function ($po) use ($searchValue){
        //         $po->Where('segment1', 'like', '%' . $searchValue . '%');})
        // ->count();

        $records = \App\QualityManagement::orderBy('bm_mtl_qlty_mgm.created_at','desc')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id"=>$raw->id,
                "attribute_aju"=>$raw->attribute_aju,
                "vendor"=>$raw->Rcvheader->vendor->vendor_name ?? '',
                "inventory_item_id"=>$raw->itemmaster->item_code ?? '',
                "item_type"=>$raw->item_type,
                "quantity"=>number_format((float)$raw->quantity,3, '.', ''),
                "attribute_long"=>number_format((float)$raw->attribute_long,3, '.', ''),
                "attribute_short"=>number_format((float)$raw->attribute_short,3, '.', ''),
                "attribute_outtrhow"=>number_format((float)$raw->attribute_outtrhow,3, '.', ''),
                "attribute_prohibitive"=>number_format((float)$raw->attribute_prohibitive,3, '.', ''),
                "attribute_moisture"=>number_format((float)$raw->attribute_moisture,3, '.', ''),
                "attribute_grade"=>$raw->attribute_grade,
                "intattribute1"=>$raw->intattribute1,
                "intattribute2"=>$raw->intattribute2,
                "intattribute3"=>$raw->intattribute3,
                "intattribute4"=>$raw->intattribute4,
                "intattribute5"=>$raw->intattribute5,
                "date_time"=>$raw->date_time,
                "attribute_free"=>$raw->attribute_free,
                "attribute_gsm"=>$raw->attribute_gsm,
                "attribute_thick"=>$raw->attribute_thick,
                "attribute_bright"=>$raw->attribute_bright,
                "attribute_light"=>$raw->attribute_light,
                "attribute_ash"=>$raw->attribute_ash,
                "attribute_bst"=>$raw->attribute_bst,
                "attribute_rct"=>$raw->attribute_rct,
                "attribute_density"=>$raw->attribute_density,
                "attribute_strength"=>$raw->attribute_strength,
                "attribute_hydra"=>$raw->attribute_hydra,
                "attribute_note"=>$raw->attribute_note,
            );
        }
        // dd($data_arr);
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            // "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    public function qm_fg_report(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\FgQuality::select('count(*) as allcount')->count();

        $records = \App\FgQuality::select('inventory_item_id', 'uniq_attribute_roll', 'attribute_char', 'reference', 'transaction_date',
                        DB::raw('AVG(attribute_number_1) as gsm'),DB::raw('AVG(attribute_number_2) as mois'),DB::raw('AVG(attribute_number_3) as thick'),DB::raw('AVG(attribute_number_4) as bursting'),
                        DB::raw('AVG(attribute_number_5) as ring'),DB::raw('AVG(attribute_number_6) as ply'),DB::raw('AVG(attribute_number_7) as cobbTop'),DB::raw('AVG(attribute_number_8) as cobbBottom'))
            ->groupBy('inventory_item_id', 'uniq_attribute_roll', 'attribute_char', 'reference', 'transaction_date')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                // "id"=>$raw->id,
                'inventory_item_id'=>$raw->itemmaster->item_code,
                'uniq_attribute_roll' => $raw->uniq_attribute_roll,
                'gsm' => number_format((float)$raw->gsm, 2, '.', ''),
                'mois' =>  number_format((float)$raw->mois, 2, '.', ''),
                'thick' =>  number_format((float)$raw->thick, 2, '.', ''),
                'bursting' =>  number_format((float)$raw->bursting, 2, '.', ''),
                'ring' =>  number_format((float)$raw->ring, 2, '.', ''),
                'ply' =>  number_format((float)$raw->ply, 2, '.', ''),
                'cobbTop' =>  number_format((float)$raw->cobbTop, 2, '.', ''),
                'cobbBottom' =>  number_format((float)$raw->cobbBottom, 2, '.', ''),
                // 'attribute_num_quality' => $raw->attribute_num_quality,
                'attribute_char' => $raw->attribute_char,
                'reference' => $raw->reference,
                'transaction_date' => $raw->transaction_date,
            );
        }
        // dd($data_arr);
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            // "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    public function onhand_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');


        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\Onhand::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\Onhand::select('count(*) as allcount')->count();

        // Get records, also we have included search filter as well
        // $records = \App\Onhand::leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_inv_onhand_quantities_detail.inventory_item_id')
        //     ->orderBy('bm_inv_onhand_quantities_detail.id','ASC')
        //     ->select('bm_inv_onhand_quantities_detail.*')
        //     ->skip($start)
        //     ->take($rowperpage)
        //     ->where([['bm_mtl_system_item.deleted_at','=',NULL],['bm_mtl_system_item.description','like', '%' . $searchValue . '%']])
        //     ->Orwhere([['bm_mtl_system_item.item_code','like', '%' . $searchValue . '%']])
        //     ->get();
        // Bagian 1: Buat subquery untuk menghitung total pengiriman.
        // Ini adalah padanan dari "WITH DeliveryData AS (...)" dalam SQL.
        // Subquery 1: Menghitung total pengiriman (delivery)
        $deliveryQuery = DB::table('bm_wsh_delivery_details')
            ->select(
                'inventory_item_id',
                'subinventory',
                DB::raw('SUM(delivered_quantity) as total_delivered_quantity')
            )
            ->groupBy('inventory_item_id', 'subinventory');

        // Subquery 2: Menghitung total penjualan (sales)
        $salesQuery = DB::table('bm_c_rcv_shipment_header_id as h')
            ->leftJoin('bm_c_rcv_transactions_id as t', 'h.shipment_header_id', '=', 't.shipment_header_id')
            ->select(
                't.item_id',
                'h.ship_to_location_id',
                DB::raw('SUM(t.quantity_received) as total_sales_quantity')
            )
            ->whereNotNull('t.item_id')
            ->whereNull('h.deleted_at')
            ->whereNull('t.deleted_at')
            ->groupBy('t.item_id', 'h.ship_to_location_id');


        // Query Utama: Menggabungkan Onhand, Item Master, Delivery, dan Sales
        $records = \App\Onhand::leftjoin('bm_mtl_system_item', 'bm_mtl_system_item.inventory_item_id', '=', 'bm_inv_onhand_quantities_detail.inventory_item_id')

        // JOIN PERTAMA: Gabungkan dengan data pengiriman (delivery)
        ->leftJoinSub($deliveryQuery, 'delivery_data', function ($join) {
            $join->on('bm_inv_onhand_quantities_detail.inventory_item_id', '=', 'delivery_data.inventory_item_id')
                    ->on('bm_inv_onhand_quantities_detail.subinventory_code', '=', 'delivery_data.subinventory');
        })

        // JOIN KEDUA: Gabungkan dengan data penjualan (sales)
        ->leftJoinSub($salesQuery, 'sales_data', function ($join) {
            $join->on('bm_inv_onhand_quantities_detail.inventory_item_id', '=', 'sales_data.item_id')
                    ->on('bm_inv_onhand_quantities_detail.subinventory_code', '=', 'sales_data.ship_to_location_id');
        })

        ->orderBy('bm_inv_onhand_quantities_detail.id', 'ASC')

        ->select(
            'bm_inv_onhand_quantities_detail.*',
            'bm_mtl_system_item.description',
            'bm_mtl_system_item.item_code',
            DB::raw('COALESCE(delivery_data.total_delivered_quantity, 0) as delivered_quantity'),
            DB::raw('COALESCE(sales_data.total_sales_quantity, 0) as sales_quantity') // Tambahkan kolom sales_quantity
        )

        ->skip($start)
        ->take($rowperpage)
        ->where(function($query) use ($searchValue) {
            $query->where('bm_mtl_system_item.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('bm_mtl_system_item.item_code', 'like', '%' . $searchValue . '%');
        })
        ->where('bm_mtl_system_item.deleted_at', NULL)
        ->get();

        $data_arr = array();

        foreach ($records as $raw) {
            if($raw->task_id ==1){
                $diff=$raw->primary_transaction_quantity - $raw->secondary_transaction_quantity;
            }else{
                $diff='';
            }
            // dd($raw->subinventory_code);
            $data_arr[] = array(
                "id" =>$raw->id,
                "item_code" => $raw->itemmaster->item_code ?? '',
                "item_code_desc" => $raw->itemmaster->item_code." ".$raw->itemmaster->description,
                "vendor_name" => $raw->itemmaster->item_brand ?? '',
                "description" =>$raw->itemmaster->description ?? '',
                "cost" =>number_format($raw->itemmaster->item_cost,0),
                // "category" => $raw->inv_striping_category ?? $raw->itemmaster->attribute2 ,
                "category" => $raw->itemMaster->attribute1 ?? '' ,
                "type_code" =>$raw->transaction_uom,
                "fix_loc" => $raw->subinventories->description ?? '',
                "subinventory_code" =>$raw->subinventory_code,
                "subinventory" =>$raw->subinventory_code." ".$raw->subinventories->description,
                "transfer_subinventory" => "",
                "transaction_quantity" => number_format($raw->primary_transaction_quantity,0),
                "physical_inventory" =>$raw->secondary_transaction_quantity ?? '',
                "task_id" =>$raw->task_id ?? '',
                "different" => $diff ,
                "sales_quantity" => number_format($raw->sales_quantity, 0),
                "delivered_quantity" => number_format($raw->delivered_quantity, 0),
                "stock_price" => number_format($raw->itemmaster->item_cost*$raw->primary_transaction_quantity,0),
                "primary_uom_code" => $raw->transaction_uom_code,
                "transaction_date" => date('d-M-Y',strtotime($raw->updated_at)),
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function miss_report(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['item_description']) ?  $columnName_arr[$columnIndex]['item_description'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\MaterialTxns::select('count(*) as allcount')->whereIN('transaction_type_id',[31,32])->count();
        $totalRecordswithFilter = \App\MaterialTxns::select('count(*) as allcount')->whereIN('transaction_type_id',[31,32])->count();

        // Get records, also we have included search filter as well
        $records = \App\MaterialTxns::leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_inv_material_txns.inventory_item_id')
            ->orderBy('bm_inv_material_txns.created_at','DESC')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->whereIn('transaction_type_id',[31,32])
            ->where([['bm_mtl_system_item.description','like', '%' . $searchValue . '%']])
            ->get();
        $data_arr = array();
        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,
                "item_code" => $raw->itemmaster->item_code ?? '' ." ".$raw->itemmaster->description ?? '',
                "description" =>$raw->itemmaster->description ?? '',
                "category" =>$raw->product_category ?? $raw->itemmaster->attribute2,
                "type_code" =>$raw->transaction_uom,
                "fix_loc" => $raw->itemMaster->attribute1 ?? '',
                "subinventory_code" =>$raw->subinventory_code." - ". $raw->subinventory->description ?? '',
                "transaction_source_name" =>$raw->transaction_source_name,
                "transaction_quantity" => number_format($raw->transaction_quantity,0),
                "transaction_reference" => $raw->transaction_reference,
                "transaction_date" => date('d-M-Y',strtotime($raw->transaction_date)),
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );
        return json_encode($response);
    }

    public function get_roll_id(Request $request)
    {
                $term =$request->get('id');
                $results = array();
                $qry=array();
                $qwry=array();

                if(isset($term))
                {
                    $queries = \App\DeliveryDetail::find( $term, ['inventory_item_id', 'intattribute3','intattribute2','source_header_number']);
                    $raw = \App\InvOnhandFG::where([['inventory_item_id',$queries->inventory_item_id],['attribute_number_gsm',$queries->intattribute3],['attribute_number_w',$queries->intattribute2],['reference',$queries->source_header_number],['shipping_status_flag','0']])->get();

                foreach ($raw as $key => $value)
                {
                    $qry[$key]['inventory_item_id'] = $value->inventory_item_id;
                    $qry[$key]['rollID'] = $value->uniq_attribute_roll;
                    $qry[$key]['IDDlvy'] = $term;
                }
                $result =DeliveryDistrib::where([['line_id', $term]])->get();
                foreach ($result as $key => $final)
                {
                    $qwry[$key]['inventory_item_id'] = $final->load_item_id;
                    $qwry[$key]['rollID'] = $final->container_item_id;
                    $qwry[$key]['IDDlvy'] = $term;
                }
                $row = array_merge($qry,$qwry);

                if(!$raw ->isEmpty() || !$result ->isEmpty() )  {
                    return json_encode($row);
                }else {
                    $qry[]['inventory_item_id'] =0;
                    $qry[]['rollID'] ="Null" ;
                    return json_encode($qry);
               }
            }
    }
    public function get_roll_dist(Request $request)
    {
        $term =$request->get('line_id');
        $results = array();
        $result =DeliveryDistrib::where([['line_id', $term]])->get();
        foreach ($result as $key => $value)
        {
            $qry[] =strval($value->container_item_id);
        }
        return $qry;
    }

    public function roll_counter(Request $request)
    {
        $roll = array();
        $result =DeliveryDistrib::where([['line_id',$request->get('id')]])->select(DB::raw('count(container_item_id) as roll, sum(attribute_number1) as qty'))->first();
        $roll[] = array(
            'roll'=> $result->roll." Roll",
            'qty'=> (int)$result->qty." Kg",
        );
        return $roll;
    }

    public function data_roll(Request $request)
    {
        $term = $request->get('roll');
        $result = \App\WorkOrderSerial::where('job_definition_name',$term)->first();
        // dd($result->quantity_usage);
        return $result->quantity_usage ;
    }

    public function planning_report(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\ProdPlanning::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\ProdPlanning::select('count(*) as allcount')->count();

        // Get records, also we have included search filter as well

        $item = $request->input('item');
        $opunit = $request->input('opunit');
        $status = $request->input('status');
        $from = $request->input('min');
        $to = $request->input('max');

        if($item == null && $opunit == null && $status == null && $from == null && $to == null){
            // All Null
            $records = \App\ProdPlanning::where('item_code', 'like', '%' . $searchValue . '%')
                ->orWhere('operation_unit', 'like', '%' . $searchValue . '%')
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
        }elseif(!is_null($item)){
            // Item Not Null
            if($item != null && $opunit == null && $status == null ){
                $records = \App\ProdPlanning::where('item_code', $item)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('unit null status null');
            }elseif($item != null && $opunit != null && $status == null ){
                $records = \App\ProdPlanning::where('item_code', $item)
                ->where('operation_unit', $opunit)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('unit !null status null');
            }elseif($item != null && $opunit != null && $status != null ){
                $records = \App\ProdPlanning::where('item_code', $item)
                ->where('operation_unit', $opunit)
                ->where('status', $status)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('unit !null status !null');
            }else{
                $records = \App\ProdPlanning::where('item_code', $item)
                ->where('status', $status)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump($item, $opunit);
            }
        }elseif(!is_null($opunit)){
            // Op Unit
            if($opunit != null && $item == null && $status == null ){
                $records = \App\ProdPlanning::where('operation_unit', $opunit)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('item null status null');
            }elseif($opunit != null && $item != null && $status == null ){
                $records = \App\ProdPlanning::where('item_code', $item)
                ->where('operation_unit', $opunit)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('item !null status null');
            }elseif($opunit != null && $item != null && $status != null ){
                $records = \App\ProdPlanning::where('item_code', $item)
                ->where('operation_unit', $opunit)
                ->where('status', $status)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('item !null status !null');
            }else{
                $records = \App\ProdPlanning::where('operation_unit', $opunit)
                ->where('status', $status)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('item !null status !null');
            }
        } elseif(!is_null($from)){
            if($from !=null&&$to==null){
                $records = \App\ProdPlanning::where('completed_schedule', $from)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
            }elseif($from !=null&&$to !=null){
                $records = \App\ProdPlanning::whereBetween('completed_schedule', [$from, $to])
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
            }
        }elseif(!is_null($to)){
            if($from ==null&&$to !=null){
                $records = \App\ProdPlanning::where('completed_schedule', $to)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
            }elseif($from !=null&&$to !=null){
                $records = \App\ProdPlanning::whereBetween('completed_schedule', [$from, $to])
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
            }
        }
        else{
            // Status
            if($status != null && $item == null && $opunit == null ){
                $records = \App\ProdPlanning::where('status', $status)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('else status4');
            }elseif($status != null && $item != null && $opunit == null ){
                $records = \App\ProdPlanning::where('item_code', $item)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('else status3');
            }elseif($status != null && $item != null && $opunit != null ){
                $records = \App\ProdPlanning::where('item_code', $item)
                ->where('operation_unit', $opunit)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('else status2');
            }else{
                $records = \App\ProdPlanning::where('status', $status)
                ->where('operation_unit', $opunit)
                ->where('item_code', $item)
                ->orderBy('planning_schedule','desc')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                // var_dump('else status');
            }
        }

        $data_arr = array();

        foreach ($records  as  $key => $record) {

            $data_arr[] = array(
                "id" => $key +1,
                "prod_planning_id" =>   $record->prod_planning_id,
                "order_number" =>   $record->order_number,
                "line_number" =>   $record->roll_seq,
                "customer_po_number" =>   $record->customer_po_number,
                "customer_code" => $record->cust_prod->party_name ?? '',
                "inventory_item_code" =>  $record->inventory_item_code,
                "item_code" =>   $record->item_code,
                "attribute_number_gsm" =>   $record->attribute_number_gsm ?? 0,
                "attribute_number_w" =>   $record->attribute_number_w,
                "ordered_quantity" =>   $record->ordered_quantity,
                "planning_schedule" =>   $record->planning_schedule->format('d-M-Y'),
                "completed_schedule" =>   $record->completed_schedule->format('d-M-Y'),
                "Roll_seq" =>  $record->roll_seq,
                // "Revise"=>$record->ordered_quantity -$record->delivered_quantity,
                "status" =>   $record->status,
                "operation_unit" =>   $record->operation_unit,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }


    public function sales_report(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $from = $request->get('from') ?? date('Y-01-01');
        $to = $request->get('to') ?? date('Y-12-31');
        $customer = $request->get('customer') ?? "";
        $rev = $request->get('rev');
        // dd($customer);

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\SalesOrderDetail::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\SalesOrderDetail::select('count(*) as allcount')->where('id', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\SalesOrderDetail::leftJoin('bm_order_headers_all as sh','bm_order_lines_all.header_id','=','sh.header_id')
            ->leftJoin('bm_wsh_delivery_details as dd',function($join){
                $join->on('dd.source_header_id','=','bm_order_lines_all.header_id');
                $join->on('dd.source_line_id','=','bm_order_lines_all.split_line_id');
            })
            ->leftJoin('bm_wsh_new_deliveries as dh','dh.delivery_id','=','dd.delivery_detail_id')
            ->select('bm_order_lines_all.*','dd.shipped_quantity','dd.delivered_quantity','dh.packing_slip_number','dh.dock_code','dh.delivery_id')
            ->where('sh.deleted_at',Null)
            ->where('dd.deleted_at',Null)
            ->where('dh.deleted_at',Null)
            ->whereBetween('sh.ordered_date', [$from, $to])
            ->where('invoice_to_org_id','like','%'.$customer.'%')
            ->where(function($query) use($searchValue,$rev){
                $query ->orWhere('sh.order_number', 'like', '%' . $searchValue . '%')
                ->orWhere('sh.cust_po_number', 'like', '%' . $searchValue . '%')
                ->orWhere('dh.dock_code','like','%'.$searchValue.'%');
            })
            ->orderBy('sh.order_number','desc')
            ->skip($start)
            ->take($rowperpage)
            ->get();


        // dd($records);
        $data_arr = array();
        foreach ($records as $record) {

            $data_arr[] = array(
                "id" => $record->id,
                "order_number" =>   $record->salesheader->order_number,
                "cust_po_number" =>   $record->salesheader->cust_po_number,
                "customer_name" =>   $record->salesheader->customer->party_name,
                "currency" =>   $record->salesheader->currency->currency_code,
                "shipped_quantity" =>   $record->shipped_quantity,
                "delivered_quantity" =>   $record->delivered_quantity ?? 0,
                "packing_slip_number" =>   $record->packing_slip_number,
                "dock_code" =>   $record->dock_code,
                "delivery_id" =>   $record->delivery_id,
                "item_code" =>   $record->itemMaster->item_code,
                "attribute_number_gsm" =>   $record->attribute_number_gsm,
                "attribute_number_w" =>   $record->attribute_number_w,
                "unit_selling_price" =>   $record->unit_selling_price,
                "ordered_quantity" =>   $record->ordered_quantity,
                "outstanding_qty"=>$record->ordered_quantity -$record->delivered_quantity,
                "booked_flag" =>   $record->trx_code->trx_name ?? 0,
                "flow_status_code" =>   $record->flow_status_code,
                "trx_name" =>   $record->trx_code->trx_name,
                "shipping_interfaced_flag" =>   $record->shipping_interfaced_flag,
                "created_at" => $record->created_at->format('Y-M-d'),
                "updated_at" => $record->updated_at->format('d-m-Y')
            );
        }


        $response = array(
            "draw" => intval($draw),
            "rev"=>$rev,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }

    public function sales_invoice_report(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $from = $request->get('from') ?? date('Y-01-01');
        $to = $request->get('to') ?? date('Y-12-31');
        $customer = $request->get('customer') ?? "";
        $rev = $request->get('rev');
        // dd($customer);

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\SalesOrderDetail::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\SalesOrderDetail::select('count(*) as allcount')->where('id', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\DeliveryHeader::leftJoin('bm_wsh_delivery_details as dd','bm_wsh_new_deliveries.delivery_id','=','dd.delivery_detail_id')
            ->leftJoin('bm_order_lines_all as d',function($join){
                $join->on('dd.source_header_id','=','d.header_id');
                $join->on('dd.source_line_id','=','d.split_line_id');
            })
            ->select('dd.source_header_number','bm_wsh_new_deliveries.sold_to_party_id','dd.cust_po_number','bm_wsh_new_deliveries.currency_code',
            'bm_wsh_new_deliveries.lvl','bm_wsh_new_deliveries.dock_code','bm_wsh_new_deliveries.accepted_date',DB::raw('sum (d.fulfilled_quantity * d.unit_selling_price) as subtotal'))
            ->where('d.deleted_at',Null)
            ->where('dd.deleted_at',Null)
            ->where('lvl',12)
            // ->whereBetween('sh.ordered_date', [$from, $to])
            ->where('bm_wsh_new_deliveries.sold_to_party_id','like','%'.$customer.'%')
            ->where(function($query) use($searchValue,$rev){
                $query ->orWhere('dd.source_header_number', 'like', '%' . $searchValue . '%')
                ->orWhere('dd.cust_po_number', 'like', '%' . $searchValue . '%');
            })
            ->orderBy('dd.source_header_number','desc')
            ->groupBy('dd.source_header_number','bm_wsh_new_deliveries.sold_to_party_id','dd.cust_po_number','bm_wsh_new_deliveries.currency_code',
            'bm_wsh_new_deliveries.lvl','bm_wsh_new_deliveries.dock_code','bm_wsh_new_deliveries.accepted_date')
            ->skip($start)
            ->take($rowperpage)
            ->get();


        $data_arr = array();
        foreach ($records as $record) {

            $data_arr[] = array(
                "id" => $record->id,
                "order_number" =>   $record->source_header_number,
                "dock_code" =>   $record->dock_code,
                "cust_po_number" =>   $record->cust_po_number,
                "customer_name" =>   $record->customer->party_name,
                "currency" =>   $record->currency->currency_code ?? '',
                "sub_total" =>   number_format($record->subtotal,0),
                "trx_name" =>   $record->trxstatus->trx_name,
                "created_at" => $record->accepted_date,
            );
        }


        $response = array(
            "draw" => intval($draw),
            "rev"=>$rev,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function sales_data(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records

        $totalRecords = \App\SalesOrder::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\SalesOrder::select('count(*) as allcount')->where('order_number', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')->count();
        $cust = $request->input('cust');
        $status = $request->input('status');
        $min = $request->input('min');
        $max = $request->input('max');

        // dd($min, $max);
        // Get records, also we have included search filter as well
        if($cust == null && $status == null && $min == null && $max == null){
            $records = \App\SalesOrder::orderBy('id','desc')
            ->where('order_number', 'like', '%' . $searchValue . '%')
            ->orWhere('cust_po_number', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        }elseif(!is_null($min)){
            if(!is_null($min)&&$max==null){
                $records = \App\SalesOrder::where('ordered_date', Carbon::parse($min)->format('Y-m-d'))
                ->get();
            }elseif(!is_null($min&&$max)){
                $records = \App\SalesOrder::whereBetween('ordered_date', [Carbon::parse($min)->format('Y-m-d'),Carbon::parse($max)->format('Y-m-d')])
                ->get();
            }
        }elseif(!is_null($max)){
            if(!is_null($max)&&$min==null){
                $records = \App\SalesOrder::where('ordered_date', Carbon::parse($max)->format('Y-m-d'))
                ->get();
            }elseif(!is_null($min&&$max)){
                $records = \App\SalesOrder::whereBetween('ordered_date', [Carbon::parse($min)->format('Y-m-d'),Carbon::parse($max)->format('Y-m-d')])
                ->get();
            }
        }
        elseif(!is_null($cust)&&$status==null){
            $records = \App\SalesOrder::where('invoice_to_org_id',$cust)
            ->get();
        }elseif(!is_null($status)&&$cust==null){
            if($status==1){
                $records=\App\SalesOrder::where('booked_flag',1)->where('open_flag','!=',12)
                ->get();
            }elseif($status==2){
                $records=\App\SalesOrder::where('booked_flag',11)
                ->get();
            }elseif($status==3){
                $records=\App\SalesOrder::where('open_flag',12)
                ->get();
            }
            else{
                $records=\App\SalesOrder::where('booked_flag',14)->where('open_flag',14)
                ->get();
            }

        }elseif(!is_null($cust&&$status)){
            if($status==1){
                $records=\App\SalesOrder::where('booked_flag',1)->where('open_flag','!=',12)
                ->where('invoice_to_org_id',$cust)
                ->get();
            }elseif($status==2){
                $records=\App\SalesOrder::where('booked_flag',11)
                ->where('invoice_to_org_id',$cust)
                ->get();
            }elseif($status==3){
                $records=\App\SalesOrder::where('open_flag',12)
                ->where('invoice_to_org_id',$cust)
                ->get();
            }
            else{
                $records=\App\SalesOrder::where('booked_flag',14)->where('open_flag',14)
                ->where('invoice_to_org_id',$cust)
                ->get();
            }
        }


        $data_arr = array();
        foreach ($records  as  $key => $row) {
            if($row->booked_flag==1 & $row->open_flag!=12){
                $status='<a class="badge bg-primary text-white">Book</a>';
            }elseif($row->booked_flag==11)
            {
                $status='<a class="badge bg-warning text-white">Cancel</a>';
            }elseif($row->booked_flag==12)
            {
                $status='<a class="badge bg-danger text-white">Close</a>';
            }elseif($row->open_flag==12)
            {
                $status='<a class="badge bg-danger text-white">Close</a>';
            }else{
                $status='<a class="badge bg-info text-white">Enter</a>';
            }
            $data_arr[] = array(
                "id" => $key +1,
                "header_id" => $row->header_id,
                "order_number" => $row->order_number,
                "customer_po" => $row->cust_po_number,
                "price_list" =>   $row->price_list->price_list_name ??'',
                "shipto" => isset($row->party_site->address1)? $row->party_site->address1 :'',
                "customer_name" => $row->customer->party_name??'',
                "currency" =>   $row->attribute1,
                "ordered_date" =>   $row->ordered_date->format('d-M-Y'),
                "status" => $status,
                "action" =>"1",
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function invoices_data(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $searchValue = $request->input('search')['value'] ?? '';

        $cust = $request->input('cust');
        $status = $request->input('status');
        $min = $request->input('min');
        $max = $request->input('max');

        // Total records
        $totalRecords = \App\SalesOrder::whereNotNull('inv_number')->count();
        $totalRecordswithFilter = \App\SalesOrder::whereNotNull('inv_number')
            ->where(function ($query) use ($searchValue) {
                $query->where('order_number', 'like', '%' . $searchValue . '%')
                    ->orWhere('id', 'like', '%' . $searchValue . '%');
            })->count();

        // Query dasar untuk filter berdasarkan `inv_number`
        $query = \App\SalesOrder::whereNotNull('inv_number');

        // **Filter berdasarkan search value**
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('order_number', 'like', '%' . $searchValue . '%')
                    ->orWhere('cust_po_number', 'like', '%' . $searchValue . '%');
            });
        }

        // **Filter berdasarkan tanggal**
        if (!is_null($min) && is_null($max)) {
            $query->where('ordered_date', Carbon::parse($min)->format('Y-m-d'));
        } elseif (!is_null($min) && !is_null($max)) {
            $query->whereBetween('ordered_date', [
                Carbon::parse($min)->format('Y-m-d'),
                Carbon::parse($max)->format('Y-m-d')
            ]);
        } elseif (is_null($min) && !is_null($max)) {
            $query->where('ordered_date', Carbon::parse($max)->format('Y-m-d'));
        }

        // **Filter berdasarkan customer**
        if (!is_null($cust)) {
            $query->where('invoice_to_org_id', $cust);
        }

        // **Filter berdasarkan status**
        if (!is_null($status)) {
            if ($status == 1) {
                $query->where('booked_flag', 1)->where('open_flag', '!=', 12);
            } elseif ($status == 2) {
                $query->where('booked_flag', 11);
            } elseif ($status == 3) {
                $query->where('open_flag', 12);
            } else {
                $query->where('booked_flag', 14)->where('open_flag', 14);
            }
        }

        // **Ambil data berdasarkan pagination**
        $records = $query->orderBy('id', 'desc')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // **Persiapkan data untuk response**
        $data_arr = [];
        foreach ($records as $key => $row) {
            $status_label = match (true) {
                $row->booked_flag == 1 && $row->open_flag != 12 => '<a class="badge bg-primary text-white">Book</a>',
                $row->booked_flag == 11 => '<a class="badge bg-warning text-white">Cancel</a>',
                $row->booked_flag == 12, $row->open_flag == 12 => '<a class="badge bg-danger text-white">Close</a>',
                default => '<a class="badge bg-info text-white">Enter</a>',
            };

            $data_arr[] = [
                "id" => $key + 1,
                "header_id" => $row->header_id,
                "order_number" => $row->inv_number,
                "customer_po" => $row->cust_po_number,
                "price_list" => $row->price_list->price_list_name ?? '',
                "shipto" => $row->party_site->address1 ?? '',
                "customer_name" => $row->customer->party_name ?? '',
                "currency" => $row->attribute1,
                "ordered_date" => $row->ordered_date->format('d-M-Y'),
                "status" => $status_label,
                "action" => "1",
            ];
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        ];

        return response()->json($response);
    }
    public function faktur_data(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        // Total Records
        $totalRecords = Faktur::count();
        $totalRecordswithFilter = Faktur::count(); // Tanpa filtering

        // Ambil data dari Faktur
        $records = Faktur::orderBy('id', 'desc')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Persiapkan data untuk response
        $data_arr = [];
        foreach ($records as $key => $row) {
            $data_arr[] = [
                "id" => $key + 1,
                "faktur_code" => $row->faktur_code,
                "date" => $row->created_at->format('d-M-Y'),
            ];
        }
        // dd($data_arr);
        return response()->json([
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        ]);
    }


    public function delivery_report(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\DeliveryHeader::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\DeliveryHeader::select('count(*) as allcount')->where('id', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\DeliveryHeader::where('bm_wsh_new_deliveries.ship_to_party_id', 'like', '%' . $searchValue . '%')
            ->orWhere('bm_wsh_new_deliveries.delivery_id', 'like', '%' . $searchValue . '%')
            ->orderBy('bm_wsh_new_deliveries.delivery_id','DESC')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($records as $record) {
            $qty = \App\DeliveryDetail::where('delivery_detail_id','=',$record->delivery_id)->sum('requested_quantity');
            $roll = \App\DeliveryDistrib::where('header_id','=',$record->delivery_id)->select(DB::raw('count(container_item_id) as roll, sum(attribute_number1) as qty'))->first();

            $data_arr[] = array(
                "id" => $record->delivery_id,
                "customer_name" =>   $record->customer->party_name ??'',
                "site" =>   $record->party_site->address1 ??'',
                "currency" =>   $record->attribute2,
                "delivered_quantity" => $qty ?? 0,
                "packing_slip_number" => $record->packing_slip_number,
                "note" =>   $record->attribute2,
                "delivery_note" =>   $record->dock_code,
                // "term" =>   $record->term->term_code,
                "shipment_date" => date('d-M-Y',strtotime($record->on_or_about_date)),
                "lvl" =>   $record->lvl,
                "roll" =>   $roll->roll,
                "qty" =>   $roll->qty,
                "trx_name" =>   $record->trxstatus->trx_name??'',
                "currency" =>   $record->attribute1
            );
        }


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }

    public function shipment_data(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records

        $totalRecords = \App\DeliveryHeader::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\DeliveryHeader::select('count(*) as allcount')->where('delivery_id', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = \App\DeliveryHeader::orderBy('id','desc')
            ->where('dock_code', 'like', '%' . $searchValue . '%')
            ->orWhere('delivery_id', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();


        $data_arr = array();
        foreach ($records  as  $key => $row) {
            if ($row->packing_slip_number==null){
                $status='<a class="badge bg-secondary text-white">Not Complete</a>';
            }else if ($row->status_code==11){
                $status='<a class="badge bg-warning text-white">'.$row->trxstatus->trx_name.'</a>';
            }else if ($row->status_code==12){
                $status='<a class="badge bg-primary text-white">'.$row->trxstatus->trx_name.'</a>';
            }else if ($row->status_code==6||$row->status_code==7||$row->status_code==14||$row->status_code==8){
                $status='<a class="badge bg-info text-white">'.$row->trxstatus->trx_name.'</a>';
            }

            $total_amount_by_id=DeliveryDetail::select(DB::raw('sum(unit_price*picked_quantity) AS amount, sum(picked_quantity) as total_qty'))
            ->where('delivery_detail_id', $row->delivery_id)->first();

            $roll = \App\DeliveryDistrib::where('header_id',$row->delivery_id)->count('id');
            if($roll>=1){
                $roll_status = 1;
            }else{
                $roll_status = 0;
            }

            $data_arr[] = array(
                "id" => $row->id,
                "roll_status" => $roll_status ?? '',
                "delivery_id" => $row->delivery_id,
                "order_number" => $row->detail->sales->order_number ?? '',
                "customer_po" => $row->detail->sales->cust_po_number ?? '',
                "customer_code" => $row->customer->cust_party_code ?? '',
                "customer_name" => $row->customer->party_name ?? '',
                "delivery_note" =>   $row->delivery_name ?? '',
                "note" => $row->attribute2??'-',
                "currency" =>   $row->attribute1,
                "qty_total" =>    number_format($total_amount_by_id->total_qty,0),
                "amount" =>    number_format($total_amount_by_id->amount,0),
                "date" =>   date('d-M-Y',strtotime($row->created_at)),
                "status" => $status,
            );

        }
// dd($data_arr);
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function taxmaster(Request $request){
         $options = \App\Tax::where('type_tax_use','Sales')->get();
        //  dd($options); // Replace with your actual model query
         return response()->json($options);
    }
    public function gllist(Request $request){
        $gl = \App\GlHeader::orderBy('default_effective_date', 'DESC')->get();
        // dd($gl);
        $data_arr = array();
        foreach ($gl as $row) {
            $data_arr[] = array(
                "id"=>$row->je_header_id,
                "name" =>$row->name,
                "default_effective_date"=>$row->default_effective_date->format('d/m/Y'),
                "period_name"=>$row->period_name,
                "external_reference"=>$row->external_reference,
                "je_category"=>$row->je_category,
                "currency_code"=>$row->currency_code,
            );
        }
        // dd($data_arr);
        $response = array(
            "aaData" => $data_arr,
        );
         return json_encode($response);
    }
    public function wolist(Request $request)
    {
        // dd($request);
        $wo = \App\WorkOrder::select('bm_wie_work_orders.*','users.name')
        ->leftjoin('users','users.id','=','bm_wie_work_orders.created_by')
        ->orderBy('created_at','DESC')
        ->get();
        // dd($wo);
        $data_arr = array();
        foreach ($wo as $row) {
            $data_arr[] = array(
                "id"=>$row->id,
                "wonumber"=>$row->work_order_number,
                "invitem" =>$row->bom->parent_item ?? '',
                "work_order_type"=>ucfirst($row->work_order_type?? 'auto') ,
                "needdate"=>$row->need_by_date->format('d-m-Y'),
                "created"=>$row->name,
                "status_change_reason"=>$row->status_change_reason,
                "closed_date"=>$row->closed_date,
                "canceled_date"=>$row->canceled_date,
                "created_at"=>$row->created_at,
            );
        }
        // dd($data_arr);
        $response = array(
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function out_standing(Request $request)
    {
        $out_stand = \App\InvOnhandFgOstd::get();
        $data_arr = array();
        foreach ($out_stand as $row) {
            $data_arr[] = array(
                "id"=>$row->id,
                "wonumber"=>$row->work_order_num,
                "sales_ref" =>$row->sales_reference_num ?? '',
                "customer_code"=>$row->customer_code ,
                "customer_po"=>$row->customer_po_number,
                "item_code"=>$row->item_code,
                "gsm"=>$row->attribute_number_gsm,
                "qty"=>$row->ordered_quantity,
                "attchar"=>$row->attribute_number_w,
                "attchar2"=>$row->attribute_char2,
                "completed"=>$row->completed_schedule,
            );
        }
        // dd($data_arr);
        $response = array(
            "aaData" => $data_arr,
        );
        return json_encode($response);
    }
    public function addbank(Request $request){
        $addbank= BankAccount::select('bm_bank_acct_uses_all.*','bm_cust_site_uses_all.party_name','bm_acc_all_id.description')->
        join('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_bank_acct_uses_all.org_party_id')
        ->join('bm_acc_all_id','bm_acc_all_id.account_code','=','bm_bank_acct_uses_all.bank_acct_use_id')
        ->get();
        $data_arr = array();
        foreach ($addbank as $row) {
            $data_arr[] = array(
                "id"=>$row->id,
                "bank_acct_use_id"=>$row->description,
                "bank_account_id"=>$row->bank_account_id,
                "attribute_category"=>$row->attribute_category,
                "attribute1"=>$row->attribute1,
                "attribute2"=>$row->attribute2,
                "org_party_id"=>$row->party_name??'',
                "ap_use_enable_flag"=>$row->ap_use_enable_flag??'',
                "ar_use_enable_flag"=>$row->ar_use_enable_flag??'',
                "end_date"=>$row->end_date,
                "created_at"=>$row->created_at->format('d-m-Y'),
            );
        }
        // dd($data_arr);
        $response = array(
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }
    public function ap_payment(Request $request){
        $payment = ApPayment::where('global_attribute1','Send')->get();

        $data_arr = array();
        foreach ($payment as $row) {
            if ($row->posted_flag  == 0){
                $status = '<a class="badge bg-secondary text-white">Draft</a>';
            }else if ($row->posted_flag == 1){
                $status = '<a class="badge bg-warning text-white">Validate</a>';
            }else if ($row->posted_flag == 2){
                $status = '<a class="badge bg-info text-white">Account Posted</a>';
            }else if ($row->posted_flag == 4){
                $status = '<a class="badge bg-primary text-white">Paid </a>';
            }else{
                $status = '<a class="badge bg-danger text-white">Cancel</a>';
            }
            $data_arr[] = array(
                "id"=>$row->id,
                "accounting_date"=>$row->accounting_date,
                "invoice_id"=>$row->attribute1 ?? '-',
                "amount"=>$row->amount,
                "payment_num"=>$row->payment_num,
                "posted_flag"=>$status,
                "set_of_books_id"=>$row->journal->description ?? '-',
                "bankacc"=>$row->bankacc->attribute2 ?? '',
                "voucher"=>$row->attribute1,
                "invoice_payment_type"=>$row->invoice_payment_type,
                "invoice_vendor_site_id"=>$row->vendor->vendor_name ?? $row->cust->party_name ?? '',
                "currency"=>$row->payment_currency_code,
            );
        }
        $response = array(
            "aaData" => $data_arr,
        );
        // dd($data_arr);
        return json_encode($response);
    }
    public function ar_payment(Request $request){
        $payment = ApPayment::where('global_attribute_category','like','sales')->get();
        $data_arr = array();
        foreach ($payment as $row) {
            if ($row->posted_flag  == 0){
                $status = '<a class="badge bg-secondary text-white">Draft</a>';
            }else if ($row->posted_flag == 1){
                $status = '<a class="badge bg-warning text-white">Validate</a>';
            }else if ($row->posted_flag == 2){
                $status = '<a class="badge bg-info text-white">Account Posted</a>';
            }else if ($row->posted_flag == 4){
                $status = '<a class="badge bg-primary text-white">Paid </a>';
            }else{
                $status = '<a class="badge bg-danger text-white">Cancel</a>';
            }
            $data_arr[] = array(
                "accounting_date"=>$row->accounting_date,
                "invoice_id"=>$row->attribute1,
                "amount" => number_format($row->amount, 0, ',', '.'),
                "payment_num"=>$row->payment_numstatus??'-',
                "posted_flag"=>$status,
                "set_of_books_id"=>$row->journal->trx_type ?? '-',
                "invoice_payment_type"=>$row->invoice_payment_type,
                "invoice_vendor_site_id"=>$row->saleorder->customer->party_name,
                "currency"=>$row->payment_currency_code,
                "voucher" => (int) $row->invoice_payment_id,
            );
            // dd($data_arr);
        }
        $response = array(
            "aaData" => $data_arr,
        );
        // dd($data_arr);
        return json_encode($response);
    }
    public function ap_payments(Request $request){
        $payment = ApPayment::where('global_attribute_category','like','purchase')->get();
        $data_arr = array();
        foreach ($payment as $row) {
            if ($row->posted_flag  == 0){
                $status = '<a class="badge bg-secondary text-white">Draft</a>';
            }else if ($row->posted_flag == 1){
                $status = '<a class="badge bg-warning text-white">Validate</a>';
            }else if ($row->posted_flag == 2){
                $status = '<a class="badge bg-info text-white">Account Posted</a>';
            }else if ($row->posted_flag == 4){
                $status = '<a class="badge bg-primary text-white">Paid </a>';
            }else{
                $status = '<a class="badge bg-danger text-white">Cancel</a>';
            }
            $data_arr[] = array(
                "accounting_date"=>$row->accounting_date,
                "invoice_id"=>$row->attribute1,
                "amount" => number_format($row->amount, 0, ',', '.'),
                "payment_num"=>$row->payment_numstatus??'-',
                "posted_flag"=>$status,
                "set_of_books_id"=>$row->journal->trx_type ?? '-',
                "invoice_payment_type"=>$row->invoice_payment_type,
                "invoice_vendor_site_id"=>$row->saleorder->customer->party_name,
                "currency"=>$row->payment_currency_code,
                "voucher" => (int) $row->invoice_payment_id,
            );
            // dd($data_arr);
        }
        $response = array(
            "aaData" => $data_arr,
        );
        // dd($data_arr);
        return json_encode($response);
    }
    public function tax_list(Request $request){
        $tax = \App\Tax::orderBy('created_at','desc')->get();
        $data_arr = array();
        foreach ($tax as $row) {
            $data_arr[] = array(
                "id"=>$row->id,
                "tax_code"=>$row->tax_code,
                "tax_regimes_b"=>$row->tax_regimes_b,
                "tax_name"=>$row->tax_name,
                "tax_rate"=>(float)$row->tax_rate,
                "tax_taxes_tl"=>$row->tax_taxes_tl,
                "created_at"=>$row->created_at->format('d/m/y'),
                "type_tax_use"=>$row->type_tax_use,
                "tax_account"=>$row->tax_account,
            );
        }
        $response = array(
            "aaData" => $data_arr,
        );
        return json_encode($response);
    }
    public function add_tax(Request $request){
        $tax = \App\Tax::where('type_tax_use','Sales')->get();
        $data_arr = array();
        foreach ($tax as $row) {
            $data_arr[] = array(
                "tax_code"=>$row->tax_code,
                "tax_rate"=>(float)$row->tax_rate,
            );
        }
        return json_encode($data_arr);
    }

    public function get_rate(Request $request)
    {
        $term =$request->get('id');
        $results = array();
        $result =\App\CurrencyRate::where([['currency_id', $term]])->orderBy('rate_date','DESC')->select('rate','rate_date','currency_id')->first();
        return $result;
    }
    public function journal_entries(Request $request){

        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\GlLines::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\GlLines::select('count(*) as allcount')->where('id', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\GlLines::where('bm_gl_lines.je_header_id', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        dd($records);
        foreach ($records as $record) {
            $dess = $record->coa->description ?? '';
            // dd($dess);
            $data_arr[] = array(
                "id" => $record->je_header_id,
                "ledger" => $record->ledger_id,
                "period" =>   $record->gl->period_name ??'',
                "company" =>   'NEXZO-APP',
                "journal" =>   $record->gl->je_category ??'',
                "journal_entries" =>$record->gl->external_reference ??'',
                "account" => $record->code_combination_id." ".$dess,
                "partner" =>   $record->gl->name ??'',
                "partner" =>   $record->gl->name ??'',
                "description" =>$record->description,
                "dr" =>number_format($record->entered_dr, 2),
                "cr" => number_format($record->entered_cr, 2),
                "effective_date" =>   $record->effective_date->format('d-M-Y')
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);
    }

    public function asset_category(Request $request)
    {
        $term =$request->get('value');
        $result =\App\AssetCatagory::where([['id', $term]])->select('method','method_number', 'method_period','method_time',
        'method_end','prorata','method_progress_factor',)->first();

        return json_encode($result);

    }

    public function asset_list(Request $request)
    {
        $asset=\App\Asset::get();
        $data_arr = array();
        foreach ($asset as $row) {
            $data_arr[] = array(
                "id"=>$row->id,
                "name"=>$row->name,
                "value"=>$row->value,
                "currency_id"=>$row->currency_id,
                "company_id"=>$row->company_id,
                "category_id"=>$row->category->name ?? '',
                "state"=>$row->state,
                "active"=>$row->active,
                "method"=>$row->method,
                "method_period"=>$row->method_period,
                "method_progress_factor"=>$row->method_progress_factor,
                "method_time"=>$row->method_time,
                "prorata"=>$row->prorata,
                "salvaga_value"=>$row->salvaga_value,
                "invoice_id"=>$row->invoice_id,
                "create_uid"=>$row->create_uid,
                "create_date"=>$row->create_date,
                "write_uid"=>$row->write_uid,
                "created_at"=>$row->created_at,
                "updated_at"=>$row->updated_at,
            );
        }
        $response = array(
            "aaData" => $data_arr,
        );
        // dd($response);
        return json_encode($response);
    }
    public function assetcategory_list(Request $request)
    {
        $asset=\App\AssetCatagory::get();
        $data_arr = array();
        foreach ($asset as $row) {
            $data_arr[] = array(
                "id"=>$row->id,
                "active"=>$row->active,
                "name"=>$row->name,
                "account_analytic_id"=>$row->account_analytic_id,
                "account_asset_id"=>$row->account_asset_id,
                "account_depreciation_id"=>$row->account_depreciation_id,
                "account_depreciation_expense_id"=>$row->account_depreciation_expense_id,
                "journal_id"=>$row->journal_id,
                "company_id"=>$row->company_id,
                "method"=>$row->method,
                "method_number"=>$row->method_number,
                "method_period"=>$row->method_period,
                "method_time"=>$row->method_time,
                "created_at"=>$row->created_at,
            );
        }
        $response = array(
            "aaData" => $data_arr,
        );
        // dd($response);
        return json_encode($response);
    }

    public function search_wo(Request $request){

		$term = $request['term'];
        $qry=array();
		$results = array();

		$wo = \App\WorkOrder::where('work_order_number', 'LIKE', '%'.$term.'%')
                                ->where('closed_date',Null)
                                ->where('canceled_date',Null)
                                ->take(5)->orderBy('id','desc')->get();
		foreach ($wo as $key => $value)
		{
			$qry[$key]['value'] = $value->work_order_number;
			$qry[$key]['value1'] = $value->id;
			$qry[$key]['value2'] = "wo";
		}

		return \Response::json($qry);
	}

    public function order_summary(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = DB::table('bm_view_order_planning')->where('promise_date',Null)->select('count (*) as allcount')->count();
        $totalRecordswithFilter = DB::table('bm_view_order_planning')->where('promise_date',Null)->select('count (*) as allcount')->count();

        // Get records, also we have included search filter as well
        $records = DB::table('bm_view_order_planning')
                    ->where('promise_date',Null)
                    ->where(function($query) use($searchValue) {
                        $query
                        ->orWhere('user_description_item', 'like', '%' . $searchValue . '%')
                        ->orWhere('opration', 'like', '%' . $searchValue . '%');
                    })
                    ->orderBy('schedule_ship_date','asc')
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();

        $data_arr = array();

        foreach ($records  as  $key => $record) {

            $data_arr[] = array(
                "id" => $key +1,
                "sales_header_id" =>   $record->sales_header_id,
                "order_number" =>   $record->order_number,
                "cust_po_number" =>   $record->cust_po_number,
                "customer_name" => $record->party_name,
                "invoice_to_org_id" => $record->invoice_to_org_id,
                "inventory_item_id" =>   $record->inventory_item_id,
                "item_code" =>   $record->user_description_item,
                "width" =>   $record->width,
                "length" =>   $record->attribute_number_l,
                "gsm" =>   $record->attribute_number_gsm,
                "ordered_quantity" =>  (float) $record->qty,
                "schedule_ship_date" =>date('d-M-Y',strtotime($record->schedule_ship_date)),
                "opration" =>   $record->opration,
                "roll" =>   $record->roll,
                "shipping_inventory" =>   $record->shipping_inventory,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }

    public function pln_det(Request $request)
    {

    //abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $draw = $request->get('draw');
     $start = $request->get("start");
     $rowperpage = $request->get("length"); // total number of rows per page

     $columnIndex_arr = $request->get('order');
     $columnName_arr = $request->get('columns');
     $order_arr = $request->get('order');
     $search_arr = $request->get('search');

     $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
     $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
     $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
     $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

     // Total records
     $totalRecords = DB::table('bm_view_order_planning')->where('promise_date',Null)->select('count (*) as allcount')->count();
     $totalRecordswithFilter = DB::table('bm_view_order_planning')->where('promise_date',Null)->select('count (*) as allcount')->count();

     // Get records, also we have included search filter as well
     $records =\App\SalesOrder::orderBy('bm_order_headers_all.id','desc')
                ->leftJoin('bm_order_lines_all','bm_order_lines_all.header_id','=','bm_order_headers_all.header_id')
                ->where([['bm_order_headers_all.order_number',$request->get('sonum')],['bm_order_lines_all.line_number',$request->get('linegroup')]])
                 ->orderBy('bm_order_lines_all.id','asc')
                 ->skip($start)
                 ->take($rowperpage)
                 ->get();

     $data_arr = array();

     foreach ($records  as  $key => $record) {

         $data_arr[] = array(
             "id" => $key +1,
             "order_number" =>   $record->order_number,
             "gsm" =>   $record->attribute_number_gsm,
             "size" =>   $record->attribute_number_w,
             "item" =>   $record->user_description_item,
             "qty" =>   $record->ordered_quantity,
         );
     }

     $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordswithFilter,
         "aaData" => $data_arr,
     );

      return json_encode($response);
    }


    public function fg_item(Request $request){

		$term = $request['term'];
        $qry=array();
        $qwry=array();
		$results = array();
		$queries = \App\InvOnhandFG::where('uniq_attribute_roll', 'LIKE', '%'.$term.'%')
        ->where(function($query) {
            $query
            ->where('shipping_status_flag',0)
            ->where('wip_status_flag',0)
            ->orWhere('wip_status_flag',NULL);
        })
        ->take(2)->get();
		foreach ($queries as $key => $value)
		{
			$qry[$key]['value'] = $value->uniq_attribute_roll;
			$qry[$key]['value1'] = $value->inventory_item_id;
			$qry[$key]['roll'] = $value->id;
			$qry[$key]['value2'] = "roll";
			$qry[$key]['description'] = $value->attribute_number_gsm." GSM ". $value->attribute_number_w." CM";
			$qry[$key]['uom'] = $value->primary_uom;
		}

		$roll = \App\ItemMaster::where('item_code', 'LIKE', '%'.$term.'%')->Orwhere('description', 'LIKE', '%'.$term.'%')->take(2)->get();
		foreach ($roll as $key => $value)
		{
			$qwry[$key]['value'] = $value->item_code;
			$qwry[$key]['value1'] = $value->inventory_item_id;
			$qwry[$key]['value2'] = "mtl";
			$qwry[$key]['description'] = $value->description;
			$qry[$key]['uom'] = $value->primary_uom_code;
		}

        $row = array_merge($qry,$qwry);
		return \Response::json($row);
	}


    public function purchase_report(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $draw = $request->get('draw');
         $start = $request->get("start");
         $rowperpage = $request->get("length"); // total number of rows per page

         $columnIndex_arr = $request->get('order');
         $columnName_arr = $request->get('columns');
         $order_arr = $request->get('order');
         $search_arr = $request->get('search');

         $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
         $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
         $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
         $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\PurchaseOrderDet::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\PurchaseOrderDet::select('count(*) as allcount')->count();

        // Get records, also we have included search filter as well
        $records = \App\PurchaseOrderDet::where("line_status" ,"!=",11 )->orderBy('created_at','desc')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        foreach ($records as $record) {

            $rate = \App\CurrencyRate::where('currency_id',$record->PurchaseOrder->currency_code ?? '')->latest('rate_date')->first();
            if($rate){
                // $price = $record->unit_price * (float)$rate->rate;
                $price = $record->unit_price ;
            }else{
                $price = $record->unit_price ?? 0;
            }
            $data_arr[] = array(
                "id" => $record->id,
                "segment1" =>   $record->PurchaseOrder->segment1 ?? '',
                "vendor_id" =>   $record->PurchaseOrder->vendor_id ?? '',
                "vendor_name" =>   $record->PurchaseOrder->Vendor->vendor_name ?? '',
                "itemMaster" =>   $record->itemMaster->item_code.' - '.$record->itemMaster->description ,
                "unit_price" =>   number_format($price,2),
                "po_quantity" =>   number_format($record->po_quantity,2),
                "quantity_receive" =>   number_format($record->quantity_receive,2),
                "quantity_outstanding" =>   number_format($record->po_quantity - $record->quantity_receive,2),
                "currency_code" => $record->PurchaseOrder->currency_code ?? '',
                "subtotal" =>   number_format(($record->quantity_receive * ($price*15000)),2),
                "user" => $record->PurchaseOrder->User->name ?? '',
                "trx_name" => $record->PurchaseOrder->TrxStatuses->trx_name ?? '',
                "pr_num" => $record->attribute1 ?? '',
                "created_at" => $record->created_at->format('d-M-Y'),
            );
        }


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }

    public function shipment_report(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\DeliveryDetail::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\DeliveryDetail::select('count(*) as allcount')->where('id', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\DeliveryDetail::orderBy('created_at','desc')
                 ->skip($start)
                 ->take($rowperpage)
                 ->get();
        $data_arr = array();
        foreach ($records as $record) {
            // $qty = \App\DeliveryDetail::where('delivery_detail_id','=',$record->delivery_id)->sum('requested_quantity');
            $roll = \App\DeliveryDistrib::where('header_id','=',$record->delivery_detail_id)->select(DB::raw('count(container_item_id) as roll, sum(attribute_number1) as qty'))->first();

            $data_arr[] = array(
                "id" => $record->delivery_detail__id,
                "customer_name" =>   $record->delivery->customer->party_name ??'',
                "site" =>   $record->delivery->party_site->site_code ??'',
                "currency" =>   $record->delivery->attribute2,
                "delivered_quantity" => $qty ?? 0,
                "item_code" => $record->ItemMaster->item_code."-".$record->item_description ,
                "packing_slip_number" => $record->delivery->packing_slip_number,
                "customer_po_number" =>   $record->cust_po_number,
                "so_number" =>   $record->source_header_number,
                "qty" =>   $record->shipped_quantity,
                "requested_qty" =>   $record->requested_quantity,
                "note" =>   $record->delivery->attribute2,
                "uom" =>   $record->requested_quantity_uom,
                "unit_price" =>   $record->unit_price,
                "currency_code" =>   $record->currency_code,
                "shipment_date" => date('d-M-Y',strtotime($record->delivery->on_or_about_date)),
                "lvl" =>   $record->lvl,
                "roll" =>   $roll->roll,
                // "qty" =>   $roll->qty,
                "total" =>   number_format($record->unit_price*$record->shipped_quantity,2),
                "trx_name" =>   $record->delivery->trxstatus->trx_name
            );
        }


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }

    public function vendor_data(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\Vendor::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\Vendor::select('count(*) as allcount')->where('vendor_name', 'like', '%' . $searchValue . '%')
        ->orWhere('address1', 'like', '%' . $searchValue . '%')
        ->orWhere('country', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\Vendor::orderBy('created_at','desc')->where('vendor_name', 'like', '%' . $searchValue . '%')
                 ->orWhere('address1', 'like', '%' . $searchValue . '%')
                 ->orWhere('country', 'like', '%' . $searchValue . '%')
                 ->skip($start)
                 ->take($rowperpage)
                 ->get();
        $data_arr = $records;


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function site_data(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\Site::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\Site::select('count(*) as allcount')->where('address1', 'like', '%' . $searchValue . '%')
        ->orWhere('country', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\Site::orderBy('created_at','desc')->where('address1', 'like', '%' . $searchValue . '%')
                 ->orWhere('country', 'like', '%' . $searchValue . '%')
                 ->skip($start)
                 ->take($rowperpage)
                 ->get();
        $data_arr = $records;


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function subinv_data(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\Subinventories::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\Subinventories::select('count(*) as allcount')->where('sub_inventory_name', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\Subinventories::orderBy('created_at','desc')->where('sub_inventory_name', 'like', '%' . $searchValue . '%')
                 ->skip($start)
                 ->take($rowperpage)
                 ->get();
        $data_arr = $records;
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }

    public function completion_index(Request $request)
    {
        $datefrom = $request->input('min');
        $dateto = $request->input('max');

        $draw = $request->get('draw');
        $start = $request->get("start");
        $search_arr = $request->get('search');
        $rowperpage = $request->get("length");

        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        $totalRecords = \App\InvOnhandFG::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\InvOnhandFG::select('count(*) as allcount')->Where('uniq_attribute_roll', 'like', '%' . $searchValue . '%')->count();


        if($datefrom==null&&$dateto==null){
            $completion = \App\InvOnhandFG::orderBy('created_at','desc')
            ->where('uniq_attribute_roll','like','%'.$searchValue.'%')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        }else{
            $completion = \App\InvOnhandFG::whereBetween('created_at', [$datefrom,$dateto])
            ->where('uniq_attribute_roll','like','%'.$searchValue.'%')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        }
        $data_arr = array();
        foreach ($completion  as  $key => $row) {
            $data_arr[] = array(
                "id" => $row->id,
                "invitem" => $row->itemmaster->item_code ?? $row->inventory_item_id,
                "desc" =>$row->itemmaster->description ?? '',
                "roll_code" => $row->uniq_attribute_roll,
                "type" => isset($row->secondary_quantity)?'Chainsaw':"Roll",
                "qty" => $row->primary_quantity ?? '',
                "gsm" => $row->attribute_number_gsm,
                "width" => $row->attribute_number_w,
                "transdate" => $row->completion_date ?? '',
                "wonum" => $row->attribute_char ?? '',
            );
        }
        $response = array(
            "aaData" => $data_arr,
        );
        return json_encode($response);
    }

    public function auto_create(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\RequisitionDetail::where('purchase_status',2)->count();
        $totalRecordswithFilter = \App\RequisitionDetail::select('count(*) as allcount')->where([['id', 'like', '%' . $searchValue . '%'],['purchase_status',2]])
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\RequisitionDetail::orderBy('created_at','desc')
                 ->skip($start)
                 ->take($rowperpage)
                 ->where('purchase_status',2)
                 ->get();
        $data_arr = array();
        foreach ($records as $record) {
            if($record->TrxStatuses->trx_name=="Approve"){
            $status = '<a class="badge bg-warning text-white">Approved</a>';
        }else{
            $status=$record->TrxStatuses->trx_name;
        }
            $data_arr[] = array(
                "id" => $record->id,
                "ponumber" => $record->PurchaseRequisition->segment1 ?? '',
                "line_id" => number_format((float)$record->split_line_id, 1, '.', ''),
                "item_code" => $record->ItemMaster->item_code,
                "description" => $record->ItemMaster->description,
                "quantity" => $record->quantity,
                "uom" => $record->pr_uom_code,
                "cost" => $record->estimated_cost,
                "created_By" => $record->PurchaseRequisition->user->name ?? '',
                "date" => isset($record->PurchaseRequisition->created_at)? date('d-M-Y',strtotime($record->PurchaseRequisition->created_at)) :'',
                "stts" =>  $status ?? '',
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function ar_index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        // Total records
        $totalRecords = \App\SalesOrder::whereNotNull('inv_number')->count();
        $totalRecordswithFilter = \App\SalesOrder::whereNotNull('inv_number')->count();


        // Get records, also we have included search filter as well
        $records = \App\SalesOrder::orderBy('created_at','desc')
                 ->skip($start)
                 ->take($rowperpage)
                 ->whereNotNull('inv_number')
                 ->where('attribute3', '!=', 'cash')
                 ->where('attribute3', '!=', 1)
                 ->get();
        $data_arr = array();
        foreach ($records as $record) {
            $dueDate = Carbon::parse($record->payment_due_date)->startOfDay();
            $currentDate = Carbon::now()->startOfDay();

            $diff = $dueDate->diffInDays($currentDate, false); // false: bisa negatif
            if ($diff > 0) {
                $dueText = "<a class='badge bg-danger text-white'>Lebih Dari {$diff} Hari</a>";
            } elseif ($diff < 0) {
                $dueText = "Kurang " . abs($diff) . " Hari";
            } else {
                $dueText = "<a class='badge bg-secondary text-white'>Due Date Hari Ini</a>";
            }

            $data_arr[] = array(
                "id" => $record->id,
                "inv_number" => $record->inv_number,
                "date" => $record->updated_at->format('d F Y'),
                "billto" => $record->customer->party_name,
                "shipto" =>$record->customer->city,
                "term" => $record->term->terms_name??'',
                "currency" => $record->attribute1,
                "tax" => $record->tax_exempt_flag,
                "amount" => number_format($record->total_payment, 0, ',', '.'),
                "paid" => number_format($record->paid_off, 0, ',', '.'),
                "not_paid" => number_format($record->total_payment - $record->paid_off, 0, ',', '.'),
                "duedate" => $dueText,
            );
        }
        // dd($data_arr);

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function ap_index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        // Total records
        $totalRecords = \App\PurchaseOrder::count();
        $totalRecordswithFilter = \App\PurchaseOrder::count();


        // Get records, also we have included search filter as well
        $records = \App\PurchaseOrder::orderBy('created_at','desc')
                 ->skip($start)
                 ->take($rowperpage)
                 ->get();
        $data_arr = array();
        foreach ($records as $record) {
            $dueDate = Carbon::parse($record->payment_due_date)->startOfDay();
            $currentDate = Carbon::now()->startOfDay();

            $diff = $dueDate->diffInDays($currentDate, false); // false: bisa negatif
            if ($diff > 0) {
                $dueText = "<a class='badge bg-danger text-white'>Lebih Dari {$diff} Hari</a>";
            } elseif ($diff < 0) {
                $dueText = "Kurang " . abs($diff) . " Hari";
            } elseif ($diff = 'null') {
                $dueText = "<a class='badge bg-primary text-white'>Pembayaran Cash</a>";
            } 
            else {
                $dueText = "<a class='badge bg-secondary text-white'>Due Date Hari Ini</a>";
            }
            if ((float)$record->attribute1 === (float)$record->attribute2) {
                $payment = "<a class='badge bg-primary text-white'>Lunas</a>";
            }else{
                $payment=number_format($record->attribute1 - $record->attribute2, 0, ',', '.');
            }
            $data_arr[] = array(
                "id" => $record->id,
                "po" => $record->segment1,
                "vendor" => $record->vendor->vendor_name,
                "inv_num" =>'INV-' . $record->segment1,
                "term" => $record->terms->terms_name??'',
                "currency" => $record->currency_code,
                "tax" => $record->taxes->tax_code??'',
                "amount" => number_format($record->attribute1, 0, ',', '.'),
                "paid" => number_format($record->attribute2, 0, ',', '.'),
                "not_paid" => $payment,
                "duedate" => $dueText,
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }
    public function data_vendor(Request $request)
    {

    	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');

        if (!empty($request->get('search'))) {
            $searchValue=$request->get('search');

        }else{
            $searchValue="";
        }

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        //$searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\Vendor::count();
        $totalRecordswithFilter = \App\Vendor::select('count(*) as allcount')->where([['vendor_name', 'like', '%' . $searchValue . '%']])
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\Vendor::orderBy('created_at','desc')
                 ->skip($start)
                 ->take($rowperpage)
                 ->where([['vendor_name', 'like', '%' . $searchValue . '%']])
                 ->get();
        $data_arr = array();
        foreach ($records as $record) {

            $data_arr[] = array(
                "vendor_id" => $record->vendor_id,
                "vendor_name" => $record->vendor_name ?? '',
                "address1" => $record->address1,
                "phone" => $record->phone,
                "email" => $record->email ?? '',
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return json_encode($response);

    }

    public function delivery_closed(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       	$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = isset( $columnIndex_arr[0][1])? $columnIndex_arr[0][1] :""; // Column index
        $columnName =isset($columnName_arr[$columnIndex]['parent_code']) ?  $columnName_arr[$columnIndex]['parent_code'] : "";
        $columnSortOrder = isset($order_arr[0]['dir'])? $order_arr[0]['dir'] :""; // asc or desc
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";

        // Total records
        $totalRecords = \App\DeliveryHeader::select('count(*) as allcount')->count();
        $totalRecordswithFilter = \App\DeliveryHeader::select('count(*) as allcount')->where('id', 'like', '%' . $searchValue . '%')
        ->orWhere('id', 'like', '%' . $searchValue . '%')
        ->count();

        // Get records, also we have included search filter as well
        $records = \App\DeliveryHeader::leftjoin('bm_ra_customer_trx_all','bm_ra_customer_trx_all.attribute1','=','bm_wsh_new_deliveries.delivery_id')
            ->select('bm_wsh_new_deliveries.*')
            ->where('bm_wsh_new_deliveries.status_code',12)
            ->where('bm_wsh_new_deliveries.lvl',12)
            ->where('bm_ra_customer_trx_all.attribute1',NULL)
            ->where(function($query) use($searchValue){
                $query ->where('bm_wsh_new_deliveries.ship_to_party_id', 'like', '%' . $searchValue . '%')
                ->orWhere('bm_wsh_new_deliveries.dock_code','like','%'.$searchValue.'%')
                ->orWhere('bm_wsh_new_deliveries.delivery_id', 'like', '%' . $searchValue . '%');
            })
            ->orderBy('bm_wsh_new_deliveries.delivery_id','DESC')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($records as $record) {
            $qty = \App\DeliveryDetail::where('delivery_detail_id','=',$record->delivery_id)->sum('requested_quantity');
            $roll = \App\DeliveryDistrib::where('header_id','=',$record->delivery_id)->select(DB::raw('count(container_item_id) as roll, sum(attribute_number1) as qty'))->first();
            dd($record);

            $data_arr[] = array(
                "id" => $record->delivery_id,
                "customer_name" =>   $record->customer->party_name ??'',
                "site" =>   $record->party_site->address1 ??'',
                "currency" =>   $record->attribute2,
                "delivered_quantity" => $qty ?? 0,
                "packing_slip_number" => $record->packing_slip_number,
                "note" =>   $record->attribute2,
                "delivery_note" =>   $record->dock_code,
                "term" =>   $record->term->term_code,
                "shipment_date" => date('d-M-Y',strtotime($record->on_or_about_date)),
                "lvl" =>   $record->lvl,
                "roll" =>   $roll->roll,
                "qty" =>   $roll->qty,
                "trx_name" =>   $record->trxstatus->trx_name,
                "currency" =>   $record->attribute1
            );
        }


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

         return json_encode($response);
    }


    public function gl_bank(Request $request){
        $gl = \App\GlHeader::orderBy('default_effective_date', 'ASC')
                    ->where(['je_category'=>'bank'])->get();

        $data_arr = array();
        foreach ($gl as $row) {
            $data_arr[] = array(
                "id"=>$row->je_header_id,
                "name" =>$row->name,
                "default_effective_date"=>$row->default_effective_date->format('d/m/Y'),
                "period_name"=>$row->period_name,
                "external_reference"=>$row->external_reference,
                "je_category"=>$row->je_category,
                "currency_code"=>$row->currency_code,
            );
        }
        $response = array(
            "aaData" => $data_arr,
        );
         return json_encode($response);
    }
    public function gl_cash(Request $request){
        $gl = \App\GlHeader::orderBy('default_effective_date', 'ASC')
                    ->where(['je_category'=>'cash'])->get();

        $data_arr = array();
        foreach ($gl as $row) {
            $data_arr[] = array(
                "id"=>$row->je_header_id,
                "name" =>$row->name,
                "default_effective_date"=>$row->default_effective_date->format('d/m/Y'),
                "period_name"=>$row->period_name,
                "external_reference"=>$row->external_reference,
                "je_category"=>$row->je_category,
                "currency_code"=>$row->currency_code,
            );
        }
        $response = array(
            "aaData" => $data_arr,
        );
         return json_encode($response);
    }
    public function roll(Request $request){

        $search_arr = $request->get('search');
        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records
        $totalRecords = \App\DeliveryDistrib::select('count(*) as allcount')
        ->Where('header_id',$request->delivery_name)
        ->count();

        $totalRecordswithFilter = \App\DeliveryDistrib::select('count(*) as allcount')
        ->Where('header_id',$request->delivery_name)
        ->Where('container_item_id', 'like', '%' . $searchValue . '%')
        ->count();
        if($searchValue==null){
            $datamodel = DeliveryDistrib::Where('header_id',$request->delivery_name)->get();
        }
      else{
        $update = DeliveryDistrib::Where('header_id',$request->delivery_name)
        ->where('container_item_id', '=', $searchValue)->update([
            "preferred_flag"=>1,
        ]);
        $datamodel = DeliveryDistrib::Where('header_id',$request->delivery_name)
        // ->where('container_item_id', '=', $searchValue)
        ->get();

      }
        $data_arr = array();
        foreach ($datamodel  as  $key => $row) {
            $data_arr[] = array(
                "id" => $row->id,
                "container_item_id" =>$row->container_item_id,
                "attribute1" =>$row->attribute1,
                "attribute3" => $row->attribute3,
                "attribute_number1" => $row->attribute_number1,
                "created_at" => $row->created_at,
                "preferred_flag" => $row->preferred_flag,

            );
        }
        $response = array(
            "aaData" => $data_arr,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
        );
        return json_encode($response);
	}
}
