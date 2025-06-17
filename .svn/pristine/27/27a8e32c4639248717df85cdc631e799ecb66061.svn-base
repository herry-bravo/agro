<?php

namespace App\Http\Requests;

use App\PurchaseRequisitionDet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequisitionDetRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('delete_order'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
             'ids'   => 'required|array',
            'ids.*' => 'exists:purchaseRequisitionDet,id',
        ];
    }
}
