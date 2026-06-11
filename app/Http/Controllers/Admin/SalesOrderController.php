<?php

namespace App\Http\Controllers\Admin;

use App\AccountCode;
use App\Currency;
use App\CurrencyGlobal;
use App\Customer;
use App\Faktur;
use App\GlHeader;
use App\GlLines;
use App\Onhand;
use App\MaterialTxns;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreSalesOrderRequest;
use App\Http\Requests\UpdateSalesOrderRequest;
use App\ItemMaster;
use App\SalesOrder;
use App\SalesOrderDetail;
use App\DeliveryHeader;
use App\DeliveryDetail;
use App\Terms;
use Image;
use App\Site;
use App\MaterialTransaction;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PriceListDetail;
use App\PriceList;
use App\Tax;
use DB;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sales_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cust = \App\Customer::get();
        return view('admin.sales.index',compact('cust'));
    }

    public function create()
    {
        abort_if(Gate::denies('sales_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_team = User::all();
        $customer = Customer::All();
        $price = PriceList::all();
        $site = Site::get();
        $terms = Terms::get();
        $tax = \App\Tax::get();
        $currency = CurrencyGlobal::get();
        $subinventories = \App\Subinventories::select('sub_inventory_name', 'description')
            ->whereNull('deleted_at')->orderBy('sub_inventory_name')->get();
        return view('admin.sales.create', compact('sales_team','price', 'customer', 'currency', 'terms','site','tax','subinventories'))->with('no',1);
    }

    public function store(StoreSalesOrderRequest $request)
    {
        if(is_null($request->inventory_item_id)){
            return back()->with('error', 'Sales Order Detail Cant Be Empty' );
        }
            $code = $request->type;
            $d = $code.'%';
            $id = (DB::table('bm_order_headers_all')->where('order_number','like',$d)->count('header_id'))+1;
            $order_number = $code.str_pad($id,5,"0",STR_PAD_LEFT);

            $h = '%';
            $header_id =DB::table('bm_order_headers_all')->get()->count();
            $header_id = $header_id ?? 0;

            // $header_id = DB::table('bm_order_headers_all')->count();
            // $header_id = ($header_id == 0) ? 1 : $header_id + 1;
            $header_id = $header_id+1;
            $header = SalesOrder::findorNew($request->id);
            $header->header_id = $header_id;
            $header->order_number = $order_number;
            $header->cust_po_number = $request->cust_po_number;
            $header->price_list_id = $request->po_number;
            $header->attribute1 = $request->customer_currency;
            $header->attribute2 = $request->type;
            $header->order_type_id = $request->type;
            $header->ordered_date = $request->ordered_date;
            $header->invoice_to_org_id = $request->bill_to;
            $header->deliver_to_org_id = $request->deliver_to_org_id;
            $header->freight_terms_code = $request->freight_terms_code;
            $header->attribute3 =$request->payment_method;
            $header->total_payment = (int) str_replace(['.', ','], ['', '.'], $request->purchase_total);
            $header->total_payment_untax = (int) str_replace(['.', ','], ['', '.'], $request->tax_amount);
            $header->open_flag = 14;
            $header->tax_exempt_flag =(int) $request->select_tax;
            $header->org_id = Auth::user()->org_id;
            $header->created_by = auth()->user()->id;
            $header->faktur = $request->faktur;
            $header->save();

            $id = DB::table('bm_wsh_new_deliveries')->latest('delivery_id')->first();
            $id = $id->delivery_id ?? 0;
            $id = ($id == 0) ? 1 : $id + 1;

            $head = DeliveryHeader::findOrNew($id);
            $deliverynumber=str_pad($id+1, 4, "0", STR_PAD_LEFT);
            
            $deliveryhead=DeliveryHeader::Create([
                'delivery_id'=>$deliverynumber,
                'sold_to_party_id'=>$request->bill_to,
                'ship_to_party_id'=>$request->deliver_to_org_id,
                'attribute1'=>$request->customer_currency,
                'delivery_name'=>date('ym').$deliverynumber,
                'order_number'=>$order_number,
                'lvl'=>6,
                'created_by'=>Auth::user()->id,
                'status_code'=>14,
                'currency_code'=>$request->customer_currency,

            ]);
        try {
                DB::beginTransaction();
                foreach($request->inventory_item_id as $key =>$inventory_item_id){
                    $line_id = $key+1;

                    if(empty($request->schedule_ship_date[$key] && $request->ordered_quantity [$key] )){
                        return back()->with('error','Qty & Schedule Ship Date is Required');
                    }
                    $data = array(
                        'header_id'=>$header_id,
                        'line_id'=>$line_id,
                        'split_line_id'=>$line_id,
                        'inventory_item_id'=>$request->inventory_item_id [$key],
                        'user_description_item'=>$request->item_sales [$key],
                        'order_quantity_uom'=>$request->uom [$key],
                        'unit_selling_price'=>$request->unit_selling_price [$key],
                        'packing_style'=>$request->packing_style [$key],
                        'shipping_inventory'=>$request->shipping_inventory[$key],
                        'ordered_quantity'=>$request->ordered_quantity [$key],
                        'price_list_id'=>$request->price_list_id [$key],
                        'pricing_attribute1'=>$request->pricing_attribute1 [$key],
                        'unit_percent_base_price'=>intval(str_replace(['.', ','], ['', '.'], $request->unitprice_[$key])),
                        'unit_list_price'=>intval(str_replace(['.', ','], ['', '.'], $request->sutot[$key])),
                        'schedule_ship_date'=>$request->schedule_ship_date [$key],
                        'flow_status_code'=>$request->flow_status [$key],
                        'created_by'=>$request->created_by,
                        'disc'=>$request->disc[$key],
                        'request_date'=>date('Y-m-d'),
                        'org_id'=>Auth::user()->org_id,
                    );
                   
                    
                    $dataDO = array(
                        'delivery_detail_id'=>$deliverynumber,
                        'source_header_number'=>$order_number,
                        'cust_po_number'=>$request->cust_po_number,
                        'item_code' => str_replace('-', '', $request->item_sales[$key]),
                        'item_description'=>$request->item_sales [$key],
                        'requested_quantity'=>$request->ordered_quantity [$key],
                        'requested_quantity_uom'=>$request->uom [$key],
                        'inventory_item_id'=>$request->inventory_item_id [$key],
                    );
                    SalesOrderDetail::create($data);
                    DeliveryDetail::create($dataDO);

                }
            DB::commit();
            $id=SalesOrder::where('header_id',$header_id)->latest('header_id');
            return redirect()->route('admin.salesorder.edit',$header_id)->with('success', 'Data Stored');
        }catch (Throwable $e){
            dd($e);
            DB::rollback();
            return back()->with('error','Data Cant be empty '.$e.'');
        }
    }

    public function edit(Request $request,$id)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sales = SalesOrder::where('header_id',$id)->select('*')->first();

        if (!is_null($sales->inv_number)) {
            return redirect()->route('admin.salesorder.show', $sales->id)
                ->with('message', 'Sales Order tidak dapat diedit karena sudah memiliki Invoice.');
        }

        $sales_team = User::all();
        $customer = Customer::all();
        $salesDetail = SalesOrderDetail::where('header_id','=',$sales->header_id)->whereNull('deleted_at')->get();
        $terms = Terms::where('term_category','PAYMENT')->get();
        $price = PriceList::all();
        $site = Site::all();
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $tax = \App\Tax::get();
        $subinventories = \App\Subinventories::select('sub_inventory_name', 'description')
            ->whereNull('deleted_at')->orderBy('sub_inventory_name')->get();
        return view('admin.sales.edit', compact('sales_team','site','price','salesDetail','sales', 'customer', 'currency', 'terms','tax','subinventories'));
    }

    public function update(UpdateSalesOrderRequest $request)
    {

        switch ($request->input('action')) {
            case 'save':
                // dd($request);
                $header = SalesOrder::find($request->header_id);
                // $header->user_item_description = $request->user_item_description;
                // $header->cust_po_number = $request->cust_po_number;
                // $header->attribute1 = $request->customer_currency;
                // $header->attribute2 = $request->type;
                // $header->order_type_id = $request->type;
                // $header->ordered_date = $request->ordered_date;
                // $header->price_list_id = $request->po_number;
                // $header->invoice_to_org_id = $request->bill_to;
                // $header->deliver_to_org_id = $request->deliver_to_org_id;
                // $header->freight_terms_code = $request->freight_terms_code;
                $header->booked_flag = $request->flow_status_code;
                $header->save();

                // Update / tambah baris detail SO
                if ($request->has('id_line')) {
                    foreach ($request->id_line as $key => $id) {
                        if (!empty($id)) {
                            // Update baris existing
                            $detail = SalesOrderDetail::find($id);
                            if ($detail) {
                                $detail->ordered_quantity   = $request->ordered_quantity[$key];
                                $detail->unit_selling_price = (float) $request->unit_selling_price[$key];
                                $detail->disc               = (float) ($request->disc[$key] ?? 0);
                                $detail->schedule_ship_date = $request->schedule_ship_date[$key];
                                $detail->shipping_inventory = $request->shipping_inventory[$key] ?? $detail->shipping_inventory;
                                $detail->save();
                            }
                        } elseif (!empty($request->inventory_item_id[$key])) {
                            // Buat baris baru
                            $nextLineId = (SalesOrderDetail::where('header_id', $header->header_id)->max('line_id') ?? 0) + 1;
                            SalesOrderDetail::create([
                                'header_id'            => $header->header_id,
                                'line_id'              => $nextLineId,
                                'split_line_id'        => $nextLineId,
                                'inventory_item_id'    => $request->inventory_item_id[$key],
                                'user_description_item'=> $request->item_sales[$key] ?? '',
                                'ordered_quantity'     => $request->ordered_quantity[$key],
                                'unit_selling_price'   => (float) $request->unit_selling_price[$key],
                                'disc'                 => (float) ($request->disc[$key] ?? 0),
                                'schedule_ship_date'   => $request->schedule_ship_date[$key],
                                'order_quantity_uom'   => 'KG',
                                'shipping_inventory'   => $request->shipping_inventory[$key] ?? null,
                                'flow_status_code'     => 5,
                                'org_id'               => Auth::user()->org_id,
                                'created_by'           => Auth::user()->id,
                            ]);
                        }
                    }
                }
            break;
            case 'add_lines':
                // add split line on edit
                $new_split_lines = SalesOrderDetail::find($request->req_line_id);
                $header = SalesOrder::find($request->header_id);

                if (!is_null($header->inv_number)) {
                    return back()->with('error', 'Tidak dapat menambah baris, SO sudah memiliki Invoice.');
                }

                $new_lines = array(
                     'header_id'=> $new_split_lines->header_id,
                     'line_id'=>  SalesOrderDetail::where(['header_id'=>$new_split_lines->header_id,'line_id'=>$new_split_lines->line_id])
                                        ->latest()->first()->line_id+1,
                     'split_line_id'=> SalesOrderDetail::where(['header_id'=>$new_split_lines->header_id,'line_id'=>$new_split_lines->line_id])
                                                            ->latest()->first()->split_line_id+0.1,
                     'inventory_item_id'=>$new_split_lines->inventory_item_id,
                     'ordered_quantity'=>$request->split_quantity,
                     'user_description_item'=>$new_split_lines->user_description_item ,
                     'order_quantity_uom'=>'KG',
                     'unit_selling_price'=>$new_split_lines->unit_selling_price,
                     'price_list_id'=>$new_split_lines->price_list_id,
                     'pricing_attribute1'=>$request->id,
                     'schedule_ship_date'=>$new_split_lines->schedule_ship_date ,
                     'attribute_number_gsm'=>$new_split_lines->attribute_number_gsm ,
                     'attribute_number_w'=>$new_split_lines->attribute_number_w ,
                     'attribute_number_l'=>$new_split_lines->attribute_number_l ,
                     'line_number'=>$new_split_lines->line_number ,
                     'flow_status_code'=>$new_split_lines->flow_status_code,
                     'tax_code'=>$new_split_lines->tax_code,
                     'packing_style'=>$new_split_lines->packing_style,
                     'shipping_inventory'=>$new_split_lines->shipping_inventory,
                     'created_by'=>$new_split_lines->created_by,
                     'updated_by'=>$new_split_lines->updated_by,
                     'created_at'=>date('Y-m-d H:i:s'),
                     'updated_at'=>date('Y-m-d H:i:s'),
                     'org_id'=>Auth::user()->org_id,
                );

                if($new_split_lines->flow_status_code == 5 || $header->booked_flag == null){
                    // dd("Masuk");
                    SalesOrderDetail::create($new_lines);
                    SalesOrderDetail::where(['id'=>$request->req_line_id])->update(["ordered_quantity"=>  $new_split_lines->ordered_quantity-$request->split_quantity]);
                }else{
                    return back()->with('error', 'Not Allow to Split');
                }
            break;
            case 'CpyLines':
                if($request->booked==null){
                    return back()->with('error', 'Copy Line is not allowed');
                }
                $quantitycancel = $request->qty;
                $id_check=$request->id;

                if($id_check==null ){
                    return back()->with('error', 'Please select row');
                }

                $code = $request->actionreturn;
                $d = $code.'%';
                $id = (DB::table('bm_order_headers_all')->where('order_number','like',$d)->count('header_id'))+1;
                $order_number = $code.str_pad($id,5,"0",STR_PAD_LEFT);
                $ids = $request->id;
                $h = '%';
                $header_id = SalesOrder::latest()->first()->count('header_id')+1;

                $salesheader = SalesOrder::select('bm_order_headers_all.*','bm_currencies_id_all.currency_code')
                ->leftjoin('bm_currencies_id_all','bm_currencies_id_all.id','=','bm_order_headers_all.attribute1')
                ->where('header_id',$request->header_id)
                ->first();
                $billto = $salesheader->invoice_to_org_id;
                $shipTo = $salesheader->deliver_to_org_id;
                $header = array(
                    'header_id'=>$header_id,
                    'user_item_description'=>$salesheader->user_item_description,
                    'order_number'=>$order_number,
                    'attribute2'=>$code,
                    'attribute1'=>$salesheader->attribute1,
                    'invoice_to_org_id'=>$salesheader->invoice_to_org_id,
                    'org_id'=>$request->org,
                    'ordered_date'=>date('Y-m-d',strtotime($request->ordered_date)),
                    'price_list_id'=>$salesheader->price_list_id,
                    'deliver_to_org_id'=>$request->deliver_to_org_id,
                    'freight_terms_code'=>$salesheader->freight_terms_code,
                    'cust_po_number'=>$salesheader->cust_po_number,
                    'attribute3'=>$salesheader->attribute3,
                    'open_flag'=>"14",
                    'booked_flag'=>$salesheader->booked_flag,
                    'order_source_id'=>$request->order_number,
                    'created_at'=>date('y-m-d'),
                    'updated_at'=>date('y-m-d'),
                    'org_id'=>Auth::user()->org_id,
                );
                SalesOrder::create($header);
                if($code == 50||$code == 51){
                    foreach($request->id as $key =>$value){
                        if(in_array($request->id[$key],$request->id)){
                            // dd((float)$request->line[$key]);
                            $data = array(
                                'header_id'=>$header_id,
                                'line_id'=>(int)$request->line[$key],
                                'split_line_id'=>(float)$request->split[$key],
                                'inventory_item_id'=>$request->inventory[$key],
                                'user_description_item'=>$request->item_description[$key],
                                'order_quantity_uom'=>$request->order_quantity_uom[$key],
                                'unit_selling_price'=>$request->usp[$key],
                                'attribute_number_gsm'=>$request->attribute_number_gsm[$key],
                                'attribute_number_w'=>$request->attribute_number_w[$key],
                                'attribute_number_l'=>$request->attribute_number_l[$key],
                                'packing_style'=>$request->paking[$key],
                                'shipping_inventory'=>$request->shipin[$key],
                                'ordered_quantity'=>abs($request->qty[$key]),
                                'price_list_id'=>$request->praisid[$key],
                                'line_number'=>$request->line_number[$key],
                                'pricing_attribute1'=>$request->att1[$key],
                                'schedule_ship_date'=>$request->skedul[$key],
                                'flow_status_code'=>6,
                                'tax_code'=>$request->takode[$key],
                                'created_by'=>$request->created_by,
                                'org_id'=>Auth::user()->org_id,
                            );
                            SalesOrderDetail::create($data);
                        }
                    };
                }else{
                    foreach($request->id as $key =>$value){
                        if(in_array($request->id[$key],$request->id)){
                            $data = array(
                                'header_id'=>$header_id,
                                'line_id'=>$request->line[$key],
                                'split_line_id'=>$request->split[$key],
                                'inventory_item_id'=>$request->inventory[$key],
                                'user_description_item'=>$request->item_description[$key],
                                'order_quantity_uom'=>$request->order_quantity_uom[$key],
                                'unit_selling_price'=>$request->usp[$key],
                                'packing_style'=>$request->paking[$key],
                                'shipping_inventory'=>$request->shipin[$key],
                                'attribute_number_gsm'=>$request->attribute_number_gsm[$key],
                                'attribute_number_w'=>$request->attribute_number_w[$key],
                                'attribute_number_l'=>$request->attribute_number_l[$key],
                                'ordered_quantity'=>-1*$request->qty[$key],
                                'line_number'=>$request->line_number[$key],
                                'price_list_id'=>$request->praisid[$key],
                                'pricing_attribute1'=>$request->att1[$key],
                                'schedule_ship_date'=>$request->skedul[$key],
                                'flow_status_code'=>6,
                                'tax_code'=>$request->takode[$key],
                                'created_by'=>$request->created_by,
                                'org_id'=>Auth::user()->org_id,
                            );
                            SalesOrderDetail::create($data);
                        }
                    };
                }
                $salesId = SalesOrder::latest('id')->first();
                $sales = SalesOrder::find($salesId->id);
                $sales_team = User::all();
                $customer = Customer::all();
                $salesDetail = SalesOrderDetail::where('header_id','=',$sales->header_id)->whereNull('deleted_at')
                ->with('price_list_detail')->get();
                $terms = Terms::where('term_category','PAYMENT')->get();
                $price = PriceList::all();
                $site = Site::all();
                $currency = CurrencyGlobal::where('currency_status', 1)->get();

                return view('admin.sales.edit', compact('sales_team','site','price','salesDetail','sales', 'customer', 'currency', 'terms'))->with('success', 'Sales Order Successed');
            break;
            case 'split_lines':

                $header = SalesOrder::find($request->header_id);

                if (!is_null($header->inv_number)) {
                    return back()->with('error', 'Tidak dapat split baris, SO sudah memiliki Invoice.');
                }

                if($header->open_flag == 14){
                    $nilaisplit=DB::table('bm_order_lines_all')->where('header_id',$request->headerId)->where('line_id',$request->linenya)->latest()->first();
                    $new_lines = array(
                        'header_id'=> $request->headerId,
                        'line_id'=>  $request->linenya,
                        'split_line_id'=> (float)$nilaisplit->split_line_id+0.1,
                        'inventory_item_id'=>$request->inv_item,
                        'ordered_quantity'=>$request->split_qty,
                        'user_description_item'=>$request->user_desc,
                        'order_quantity_uom'=>$request->qty_uom,
                        'unit_selling_price'=>$request->u_sellprice,
                        'price_list_id'=>$request->pricing,
                        'attribute_number_gsm'=>$nilaisplit->attribute_number_gsm,
                        'attribute_number_w'=>$nilaisplit->attribute_number_w,
                        'attribute_number_l'=>$nilaisplit->attribute_number_l,
                        'line_number'=>$nilaisplit->line_number,
                        'pricing_attribute1'=>$request->pricing_attr1,
                        'schedule_ship_date'=>$request->schedule,
                        'flow_status_code'=>$request->statuscode,
                        'tax_code'=>$request->tax,
                        'packing_style'=>$request->packing,
                        'shipping_inventory'=>$request->inv_ship,
                        'created_by'=>$request->created_by,
                        'updated_by'=>Auth::user()->id,
                        'org_id'=>Auth::user()->org_id,
                    );

                    if($request->split_qty>$request->qty){
                        return back()->with('error','Quantity not enaught');
                    }
                    if($request->flow_status_code== 5||$header->open_flag == 14){
                        SalesOrderDetail::create($new_lines);
                        SalesOrderDetail::where(['id'=>$request->item_ids])->update(["ordered_quantity"=>$request->qty-$request->split_qty]);
                        return back()->with('success', 'Split is allowed');
                    }else{
                        return back()->with('error', 'Not Allow to Split');
                    }
                }else{
                    return back()->with('error', 'Not Allow to Split');
                }
            break;
            case 'multipleDelete':
                // dd($request->item_ids);
                $idDelete = $request->item_ids;
                if($idDelete==null){
                    return back()->with('error','Please select row');
                }

                $header = SalesOrder::find($request->header_id);
                if (!is_null($header->inv_number)) {
                    return back()->with('error', 'Tidak dapat menghapus baris, SO sudah memiliki Invoice.');
                }

                $deleteAll = SalesOrderDetail::whereIn('id',$idDelete)
                    ->update(['deleted_at'=>date('Y-m-d H:i:s')]);
                return back()->with('success','Your data has been deleted');
            break;
            case 'imageSo':
                $this->validate($request, [
                    'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                ]);

                $image = $request->file('imgFile');

                $input['imagename'] =$request->id.'.'.$image->extension();

                $filePath = public_path('/thumbnails');
                $img = Image::make($image->path());

                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$input['imagename']);
                SalesOrder::where(['id'=>$request->id])->update(["source_document_id"=>'thumbnails'.'/'.$input['imagename']]);
                return back()
                    ->with('success','Image uploaded')
                    ->with('fileName',$input['imagename']);
            break;
        }
       return back()->with('success', 'Data Sales Successfull Edited');
    }

    public function show($id)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales = SalesOrder::find($id);
        $detail = SalesOrderDetail::where('header_id',$sales->header_id)->get();

        return view('admin.sales.view', compact('sales','detail'));
    }

    public function konfirmasiKirim($id)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales = SalesOrder::find($id);

        if ($sales->open_flag == 12) {
            return redirect()->route('admin.salesorder.show', $id)
                ->with('error', 'Sales Order ini sudah selesai dikirim.');
        }

        $detail = SalesOrderDetail::where('header_id', $sales->header_id)
            ->whereNull('deleted_at')
            ->get();

        $stock = [];
        foreach ($detail as $line) {
            $stock[$line->id] = Onhand::where('inventory_item_id', $line->inventory_item_id)
                ->where('subinventory_code', $line->shipping_inventory)
                ->first();
        }

        $fakturs = Faktur::whereNull('deleted_at')->get();
        return view('admin.sales.konfirmasi-kirim', compact('sales', 'detail', 'stock', 'fakturs'));
    }

    public function checkStock($id)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales  = SalesOrder::find($id);
        $detail = SalesOrderDetail::where('header_id', $sales->header_id)
            ->whereNull('deleted_at')->get();

        $unready = [];
        foreach ($detail as $line) {
            if (!$line->shipping_inventory) {
                $unready[] = [
                    'item'      => $line->user_description_item,
                    'warehouse' => null,
                    'required'  => $line->ordered_quantity,
                    'available' => 0,
                    'reason'    => 'Warehouse belum di-set',
                ];
                continue;
            }
            $onhand    = Onhand::where('inventory_item_id', $line->inventory_item_id)
                ->where('subinventory_code', $line->shipping_inventory)
                ->first();
            $available = $onhand ? $onhand->primary_transaction_quantity : 0;
            if ($available < $line->ordered_quantity) {
                $unready[] = [
                    'item'      => $line->user_description_item,
                    'warehouse' => $line->shipping_inventory,
                    'required'  => $line->ordered_quantity,
                    'available' => $available,
                    'reason'    => 'Stok kurang',
                ];
            }
        }

        return response()->json([
            'ready'   => count($unready) === 0,
            'unready' => $unready,
        ]);
    }

    public function prosesKirim(Request $request)
    {
        $request->validate([
            'sales_id'    => 'required',
            'ship_date'   => 'required|date',
            'tgl_invoice' => 'required|date',
            'faktur_code' => 'nullable|string',
            'line_id'     => 'required|array',
            'warehouse'   => 'required|array',
            'qty'         => 'required|array',
        ]);

        $sales = SalesOrder::find($request->sales_id);

        if ($sales->open_flag == 12) {
            return back()->with('error', 'Sales Order ini sudah selesai dikirim.');
        }

        DB::beginTransaction();
        try {
            foreach ($request->line_id as $key => $line_id) {
                $line      = SalesOrderDetail::find($line_id);
                $warehouse = $request->warehouse[$key];
                $qty       = $request->qty[$key];

                $onhand = Onhand::where('inventory_item_id', $line->inventory_item_id)
                    ->where('subinventory_code', $warehouse)
                    ->first();

                if (!$onhand || $onhand->primary_transaction_quantity < $qty) {
                    DB::rollBack();
                    return back()->with('error', 'Stock tidak cukup untuk item "' . $line->user_description_item . '" di gudang ' . $warehouse);
                }

                $onhand->primary_transaction_quantity -= $qty;
                $onhand->save();

                MaterialTxns::create([
                    'inventory_item_id'          => $line->inventory_item_id,
                    'subinventory_code'          => $warehouse,
                    'transaction_type_id'        => 33,
                    'transaction_quantity'        => -$qty,
                    'primary_quantity'            => -$qty,
                    'transaction_date'            => $request->ship_date,
                    'transaction_uom'             => $line->order_quantity_uom,
                    'transaction_source_id'       => $sales->header_id,
                    'transaction_source_name'     => $sales->order_number,
                    'created_by'                  => Auth::user()->id,
                ]);

                $line->flow_status_code   = 12;
                $line->fulfilled_quantity = $qty;
                $line->shipped_quantity   = $qty;
                $line->fulfillment_date   = now();
                $line->save();
            }

            $sales->open_flag = 12;
            $sales->save();

            if (is_null($sales->inv_number)) {
                $this->createInvoiceAfterShipment($sales, $request);
            }

            if ($request->buat_sj) {
                $delivery = DeliveryHeader::where('order_number', $sales->order_number)->first();
                if ($delivery) {
                    $delivery->status_code      = 12;
                    $delivery->lvl              = 12;
                    $delivery->actual_ship_date = $request->ship_date;
                    $delivery->confirmed_by     = Auth::user()->id;
                    $delivery->save();
                }
            }

            DB::commit();

            if ($request->buat_sj) {
                return redirect()->route('admin.salesorder.surat-jalan', $sales->id)
                    ->with('success', 'Pengiriman berhasil. Surat jalan siap dicetak.');
            }

            return redirect()->route('admin.salesorder.index')
                ->with('success', 'Pengiriman berhasil diproses.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function createInvoiceAfterShipment(SalesOrder $sales, Request $request): void
    {
        $soDetail   = SalesOrderDetail::where('header_id', $sales->header_id)->whereNull('deleted_at')->get();
        $ppn        = AccountCode::where('account_code', '3202')->first();
        $termMaster = Terms::where('id', $sales->attribute3)->first();
        $trx        = MaterialTransaction::whereIn('trx_code', [4])->first();

        $taxRate    = $sales->tax_exempt_flag ?? 0;
        $taxMult    = $taxRate > 0 ? (1 + $taxRate / 100) : 1;
        $invNumber  = 'INV-' . $sales->order_number;
        $jeBatchId  = rand(0, 999999);
        $jeCategory = $trx->trx_source_types ?? 'INVOICE';
        $invDate    = $request->tgl_invoice;

        $lines     = [];
        $totalDr   = 0;
        $totalCr   = 0;
        $unitprice = 0;
        $totalHp   = 0;

        foreach ($soDetail as $row) {
            $calcUnit  = ($row->ordered_quantity * $row->unit_selling_price) - ($row->disc ?? 0);
            $crValue   = $calcUnit / $taxMult;
            $unitprice += $calcUnit;
            $totalHp   += $crValue;
            $lines[]   = ['accDes' => $row->products->category->acc->account_code ?? '', 'desc' => $row->user_description_item ?? '', 'dr' => 0, 'cr' => $crValue];
            $totalCr   += $crValue;
        }

        foreach ($soDetail as $row) {
            $drValue = ($row->products->item_cost ?? 0) * $row->ordered_quantity;
            $lines[] = ['accDes' => $row->products->category->cogs->account_code ?? '', 'desc' => $row->user_description_item ?? '', 'dr' => $drValue, 'cr' => 0];
            $totalDr += $drValue;
        }

        foreach ($soDetail as $row) {
            $crValue = ($row->products->item_cost ?? 0) * $row->ordered_quantity;
            $lines[] = ['accDes' => $row->products->category->cogs->account_code ?? '', 'desc' => $row->user_description_item ?? '', 'dr' => 0, 'cr' => $crValue];
            $totalCr += $crValue;
        }

        $taxAmount = $unitprice - $totalHp;
        $lines[]   = ['accDes' => $ppn->account_code ?? '', 'desc' => $ppn->account_group ?? '', 'dr' => 0, 'cr' => $taxAmount];
        $totalCr   += $taxAmount;

        foreach ($soDetail as $row) {
            $drValue = ($row->ordered_quantity * $row->unit_selling_price) - ($row->disc ?? 0);
            $accDes  = $sales->attribute3 == 'cash'
                ? ($row->products->category->cash->account_code ?? '')
                : ($row->products->category->arTax->account_code ?? '');
            $lines[] = ['accDes' => $accDes, 'desc' => $row->user_description_item ?? '', 'dr' => $drValue, 'cr' => 0];
            $totalDr += $drValue;
        }

        $lastHeader = DB::table('bm_gl_je_headers')->orderBy('id', 'desc')->first();
        $newId      = $lastHeader ? $lastHeader->id + 1 : 1;

        $head                         = new GlHeader();
        $head->je_source              = $jeCategory . $invNumber;
        $head->default_effective_date = Carbon::parse($invDate)->format('Y-m-d');
        $head->period_name            = Carbon::parse($invDate)->format('M y');
        $head->external_reference     = $invNumber;
        $head->je_category            = $jeCategory;
        $head->currency_code          = $sales->attribute1;
        $head->je_header_id           = $newId;
        $head->name                   = $jeCategory . ' - ' . ($sales->customer->party_name ?? '');
        $head->created_by             = Auth::user()->id;
        $head->last_updated_by        = Auth::user()->id;
        $head->status                 = 0;
        $head->je_batch_id            = $jeBatchId;
        $head->running_total_dr       = $totalDr;
        $head->running_total_cr       = $totalCr;
        $head->save();

        foreach ($lines as $key => $line) {
            GlLines::create([
                'je_header_id'        => $newId,
                'je_line_num'         => $key + 1,
                'last_updated_by'     => Auth::user()->id,
                'ledger_id'           => $jeBatchId,
                'code_combination_id' => $line['accDes'],
                'period_name'         => Carbon::parse($invDate)->format('M y'),
                'effective_date'      => Carbon::parse($invDate)->format('Y-m-d'),
                'status'              => 0,
                'created_by'          => Auth::user()->id,
                'entered_dr'          => (int) $line['dr'],
                'entered_cr'          => (int) $line['cr'],
                'description'         => $line['desc'],
                'reference_1'         => $sales->customer->party_name ?? '',
                'tax_code'            => (int) $taxRate,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        $dueDate = $termMaster
            ? Carbon::now()->addDays($termMaster->term_code)->format('Y-m-d H:i:s')
            : Carbon::now()->format('Y-m-d H:i:s');

        SalesOrder::where('order_number', $sales->order_number)->update([
            'inv_number'       => $invNumber,
            'updated_by'       => Auth::user()->id,
            'faktur'           => $request->faktur_code,
            'updated_at'       => $invDate,
            'payment_due_date' => $dueDate,
        ]);

        Faktur::where('faktur_code', $request->faktur_code)->update(['deleted_at' => now()]);
    }

    public function suratJalan($id)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales    = SalesOrder::find($id);
        $detail   = SalesOrderDetail::where('header_id', $sales->header_id)->get();
        $delivery = DeliveryHeader::where('order_number', $sales->order_number)->first();

        return view('admin.sales.surat-jalan', compact('sales', 'detail', 'delivery'));
    }

    public function delete(Request $request,$id){
        dd('masuk rana delete');
    }
    public function destroy($id)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order = SalesOrder::where('header_id', $id)->first();
        if (!$order) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
        if ($order->booked_flag != null) {
            return response()->json(['error' => 'Hanya SO berstatus Draft yang dapat dihapus.'], 422);
        }
        $order->delete();
        return response()->json(['success' => 'Sales Order berhasil dihapus.']);
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function data()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $order = SalesOrderDetail::leftJoin('bm_order_headers_all as sh','bm_order_lines_all.header_id','=','sh.header_id')
        //                             ->leftJoin('bm_wsh_delivery_details as dd','sh.header_id','=', 'dd.source_header_id')
        //                             ->leftJoin('bm_wsh_new_deliveries as dh','dh.delivery_id','=','dd.delivery_detail_id')
        //                             ->select('bm_order_lines_all.*','dd.shipped_quantity','dd.delivered_quantity','dh.packing_slip_number','dh.dock_code')
        //                             ->where('sh.deleted_at',Null)
        //                             ->where('dd.deleted_at',Null)
        //                             ->where('dh.deleted_at',Null)
        //                             ->get();

        $customer = Customer::All();
        return view('admin.sales.report',compact('customer'));
    }
    public function data_invoice()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customer = Customer::All();
        return view('admin.sales.invoice',compact('customer'));
    }
     public function data_shipment(Request $request )
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $deliveryorder = DeliveryHeader::where('order_number',"=",$request->order_number)->get();
        // dd($deliveryorder);
        
        return view('admin.sales.shipment',compact('deliveryorder'));
    }
}
