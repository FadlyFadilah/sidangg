<?php

namespace App\Http\Requests;

use App\Models\Skpi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySkpiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('skpi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:skpis,id',
        ];
    }
}