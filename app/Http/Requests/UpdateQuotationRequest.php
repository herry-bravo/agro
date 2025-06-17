<?php

namespace App\Http\Requests;

use App\Quotation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class UpdateQuotationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'segment1' => [
                'required',
            ],
            'inventory_item_id' => [
                'required',
                // Rule::unique('bm_po_lines_all')
                //     ->where(function($query){
                //         $query->where('inventory_item_id', $this->inventory_item_id);
                //     })->ignore($this->post)
                // // ->where(function($query){
                // //         $query->where('inventory_item_id', $this->inventory_item_id)
                // //             ->where('end_date', '<=',$this->end_date);
                // //     })->ignore($this->post)
            ]
        ];

    }

    public function messages() {
        return [
           'inventory_item_id.unique' => 'Active Product Must Not Overlap',
        ];
    }

}
