<?php

namespace App\Http\Requests;

use App\PurchaseRequisition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAppRequest extends FormRequest
{
    public function authorize()
    {


        return true;
    }

    public function rules()
    {
        return [
            'app_lvl' => [
                'required',
            ],
        ];
    }
}
