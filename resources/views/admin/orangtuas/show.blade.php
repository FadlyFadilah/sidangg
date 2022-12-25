@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detail Data Orang Tua
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.orangtuas.index') }}">
                                Kembali Ke Daftar
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        Mahasiswa
                                    </th>
                                    <td>
                                        {{ $orangtua->mahasiswa->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama Ibu
                                    </th>
                                    <td>
                                        {{ $orangtua->nama_ibu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Pekerjaan Ibu
                                    </th>
                                    <td>
                                        {{ App\Models\Orangtua::PEKERJAAN_IBU_SELECT[$orangtua->pekerjaan_ibu] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama Ayah
                                    </th>
                                    <td>
                                        {{ $orangtua->nama_ayah }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Pekerjaan Ayah
                                    </th>
                                    <td>
                                        {{ App\Models\Orangtua::PEKERJAAN_AYAH_SELECT[$orangtua->pekerjaan_ayah] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Alamat
                                    </th>
                                    <td>
                                        {{ $orangtua->alamat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        No Handphone
                                    </th>
                                    <td>
                                        {{ $orangtua->no_hp }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.orangtuas.index') }}">
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