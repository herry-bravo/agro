<?php

namespace App\Http\Requests;

use App\GlHeader;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreGlRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('gl_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'code_combinations' => [
                'required',
            ],
        ];
    }
    public function messages()
        {
            return [
            'name.required' => 'A name is required',
            'code_combinations.required'  => 'A message is required',
        ];
        }

}
