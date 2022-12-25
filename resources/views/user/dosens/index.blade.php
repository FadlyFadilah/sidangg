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
                            aria-controls="home" aria-selected="true">Daftar Mahasiswa Yang Dibimbing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Daftar Mahasiswa Yang Diuji</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nilai-tab" data-toggle="tab" href="#nilai" role="tab"
                            aria-controls="nilai" aria-selected="false">Input Nilai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="hasil-tab" data-toggle="tab" href="#hasil" role="tab"
                            aria-controls="hasil" aria-selected="false">Hasil Nilai</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3>Mahasiswa Yang Dibimbing</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    @foreach ($mahasiswa->mahasiswas as $mhs)
                                        <tr>
                                            <td>{{ $mhs->user->name }}</td>
                                            <td class="text-uppercase">{{ $mhs->user->nik }}</td>
                                            @foreach ($mhs->syarats as $s)
                                                @if ($s->skripsi)
                                                    <td><a href="{{ asset('/storage/' . $s->skripsi) }}">Skripsi</a></td>
                                                @else
                                                    <td>Belum Mengupload File Skripsi</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3>Mahasiswa Yang Diuji</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    @foreach ($mahasiswa->mahsiswapenguji as $mhs)
                                        <tr>
                                            <td>{{ $mhs->user->name }}</td>
                                            <td class="text-uppercase">{{ $mhs->user->nik }}</td>
                                            @foreach ($mhs->syarats as $s)
                                                @if ($s->skripsi != '')
                                                    <td><a href="{{ asset('/storage/' . $s->skripsi) }}">Skripsi</a></td>
                                                @else
                                                    <td>Belum Mengupload File Skripsi</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nilai" role="tabpanel" aria-labelledby="nilai-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3>Nilai</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    @foreach ($mahasiswa->mahsiswapenguji as $mhs)
                                        <tr>
                                            <td class="text-uppercase">{{ $mhs->user->name }}</td>
                                            <td>
                                                <form class="form-inline" action="{{ route('dosen.nilais.store') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="mahasiswa_id" value="{{ $mhs->id }}">
                                                    <div class="form-group mb-2 ">
                                                        <label for="nilai" class="sr-only">Nilai</label>
                                                        <input type="text"
                                                            class="form-control-plaintext border border-primary"
                                                            id="nilai" name="nilai" value="">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hasil" role="tabpanel" aria-labelledby="hasil-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3>Hasil Nilai</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    @if ($nilais->isNotEmpty())
                                        @foreach ($nilais as $mhs)
                                            <tr>
                                                <td class="text-uppercase">{{ $mhs->mahasiswa->user->name }}</td>
                                                <td>
                                                    <form class="form-inline" action="{{ route('dosen.nilais.store') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="mahasiswa_id"
                                                            value="{{ $mhs->mahasiswa_id }}">
                                                        <div class="form-group mb-2">
                                                            <label for="nilai" class="sr-only">Nilai</label>
                                                            <input type="text" class="form-control-plaintext"
                                                                id="nilai" name="nilai"
                                                                value="{{ $mhs->nilai }}">
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary mb-2">Simpan</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
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
