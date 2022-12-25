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
                            aria-controls="home" aria-selected="true">Data Orangtua</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <form method="POST" action="{{ route('user.orangtuas.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            @if ($orangtua === null)
                                <div class="form-group {{ $errors->has('nama_ibu') ? 'has-error' : '' }}">
                                    <label class="required" for="nama_ibu">Nama Ibu</label>
                                    <input class="form-control" type="text" name="nama_ibu" id="nama_ibu"
                                        value="{{ old('nama_ibu', null) }}" required>
                                    @if ($errors->has('nama_ibu'))
                                        <span class="help-block" role="alert">{{ $errors->first('nama_ibu') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('pekerjaan_ibu') ? 'has-error' : '' }}">
                                    <label class="required">Pekerjaan Ibu</label>
                                    <select class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" required>
                                        <option value disabled
                                            {{ old('pekerjaan_ibu', null) === null ? 'selected' : '' }}>Silahkan Pilih
                                            Satu!</option>
                                        @foreach (App\Models\Orangtua::PEKERJAAN_IBU_SELECT as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('pekerjaan_ibu', null) === (string) $key ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pekerjaan_ibu'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('pekerjaan_ibu') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('nama_ayah') ? 'has-error' : '' }}">
                                    <label class="required" for="nama_ayah">Nama Ayah</label>
                                    <input class="form-control" type="text" name="nama_ayah" id="nama_ayah"
                                        value="{{ old('nama_ayah', null) }}" required>
                                    @if ($errors->has('nama_ayah'))
                                        <span class="help-block" role="alert">{{ $errors->first('nama_ayah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('pekerjaan_ayah') ? 'has-error' : '' }}">
                                    <label class="required">Pekerjaan Ayah</label>
                                    <select class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" required>
                                        <option value disabled
                                            {{ old('pekerjaan_ayah', null) === null ? 'selected' : '' }}>Silahkan Pilih
                                            Satu!</option>
                                        @foreach (App\Models\Orangtua::PEKERJAAN_AYAH_SELECT as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('pekerjaan_ayah', null) === (string) $key ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pekerjaan_ayah'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('pekerjaan_ayah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                    <label class="required" for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" required>{{ old('alamat', null) }}</textarea>
                                    @if ($errors->has('alamat'))
                                        <span class="help-block" role="alert">{{ $errors->first('alamat') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                                    <label class="required" for="no_hp">No Handphone</label>
                                    <input class="form-control" type="text" name="no_hp" id="no_hp"
                                        value="{{ old('no_hp', null) }}" required>
                                    @if ($errors->has('no_hp'))
                                        <span class="help-block" role="alert">{{ $errors->first('no_hp') }}</span>
                                    @endif
                                </div>
                            @else
                                <div class="form-group {{ $errors->has('nama_ibu') ? 'has-error' : '' }}">
                                    <label class="required" for="nama_ibu">Nama Ibu</label>
                                    <input class="form-control" type="text" name="nama_ibu" id="nama_ibu"
                                        value="{{ old('nama_ibu', $orangtua->nama_ibu) }}" required>
                                    @if ($errors->has('nama_ibu'))
                                        <span class="help-block" role="alert">{{ $errors->first('nama_ibu') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('pekerjaan_ibu') ? 'has-error' : '' }}">
                                    <label class="required">Pekerjaan Ibu</label>
                                    <select class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" required>
                                        <option value disabled
                                            {{ old('pekerjaan_ibu', null) === null ? 'selected' : '' }}>Silahkan Pilih
                                            Satu!</option>
                                        @foreach (App\Models\Orangtua::PEKERJAAN_IBU_SELECT as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('pekerjaan_ibu', $orangtua->pekerjaan_ibu) === (string) $key ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pekerjaan_ibu'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('pekerjaan_ibu') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('nama_ayah') ? 'has-error' : '' }}">
                                    <label class="required" for="nama_ayah">Nama Ayah</label>
                                    <input class="form-control" type="text" name="nama_ayah" id="nama_ayah"
                                        value="{{ old('nama_ayah', $orangtua->nama_ayah) }}" required>
                                    @if ($errors->has('nama_ayah'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('nama_ayah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('pekerjaan_ayah') ? 'has-error' : '' }}">
                                    <label class="required">Pekerjaan Ayah</label>
                                    <select class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" required>
                                        <option value disabled
                                            {{ old('pekerjaan_ayah', null) === null ? 'selected' : '' }}>Silahkan Pilih
                                            Satu!</option>
                                        @foreach (App\Models\Orangtua::PEKERJAAN_AYAH_SELECT as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('pekerjaan_ayah', $orangtua->pekerjaan_ayah) === (string) $key ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pekerjaan_ayah'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('pekerjaan_ayah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                    <label class="required" for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" required>{{ old('alamat', $orangtua->alamat) }}</textarea>
                                    @if ($errors->has('alamat'))
                                        <span class="help-block" role="alert">{{ $errors->first('alamat') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                                    <label class="required" for="no_hp">No Handphone</label>
                                    <input class="form-control" type="text" name="no_hp" id="no_hp"
                                        value="{{ old('no_hp', $orangtua->no_hp) }}" required>
                                    @if ($errors->has('no_hp'))
                                        <span class="help-block" role="alert">{{ $errors->first('no_hp') }}</span>
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
