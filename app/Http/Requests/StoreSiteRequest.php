<?php

namespace App\Http\Requests;

use App\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSiteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'site_code'       => [
                'required',
            ],
            // 'client_id'  => [
            //     'required',
            //     'integer',
            // ],
            // 'start_date' => [
            //     'date_format:' . config('panel.date_format'),
            //     'nullable',
            // ],
        ];
    }
}
