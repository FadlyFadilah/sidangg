@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ubah Identitas Mahasiswa
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.mahasiswas.update', [$mahasiswa->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            {{-- <input type="hidden" name="user_id" value="{{ $mahasiswa->user_id }}"> --}}
                            <div class="form-group {{ $errors->has('prodi') ? 'has-error' : '' }}">
                                <label>Prodi</label>
                                <select class="form-control" name="prodi" id="prodi">
                                    <option value disabled {{ old('prodi', null) === null ? 'selected' : '' }}>Pilih Salah
                                        Satu!</option>
                                    @foreach (App\Models\Mahasiswa::PRODI_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('prodi', $mahasiswa->prodi) === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('prodi'))
                                    <span class="help-block" role="alert">{{ $errors->first('prodi') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                                <label class="required" for="tempat_lahir">Tempat Lahir</label>
                                <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir"
                                    value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}" required>
                                @if ($errors->has('tempat_lahir'))
                                    <span class="help-block" role="alert">{{ $errors->first('tempat_lahir') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('ttl') ? 'has-error' : '' }}">
                                <label class="required" for="ttl">Tanggal Lahir</label>
                                <input class="form-control date" type="text" name="ttl" id="ttl"
                                    value="{{ old('ttl', $mahasiswa->ttl) }}" required>
                                @if ($errors->has('ttl'))
                                    <span class="help-block" role="alert">{{ $errors->first('ttl') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                <label class="required" for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                                @if ($errors->has('alamat'))
                                    <span class="help-block" role="alert">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                                <label class="required" for="no_hp">No Handphone</label>
                                <input class="form-control" type="text" name="no_hp" id="no_hp"
                                    value="{{ old('no_hp', $mahasiswa->no_hp) }}" required>
                                @if ($errors->has('no_hp'))
                                    <span class="help-block" role="alert">{{ $errors->first('no_hp') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('asal_sekolah') ? 'has-error' : '' }}">
                                <label class="required" for="asal_sekolah">Asal Sekolah (SMK / SMA)</label>
                                <input class="form-control" type="text" name="asal_sekolah" id="asal_sekolah"
                                    value="{{ old('asal_sekolah', $mahasiswa->asal_sekolah) }}" required>
                                @if ($errors->has('asal_sekolah'))
                                    <span class="help-block" role="alert">{{ $errors->first('asal_sekolah') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('medsos') ? 'has-error' : '' }}">
                                <label class="required" for="medsos">Media Sosial</label>
                                <input class="form-control" type="text" name="medsos" id="medsos"
                                    value="{{ old('medsos', $mahasiswa->medsos) }}" required>
                                @if ($errors->has('medsos'))
                                    <span class="help-block" role="alert">{{ $errors->first('medsos') }}</span>
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
