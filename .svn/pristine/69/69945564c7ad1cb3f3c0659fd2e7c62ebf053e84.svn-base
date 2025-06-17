<?php

namespace App\Http\Controllers\Admin;

use App\CurrencyGlobal;
use App\Customer;
use App\Site;

use App\transaction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customer = Customer::all();
        return view('admin.customer.index', compact('customer'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $tax = \App\Tax::where('type_tax_use','Sales')->get();

        return view('admin.customer.create', compact('currency','tax'));
    }

    public function store(StoreCustomerRequest $request)
    {
        try{
            // dd($request->all());
            $customer = Customer::create($request->all());
            if(isset($request->site_code)){
                $data =array(
                    'cust_party_code' => $request->cust_party_code,
                    'site_code' => $request->site_code,
                    'site_type' => $request->site_type,
                    'address1' => $request->address1_site,
                    'address2' => $request->address2_site,
                    'address3' => $request->attribute5_site,
                    'city' => $request->city_site,
                    'province' => $request->province_site,
                    'country' => $request->country_site,
                    'phone' => $request->phone_site,
                    'email' => $request->email_site,
                    // 'tax_code' => $request->site_code,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                Site::create($data);
            }
            if($customer){
                return redirect()->route('admin.customer.index')->with('success', 'Customer data has been stored');
            }
        }catch (Exception $e){
            dd($e);
            return back()->with('error', 'Some Customer Detail Cant Be Empty' );
        }

    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer = Customer::find($customer->id);
        $currency = CurrencyGlobal::all();
        $tax = \App\Tax::where('type_tax_use','Sales')->get();
        $site = Site::where('cust_party_code',$customer->cust_party_code)->first();
        // dd($site);

        return view('admin.customer.edit', compact('customer', 'currency','site','tax'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        if($customer){
            $customer->update($request->all());
            $site = Site::find($request->site_id);
            if($site){
                $site->cust_party_code = $request->cust_party_code;
                $site->site_code = $request->site_code;
                $site->site_type = $request->site_type;
                $site->address1 = $request->address1_site;
                $site->address2 = $request->address2_site;
                $site->address3 = $request->attribute5_site;
                $site->city = $request->city_site;
                $site->province = $request->province_site;
                $site->country = $request->country_site;
                $site->phone = $request->phone_site;
                $site->email = $request->email_site;
                // $site->tax_code = $request->site_code ;
                $site->updated_at = date('Y-m-d H:i:s');
                $site->save();
            }else{
                $data =array(
                    'cust_party_code' => $request->cust_party_code,
                    'site_code' => $request->site_code,
                    'site_type' => $request->site_type,
                    'address1' => $request->address1_site,
                    'address2' => $request->address2_site,
                    'address3' => $request->attribute5_site,
                    'city' => $request->city_site,
                    'province' => $request->province_site,
                    'country' => $request->country_site,
                    'phone' => $request->phone_site,
                    'email' => $request->email_site,
                    // 'tax_code' => $request->site_code,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                Site::create($data);
            }
            return redirect()->route('admin.customer.index')->with('success', 'Customer data has been stored');
        }else{
            return back()->with('error', 'Some Customer Detail Cant Be Empty or Double' );
        }
    }

    public function show($id)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $client->load('status');
        $client = Customer::where('id',$id)->get();

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
