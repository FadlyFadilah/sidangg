<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNilaiRequest;
use App\Http\Requests\StoreNilaiRequest;
use App\Http\Requests\UpdateNilaiRequest;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class NilaiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('nilai_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nilais = Mahasiswa::whereHas('mahasiswaNilais')->get();
        // dd($nilais);
        return view('admin.nilais.index', compact('nilais'));
    }

    public function create()
    {
        abort_if(Gate::denies('nilai_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mahasiswas = Mahasiswa::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.nilais.create', compact('mahasiswas', 'users'));
    }

    public function store(Request $request)
    {
        // $angka = (float)$request->get('nilai');
        // dd($angka);
        $nilai = Nilai::updateOrCreate([
            'mahasiswa_id' => $request->get('mahasiswa_id'),
            'user_id' => auth()->user()->id,
        ], [
            'nilai' => $request->get('nilai')
        ]);

        return redirect()->back()->with('success', 'Berhasil!');
    }

    public function edit(Nilai $nilai)
    {
        abort_if(Gate::denies('nilai_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mahasiswas = Mahasiswa::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nilai->load('user', 'mahasiswa');

        return view('admin.nilais.edit', compact('mahasiswas', 'nilai', 'users'));
    }

    public function update(UpdateNilaiRequest $request, Nilai $nilai)
    {
        $nilai->update($request->all());

        return redirect()->route('admin.nilais.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('nilai_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nilais = Nilai::with(['user', 'mahasiswa'])->where('mahasiswa_id', $id)->get();
        $nilaiavg = Nilai::where('mahasiswa_id', $id)->pluck('nilai')->avg();
        $nilai = Nilai::with(['mahasiswa'])->where('mahasiswa_id', $id)->get();
        $namas = $nilai->unique('mahasiswa_id')->values()->all();
        return view('admin.nilais.show', compact('nilais', 'nilaiavg', 'namas'));
    }

    public function destroy(Nilai $nilai)
    {
        abort_if(Gate::denies('nilai_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nilai->delete();

        return back();
    }
}