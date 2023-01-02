@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Buat Data Syarat
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.syarats.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('mahasiswa') ? 'has-error' : '' }}">
                            <label class="required" for="mahasiswa_id">Mahasiswa</label>
                            <select class="form-control select2" name="mahasiswa_id" id="mahasiswa_id" required>
                                @foreach($mahasiswas as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id') == $mahasiswa->id ? 'selected' : '' }}>{{ $mahasiswa->user->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mahasiswa'))
                                <span class="help-block" role="alert">{{ $errors->first('mahasiswa') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('skripsi') ? 'has-error' : '' }}">
                            <label class="required" for="skripsi">File Skripsi</label>
                            <input class="form-control-file" type="file" name="skripsi" id="skripsi" value="{{ old('skripsi', '') }}" required>
                            @if($errors->has('skripsi'))
                                <span class="help-block" role="alert">{{ $errors->first('skripsi') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                            <label class="required" for="photo">Pas Photo</label>
                            <input class="form-control-file" type="file" name="photo" id="photo" value="{{ old('photo', '') }}" required>
                            @if($errors->has('photo'))
                                <span class="help-block" role="alert">{{ $errors->first('photo') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('serticalonsarjana') ? 'has-error' : '' }}">
                            <label class="required" for="serticalonsarjana">Sertifikat Pesantren Calon Sarjana</label>
                            <input class="form-control-file" type="file" name="serticalonsarjana" id="serticalonsarjana" value="{{ old('serticalonsarjana', '') }}" required>
                            @if($errors->has('serticalonsarjana'))
                                <span class="help-block" role="alert">{{ $errors->first('serticalonsarjana') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('sertibebasperpus') ? 'has-error' : '' }}">
                            <label class="required" for="sertibebasperpus">Sertifikat Bebas Perpus</label>
                            <input class="form-control-file" type="file" name="sertibebasperpus" id="sertibebasperpus" value="{{ old('sertibebasperpus', '') }}" required>
                            @if($errors->has('sertibebasperpus'))
                                <span class="help-block" role="alert">{{ $errors->first('sertibebasperpus') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('sertimaba') ? 'has-error' : '' }}">
                            <label class="required" for="sertimaba">Sertifikat Pesantren Maba</label>
                            <input class="form-control-file" type="file" name="sertimaba" id="sertimaba" value="{{ old('sertimaba', '') }}" required>
                            @if($errors->has('sertimaba'))
                                <span class="help-block" role="alert">{{ $errors->first('sertimaba') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('bebaslab') ? 'has-error' : '' }}">
                            <label class="" for="bebaslab">Sertifikat Bebas Lab</label>
                            <input class="form-control-file" type="file" name="bebaslab" id="bebaslab" value="{{ old('bebaslab', '') }}" required>
                            @if($errors->has('bebaslab'))
                                <span class="help-block" role="alert">{{ $errors->first('bebaslab') }}</span>
                            @endif
                            <span class="help-block">Hanya Prodi Farmasi</span>
                        </div>
                        <div class="form-group {{ $errors->has('transkrip') ? 'has-error' : '' }}">
                            <label class="required" for="transkrip">File Transkrip</label>
                            <input class="form-control-file" type="file" name="transkrip" id="transkrip" value="{{ old('transkrip', '') }}" required>
                            @if($errors->has('transkrip'))
                                <span class="help-block" role="alert">{{ $errors->first('transkrip') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('pembayaran') ? 'has-error' : '' }}">
                            <label class="required" for="pembayaran">Bukti Pembayaran</label>
                            <input class="form-control-file" type="file" name="pembayaran" id="pembayaran" value="{{ old('pembayaran', '') }}" required>
                            @if($errors->has('pembayaran'))
                                <span class="help-block" role="alert">{{ $errors->first('pembayaran') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection