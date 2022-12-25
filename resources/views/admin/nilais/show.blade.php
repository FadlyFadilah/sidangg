@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Detail Nilai
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.nilais.index') }}">
                                    Kembali Ke Daftar
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    @foreach ($namas as $nama)
                                        <td colspan="2">{{ $nama->mahasiswa->user->name }}</td>
                                        <td colspan="2">{{ $nama->mahasiswa->user->nik }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($nilais as $nilai)
                                        <td>{{ $nilai->user->name }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($nilais as $as)
                                        <td>{{ $as->nilai }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="4">Rata - Rata: {{ $nilaiavg }}</td>
                                </tr>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.nilais.index') }}">
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
