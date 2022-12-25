<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Dosen;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\Syarat;
use App\Models\User;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function index()
    {
        $mahasiswa = User::with(['mahasiswas', 'mahsiswapenguji'])->where('id', auth()->user()->id)->first();
        
        $nilais = Nilai::with('mahasiswa')->where('user_id', auth()->user()->id)->get();
        return view('user.dosens.index', compact('mahasiswa', 'nilais'));
    }
}
