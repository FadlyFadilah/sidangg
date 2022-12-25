@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-uppercase">{{ auth()->user()->name }} | {{ auth()->user()->nik }}</h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Identitas Mahasiswa</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <form method="POST" action="{{ route('user.mahasiswas.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($mahasiswa === null)
                                <div class="form-group {{ $errors->has('prodi') ? 'has-error' : '' }}">
                                    <label>Prodi</label>
                                    <select class="form-control" name="prodi" id="prodi">
                                        <option value disabled {{ old('prodi', null) === null ? 'selected' : '' }}>Pilih
                                            Salah
                                            Satu!</option>
                                        @foreach (App\Models\Mahasiswa::PRODI_SELECT as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('prodi', '') === (string) $key ? 'selected' : '' }}>
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
                                        value="{{ old('tempat_lahir', '') }}" required>
                                    @if ($errors->has('tempat_lahir'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('tempat_lahir') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('ttl') ? 'has-error' : '' }}">
                                    <label class="required" for="ttl">Tanggal Lahir</label>
                                    <input class="form-control date" type="text" name="ttl" id="ttl"
                                        value="{{ old('ttl', '') }}" required>
                                    @if ($errors->has('ttl'))
                                        <span class="help-block" role="alert">{{ $errors->first('ttl') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                    <label class="required" for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" required>{{ old('alamat', '') }}</textarea>
                                    @if ($errors->has('alamat'))
                                        <span class="help-block" role="alert">{{ $errors->first('alamat') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                                    <label class="required" for="no_hp">No Handphone</label>
                                    <input class="form-control" type="text" name="no_hp" id="no_hp"
                                        value="{{ old('no_hp', '') }}" required>
                                    @if ($errors->has('no_hp'))
                                        <span class="help-block" role="alert">{{ $errors->first('no_hp') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('asal_sekolah') ? 'has-error' : '' }}">
                                    <label class="required" for="asal_sekolah">Asal Sekolah (SMK / SMA)</label>
                                    <input class="form-control" type="text" name="asal_sekolah" id="asal_sekolah"
                                        value="{{ old('asal_sekolah', '') }}" required>
                                    @if ($errors->has('asal_sekolah'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('asal_sekolah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('medsos') ? 'has-error' : '' }}">
                                    <label class="required" for="medsos">Media Sosial</label>
                                    <input class="form-control" type="text" name="medsos" id="medsos"
                                        value="{{ old('medsos', '') }}" required>
                                    @if ($errors->has('medsos'))
                                        <span class="help-block" role="alert">{{ $errors->first('medsos') }}</span>
                                    @endif
                                </div>
                            @else
                                <div class="form-group {{ $errors->has('prodi') ? 'has-error' : '' }}">
                                    <label>Prodi</label>
                                    <select class="form-control" name="prodi" id="prodi">
                                        <option value disabled {{ old('prodi', null) === null ? 'selected' : '' }}>Pilih
                                            Salah
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
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('tempat_lahir') }}</span>
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
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('asal_sekolah') }}</span>
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
                            @endif
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
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('mahasiswa_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('user.mahasiswas.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Mahasiswa:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
