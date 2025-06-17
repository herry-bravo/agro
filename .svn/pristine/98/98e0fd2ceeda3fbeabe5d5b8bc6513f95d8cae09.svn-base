<?php

namespace App\Http\Requests;

use App\Quotation;
use Gate;
use Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class StoreQuotationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'segment1' => 'required|unique:bm_po_header_all', 
			'start_date' => 'required',
        ];
    }

    public function messages() {
        return [
            'segment1.unique' => 'No Must be Unique',
        ];
    }

}
