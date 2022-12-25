<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrangtuaRequest;
use App\Http\Requests\StoreOrangtuaRequest;
use App\Http\Requests\UpdateOrangtuaRequest;
use App\Models\Mahasiswa;
use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class OrangtuaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('orangtua_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orangtuas = Orangtua::with(['mahasiswa'])->get();

        return view('admin.orangtuas.index', compact('orangtuas'));
    }

    public function create()
    {
        abort_if(Gate::denies('orangtua_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get();
        return view('admin.orangtuas.create', compact('mahasiswas'));
    }

    public function store(StoreOrangtuaRequest $request)
    {
        $orangtua = Orangtua::create($request->all());

        return redirect()->route('admin.orangtuas.index');
    }

    public function edit(Orangtua $orangtua)
    {
        abort_if(Gate::denies('orangtua_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get(); 

        $orangtua->load('mahasiswa');

        return view('admin.orangtuas.edit', compact('mahasiswas', 'orangtua'));
    }

    public function update(UpdateOrangtuaRequest $request, Orangtua $orangtua)
    {
        $orangtua->update($request->all());

        return redirect()->route('admin.orangtuas.index');
    }

    public function show(Orangtua $orangtua)
    {
        abort_if(Gate::denies('orangtua_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orangtua->load('mahasiswa');

        return view('admin.orangtuas.show', compact('orangtua'));
    }

    public function destroy(Orangtua $orangtua)
    {
        abort_if(Gate::denies('orangtua_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orangtua->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrangtuaRequest $request)
    {
        Orangtua::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}