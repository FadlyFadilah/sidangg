@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ubah Data Orang Tua
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.orangtuas.update", [$orangtua->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('mahasiswa') ? 'has-error' : '' }}">
                            <label class="required" for="mahasiswa_id">Mahasiswa</label>
                            <select class="form-control select2" name="mahasiswa_id" id="mahasiswa_id" required>
                                @foreach($mahasiswas as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}" {{ (old('mahasiswa_id') ? old('mahasiswa_id') : $orangtua->mahasiswa_id ?? '') == $mahasiswa->id ? 'selected' : '' }}>{{ $mahasiswa->user->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mahasiswa'))
                                <span class="help-block" role="alert">{{ $errors->first('mahasiswa') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nama_ibu') ? 'has-error' : '' }}">
                            <label class="required" for="nama_ibu">Nama Ibu</label>
                            <input class="form-control" type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', $orangtua->nama_ibu) }}" required>
                            @if($errors->has('nama_ibu'))
                                <span class="help-block" role="alert">{{ $errors->first('nama_ibu') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('pekerjaan_ibu') ? 'has-error' : '' }}">
                            <label class="required">Pekerjaan Ibu</label>
                            <select class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" required>
                                <option value disabled {{ old('pekerjaan_ibu', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Orangtua::PEKERJAAN_IBU_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('pekerjaan_ibu', $orangtua->pekerjaan_ibu) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pekerjaan_ibu'))
                                <span class="help-block" role="alert">{{ $errors->first('pekerjaan_ibu') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nama_ayah') ? 'has-error' : '' }}">
                            <label class="required" for="nama_ayah">Nama Ayah</label>
                            <input class="form-control" type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah', $orangtua->nama_ayah) }}" required>
                            @if($errors->has('nama_ayah'))
                                <span class="help-block" role="alert">{{ $errors->first('nama_ayah') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('pekerjaan_ayah') ? 'has-error' : '' }}">
                            <label class="required">Pekerjaan Ayah</label>
                            <select class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" required>
                                <option value disabled {{ old('pekerjaan_ayah', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Orangtua::PEKERJAAN_AYAH_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('pekerjaan_ayah', $orangtua->pekerjaan_ayah) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pekerjaan_ayah'))
                                <span class="help-block" role="alert">{{ $errors->first('pekerjaan_ayah') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                            <label class="required" for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" required>{{ old('alamat', $orangtua->alamat) }}</textarea>
                            @if($errors->has('alamat'))
                                <span class="help-block" role="alert">{{ $errors->first('alamat') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                            <label class="required" for="no_hp">No Handphone</label>
                            <input class="form-control" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $orangtua->no_hp) }}" required>
                            @if($errors->has('no_hp'))
                                <span class="help-block" role="alert">{{ $errors->first('no_hp') }}</span>
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