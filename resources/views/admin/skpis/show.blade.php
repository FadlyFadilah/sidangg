@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lihat Skpi
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.skpis.index') }}">
                                Kembali ke Daftar
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <td>
                                        {{ $skpi->id }}
                                    </td>
                                </tr>
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
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.skpis.index') }}">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection