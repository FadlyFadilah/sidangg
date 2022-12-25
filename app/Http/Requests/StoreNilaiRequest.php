<?php

namespace App\Http\Requests;

use App\Models\Nilai;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreNilaiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('nilai_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'mahasiswa_id' => [
                'required',
                'integer',
            ],
            'nilai' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}