<?php

namespace App\Http\Requests;

use App\Models\Skpi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreSkpiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('skpi_create');
    }

    public function rules()
    {
        return [
            'nama_id' => [
                'required',
                'integer',
            ],
            'kualifikasi' => [
                'string',
                'required',
            ],
            'kegiatan' => [
                'string',
                'required',
            ]
        ];
    }
}