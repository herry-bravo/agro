<?php

namespace App\Http\Requests;

use App\ReceiveController;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class StoreRcvRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'receipt_num' => [
                'required', Rule::unique('bm_c_rcv_shipment_header_id', 'receipt_num')->ignore($this->post)
            ],
            'line_number' => [
                'required',
            ],'conversion_date' => [
                'required',
            ],'conversion_rate' => [
                'required',
            ],

        ];
    }

}
