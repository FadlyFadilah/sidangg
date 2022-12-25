@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Lihat Skpi
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('user.skpis.index') }}">
                                Kembali Ke Daftar
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        NPM
                                    </th>
                                    <td>
                                        {{ $skpi->nama->nik ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama Kegiatan (Bahasa Indonesia)
                                    </th>
                                    <td>
                                        {{ $skpi->kualifikasi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama Kegiatan (Bahasa Inggris)
                                    </th>
                                    <td>
                                        {{ $skpi->kegiatan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Keterangan
                                    </th>
                                    <td>
                                        {{ App\Models\Skpi::KETERANGAN_SELECT[$skpi->keterangan] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        File
                                    </th>
                                    <td>
                                        @foreach($skpi->file as $key => $media)
                                            <a href="https://{{ $media->getUrl() }}" target="_blank">
                                                View
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('user.skpis.index') }}">
                                Kembali Ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection