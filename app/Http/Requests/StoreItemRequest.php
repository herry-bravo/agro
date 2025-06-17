<?php

namespace App\Http\Requests;

use App\itemMaster;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'item_code' => [
                'required',
            ],
            'category_code' => [
                'required',
            ],
        ];
    }

}
