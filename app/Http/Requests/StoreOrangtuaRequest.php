<?php

namespace App\Http\Requests;

use App\Models\Orangtua;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreOrangtuaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('orangtua_create');
    }

    public function rules()
    {
        return [
            'mahasiswa_id' => [
                'required',
                'integer',
            ],
            'nama_ibu' => [
                'string',
                'required',
            ],
            'pekerjaan_ibu' => [
                'required',
            ],
            'nama_ayah' => [
                'string',
                'required',
            ],
            'pekerjaan_ayah' => [
                'required',
            ],
            'alamat' => [
                'required',
            ],
            'no_hp' => [
                'string',
                'required',
            ],
        ];
    }
}