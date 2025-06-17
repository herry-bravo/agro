<?php

namespace App\Http\Requests;

use App\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSalesOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sales_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ordered_quantity' => ['required'],
            'unit_selling_price' =>['required'],
            // 'customer_name' => [
            //     'required',
            // ],
            // 'sales_team' => [
            //     'required',
            // ],
            // 'terms_start' => [
            //     'required',
            // ],
            // 'terms_end' => [
            //     'required',
            // ],
            // 'bill_to' => [
            //     'required',
            // ],
            // 'ship_to' => [
            //     'required',
            // ],
            'schedule_ship_date' => [
                'required',
            ],
        ];
    }


}
