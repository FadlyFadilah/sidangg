<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMahasiswaRequest;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mahasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        return view('user.mahasiswas.index', compact('mahasiswa'));
        
    }

    public function create()
    {
        abort_if(Gate::denies('mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $list = new Mahasiswa();
        $mahasiswas = $list->mahasiswaUser();

        return view('user.mahasiswas.create', compact('mahasiswas'));
    }

    public function store(StoreMahasiswaRequest $request)
    {
        $mahasiswa = Mahasiswa::updateOrCreate([
            'user_id'   => auth()->user()->id,
        ], [
            'prodi'     => $request->get('prodi'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'ttl'    => $request->get("ttl"),
            'alamat'   => $request->get('alamat'),
            'no_hp'       => $request->get('no_hp'),
            'asal_sekolah'   => $request->get('asal_sekolah'),
            'medsos'    => $request->get('medsos')
        ]);

        return redirect()->back()->with('success', 'Berhasil!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('user.mahasiswas.edit', compact('mahasiswa'));
    }

    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->all());

        return redirect()->route('user.mahasiswas.index');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $maha = User::find($mahasiswa->user_id);
        $mahasiswa->load('mahasiswaOrangtuas');

        return view('user.mahasiswas.show', compact('mahasiswa', 'maha'));
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        abort_if(Gate::denies('mahasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyMahasiswaRequest $request)
    {
        Mahasiswa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
