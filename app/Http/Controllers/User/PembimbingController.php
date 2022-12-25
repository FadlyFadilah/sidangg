<?php

namespace App\Http\Controllers\User;

use App\Models\Dosen;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Orangtua;
use App\Models\Syarat;
use App\Models\User;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function index()
    {
        $list = new Dosen();
        $dosens = $list->dosenUser();
        $mahasiswa = Mahasiswa::with(['userpembimbing'])->where('user_id', auth()->user()->id)->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Lengkapi Data Diri Terlebih Dahulu!');
        }
        $orangtua = Orangtua::where('mahasiswa_id', $mahasiswa->id)->first();
        if (!$orangtua) {
            return redirect()->back()->with('error', 'Lengkapi Data Orangtua Terlebih Dahulu!');
        }
        $syarat = Syarat::where('mahasiswa_id', $mahasiswa->id)->first();
        if (!$syarat) {
            return redirect()->back()->with('error', 'Lengkapi Data Persyaratan Skripsi Terlebih Dahulu!');
        }
        return view('user.pembimbings.index', compact('dosens', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $mahasiswa->userpembimbing()->sync(request('dosens'));

        return redirect()->back()->with('success', 'Berhasil!');
    }
}
