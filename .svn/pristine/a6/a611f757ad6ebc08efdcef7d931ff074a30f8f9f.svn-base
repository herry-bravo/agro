<?php
namespace App\Http\Controllers\Api;
use App\Helper\responapi\responapi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\PriceList;
use App\SalesOrder;
use App\DeliveryHeader;
use App\DeliveryDetail;
use App\QuotationDetail;
use App\PurchaseOrder;
use App\Vendor;
use App\ItemMaster;
use App\Uom;
use App\Quotation;
use App\PurchaseRequisition;
use App\RequisitionDetail;
use App\TrxStatuses;
use App\Comments;
use App\AutoCreate;
use App\CurrencyGlobal;
use App\PurchaseOrderDet;
use App\Terms;
use App\UomConversion;
use App\Tax;
use App\User;
use App\Product;
use App\PoAgent;
use App\RcvHeader;
use App\RcvDetail;
use App\Grn;
use App\Onhand;
use App\MaterialTxns;
use App\Site;
use App\Currency;
use App\Bom;
use App\WorkOrder;
use App\WorkOrderDetail;

class GalaxyApiController extends Controller
{
    // SALES ORDER
    public function customer(Request $request){

        $customer = Customer::orderBy('id','desc')->get();
        $respons =['status' => 'success', 'success' => true, 'message' => $customer];
        return $respons;

    }
    public function pricelist(Request $request){
        return PriceList::orderBy('id','desc')->get();
    }
    public function salesorder(Request $request){
        return SalesOrder::orderBy('id','desc')->get();
    }
    public function shipping(Request $request){
        return DeliveryHeader::orderBy('created_at','desc')->get();
    }

    // SALES ORDER

    // PURCHASE ORDER
    // QUOTATION
    public function quotationdetail(Request $request){
        return QuotationDetail::all();
    }
     public function purchaseorder(Request $request){

        $searchValue = isset($search_arr['value'])? $search_arr['value'] : "";
        // Total records

        // Get records, also we have included search filter as well
        $records = \App\PurchaseOrder::orderBy('created_at','desc')
            ->select('*')->get();
        $data_arr = array();

        foreach ($records as $raw) {
            $data_arr[] = array(
                "id" =>$raw->id,
				 "order_number" => $raw->segment1,
                "vendor_id" =>$raw->vendor_id,
                "vendor_name" =>$raw->vendor->vendor_name ??'',
                "currency" => $raw->currency_code,
                "rate_date" =>  $raw->rate_date,
                "agent_id" => $raw->user->name ?? '',
                "status" => $raw->trxStatuses->trx_name,
                "created_at" => $raw->created_at->format('Y-m-d'),
            );
        }

        return($data_arr);
    }

    public function itemmaster(Request $request){
        return ItemMaster::all();
    }
    public function uom(Request $request){
        return Uom::all();
    }
    public function quotation(Request $request){
        return Quotation::all();
    }
    // QUOTATION

    // PURCHASE REQ
    public function trxstatuses(Request $request){
        return TrxStatuses::all();
    }
    // PURCHASE REQ

    // AWTO CREATE
    public function autocreate(Request $request){
        return AutoCreate::all();
    }
    public function currencyglobal(Request $request){
        return CurrencyGlobal::all();
    }
    // AWTO CREATE

    // PURCHASE ORDER
    public function purchaseorderdet(Request $request){
        return PurchaseOrderDet::all();
    }
    public function terms(Request $request){
        return Terms::all();
    }
    public function uomconversion(Request $request){
        return UomConversion::all();
    }
    public function tax(Request $request){
        return Tax::all();
    }
    public function user(Request $request){
        return User::all();
    }
    public function product(Request $request){
        return Product::all();
    }
    public function poagent(Request $request){
        return PoAgent::all();
    }
    // PURCHASE ORDER

    // RCV
    public function rcvheader(Request $request){
        return RcvHeader::all();
    }
    public function rcvdetail(Request $request){
        return RcvDetail::all();
    }
    public function grn(Request $request){
        return Grn::all();
    }
    public function onhand(Request $request){
        return Onhand::all();
    }
    public function materialtxns(Request $request){
        return MaterialTxns::all();
    }
    // RCV

    // SUPPLIER
    public function site(Request $request){
        $site = Site::where()->get();
        return Site::all();
    }
    public function currency(Request $request){
        return Currency::all();
    }
    // SUPPLIER
    // PURCHASE ORDER

    // MANUFACTURING
    public function bom(Request $request){
        return Bom::all();
    }
    public function workorder(Request $request){
        return WorkOrder::all();
    }
    public function workorderdetail(Request $request){
        return WorkOrderDetail::all();
    }
    // MANUFACTURING
}
