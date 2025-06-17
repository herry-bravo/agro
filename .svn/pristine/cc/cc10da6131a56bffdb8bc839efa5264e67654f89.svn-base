<?php

namespace App\Http\Requests;

use App\Quotation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class StoreBOMRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'parent_inventory_it'=>[
                'required',
                Rule::unique('bm_bom_bill_of_mtl_interface')->where(function($query) {
                    return $query->where('parent_inventory_it',$this->parent_inventory_it)
                                -> Where('child_inventory_id',$this->child_inventory_id);
                })->ignore($this->post),
            ]
        ];
    }

    public function messages() {
        return [
           'parent_inventory_it.unique'=>'Parent & Child Item Already Exist',
        ];
    }

}
