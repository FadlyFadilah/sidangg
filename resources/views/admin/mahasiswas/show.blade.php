@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detail Identitas Mahasiswa
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.mahasiswas.index') }}">
                                Kempali Ke Daftar
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        Nama
                                    <td>
                                        {{ $maha->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        NPM
                                    </th>
                                    <td>
                                        {{ $maha->nik }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Prodi
                                    </th>
                                    <td>
                                        {{ App\Models\Mahasiswa::PRODI_SELECT[$mahasiswa->prodi] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Tempat Lahir
                                    </th>
                                    <td>
                                        {{ $mahasiswa->tempat_lahir }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Tanggal lahir
                                    </th>
                                    <td>
                                        {{ $mahasiswa->ttl }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Alamat
                                    </th>
                                    <td>
                                        {{ $mahasiswa->alamat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nomor Handphone
                                    <td>
                                        {{ $mahasiswa->no_hp }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Asal Sekolah(SMA/SMK)
                                    </th>
                                    <td>
                                        {{ $mahasiswa->asal_sekolah }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Media Sosial
                                    </th>
                                    <td>
                                        {{ $mahasiswa->medsos }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.mahasiswas.index') }}">
                                Kempali Ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Related Data
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#mahasiswa_orangtuas" aria-controls="mahasiswa_orangtuas" role="tab" data-toggle="tab">
                            Orang Tua
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="mahasiswa_orangtuas">
                        @includeIf('admin.mahasiswas.relationships.mahasiswaOrangtuas', ['orangtuas' => $mahasiswa->mahasiswaOrangtuas])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection