<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrangtuaRequest;
use App\Http\Requests\StoreOrangtuaRequest;
use App\Http\Requests\UpdateOrangtuaRequest;
use App\Models\Mahasiswa;
use App\Models\Orangtua;
use App\Models\Syarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SyaratController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('syarat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = $request['status'];
        if ($status == 'Terverifikasi Admin Fakultas') {
            $syarats = Syarat::orderBy('updated_at', 'desc')->with('mahasiswa')->where('status', $status)->get();
            return view('admin.syarats.index', compact('syarats'));
        } elseif ($status == 'Terverifikasi Dengan Perbaikan') {
            $syarats = Syarat::orderBy('updated_at', 'desc')->with('mahasiswa')->where('status', $status)->get();
            return view('admin.syarats.index', compact('syarats'));
        } elseif ($status == 'Disetujui Kasie Akademik') {
            $syarats = Syarat::orderBy('updated_at', 'desc')->with('mahasiswa')->where('status', $status)->get();
            return view('admin.syarats.index', compact('syarats'));
        }elseif ($status == 'Disetujui Wakil Dekan 1') {
            $syarats = Syarat::orderBy('updated_at', 'desc')->with('mahasiswa')->where('status', $status)->get();
            return view('admin.syarats.index', compact('syarats'));
        }elseif ($status == 'Belum Terverifikasi') {
            $syarats = Syarat::orderBy('updated_at', 'desc')->with('mahasiswa')->where('status', $status)->get();
            return view('admin.syarats.index', compact('syarats'));
        }
        $syarats = Syarat::orderBy('updated_at', 'desc')->with(['mahasiswa'])->get();
        return view('admin.syarats.index', compact('syarats'));
    }

    public function create()
    {
        abort_if(Gate::denies('syarat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get();
        return view('admin.syarats.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $syarat = $request->all();
        $number = rand(0, 1000);
        $skripsi = request()->file('skripsi');
        $skripsiUrl = $skripsi->storeAs('file/syarat/skripsi', "{$number}skripsi.{$skripsi->extension()}");
        $photo = request()->file('photo');
        $photoUrl = $photo->storeAs('file/syarat/photo', "{$number}photo.{$photo->extension()}");
        $serticalonsarjana = request()->file('serticalonsarjana');
        $serticalonsarjanaUrl = $serticalonsarjana->storeAs('file/syarat/serticalonsarjana', "{$number}serticalonsarjana.{$serticalonsarjana->extension()}");
        $sertibebasperpus = request()->file('sertibebasperpus');
        $sertibebasperpusUrl = $sertibebasperpus->storeAs('file/syarat/sertibebasperpus', "{$number}sertibebasperpus.{$sertibebasperpus->extension()}");
        $sertimaba = request()->file('sertimaba');
        $sertimabaUrl = $sertimaba->storeAs('file/syarat/sertimaba', "{$number}sertimaba.{$sertimaba->extension()}");
        $bebaslab = request()->file('bebaslab');
        $bebaslabUrl = $bebaslab->storeAs('file/syarat/bebaslab', "{$number}bebaslab.{$bebaslab->extension()}");
        $transkrip = request()->file('transkrip');
        $transkripUrl = $transkrip->storeAs('file/syarat/transkrip', "{$number}transkrip.{$transkrip->extension()}");
        $pembayaran = request()->file('pembayaran');
        $pembayaranUrl = $pembayaran->storeAs('file/syarat/pembayaran', "{$number}pembayaran.{$pembayaran->extension()}");

        $syarat['skripsi'] = $skripsiUrl;
        $syarat['photo'] = $photoUrl;
        $syarat['serticalonsarjana'] = $serticalonsarjanaUrl;
        $syarat['sertibebasperpus'] = $sertibebasperpusUrl;
        $syarat['sertimaba'] = $sertimabaUrl;
        $syarat['bebaslab'] = $bebaslabUrl;
        $syarat['transkrip'] = $transkripUrl;
        $syarat['pembayaran'] = $pembayaranUrl;

        Syarat::create($syarat);

        return redirect()->route('admin.syarats.index');
    }

    public function edit(Syarat $syarat)
    {
        abort_if(Gate::denies('syarat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get();

        $syarat->load('mahasiswa');

        return view('admin.syarats.edit', compact('mahasiswas', 'syarat'));
    }

    public function update(Request $request, Syarat $syarat)
    {
        $syarat->update($request->all());

        return redirect()->back();
    }

    public function show(Syarat $syarat)
    {
        abort_if(Gate::denies('syarat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $syarat->load('mahasiswa');

        return view('admin.syarats.show', compact('syarat'));
    }

    public function destroy(Orangtua $orangtua)
    {
        abort_if(Gate::denies('syarat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orangtua->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrangtuaRequest $request)
    {
        Orangtua::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
