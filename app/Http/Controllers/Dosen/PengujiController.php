<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Dosen;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class PengujiController extends Controller
{
    public function index()
    {
        // $list = new Dosen();
        // $dosens = $list->dosenUser();
        // $mahasiswa = Mahasiswa::with(['userpenguji', 'syarats'])->where('user_id', auth()->user()->id)->first();
        // dd($mahasiswa);
        // return view('user.dosens.index', compact('dosens', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->get();
        $mahasiswa->userpenguji()->sync(request('dosens'));

        return redirect()->back()->with('success', 'Berhasil!');;
    }
}
