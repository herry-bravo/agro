<?php
namespace App\Http\Requests;

use App\AccPayHeader;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAccPayHeaderRequest extends FormRequest
{
    public $validator = null;
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            'invoice_num' => 'required|unique:bm_ap_invoices_all',
        ];
    }

    public function messages() {
        return [
            'invoice_num.unique' => 'Duplicate Invoice Number',
        ];
    }
}
