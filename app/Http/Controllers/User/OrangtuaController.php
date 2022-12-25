<?php

namespace App\Http\Controllers\User;

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
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        
        if ($mahasiswa) {
            $orangtua = Orangtua::where('mahasiswa_id', $mahasiswa->id)->first();
            return view('user.orangtuas.index', compact('orangtua'));
        } else {
            return redirect()->back()->with('error', 'Lengkapi Data Diri Terlebih Dahulu!');
        }
    }

    public function create()
    {
        abort_if(Gate::denies('orangtua_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get();
        return view('user.orangtuas.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $orangtua = Orangtua::updateOrCreate([
            'mahasiswa_id'   => $mahasiswa->id,
        ], [
            'nama_ibu'     => $request->get('nama_ibu'),
            'pekerjaan_ibu' => $request->get('pekerjaan_ibu'),
            'nama_ayah'    => $request->get("nama_ayah"),
            'pekerjaan_ayah'   => $request->get('pekerjaan_ayah'),
            'alamat'       => $request->get('alamat'),
            'no_hp'   => $request->get('no_hp'),
        ]);

        return redirect()->back()->with('success', 'Berhasil!');
    }

    public function edit(Orangtua $orangtua)
    {
        abort_if(Gate::denies('orangtua_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get(); 

        $orangtua->load('mahasiswa');

        return view('user.orangtuas.edit', compact('mahasiswas', 'orangtua'));
    }

    public function update(UpdateOrangtuaRequest $request, Orangtua $orangtua)
    {
        $orangtua->update($request->all());

        return redirect()->route('user.orangtuas.index');
    }

    public function show(Orangtua $orangtua)
    {
        abort_if(Gate::denies('orangtua_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orangtua->load('mahasiswa');

        return view('user.orangtuas.show', compact('orangtua'));
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