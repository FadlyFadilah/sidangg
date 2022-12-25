<?php

namespace App\Http\Requests;

use App\Models\Mahasiswa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreMahasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mahasiswa_create');
    }

    public function rules()
    {
        return [
            'tempat_lahir' => [
                'string',
                'required',
            ],
            'ttl' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'alamat' => [
                'required',
            ],
            'no_hp' => [
                'string',
                'required',
            ],
            'asal_sekolah' => [
                'string',
                'required',
            ],
            'medsos' => [
                'string',
                'required',
            ],
        ];
    }
}