<?php

namespace App\Http\Requests;
use App\Shipment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreShipmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('shipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'header_id' => [
                'required',
            ],
        ];
    }
    public function messages() {
        return [
            'header_id' =>'Row cant empty',
        ];
    }
}
