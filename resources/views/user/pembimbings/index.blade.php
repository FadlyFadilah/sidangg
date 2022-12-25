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
                            aria-controls="home" aria-selected="true">Pilih Dosen Pembimbing</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <form method="POST" action="{{ route('user.pembimbings.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('dosens') ? 'has-error' : '' }}">
                                <label class="required" for="dosens">Nama Dosen</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Pilih Semua</span>
                                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Batalkan Pilih
                                        Semua</span>
                                </div>
                                <select class="form-control select2" name="dosens[]" id="dosens" multiple required>
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->user_id }}">{{ $dosen->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('dosens'))
                                    <span class="help-block" role="alert">{{ $errors->first('dosens') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                        <div class="card">
                            <div class="card-header">
                                <h3>Pembimbing</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    @foreach ($mahasiswa->userpembimbing as $dosen)
                                        <tr>
                                            <td>{{ $dosen->name }}</td>
                                        </tr>
                                    @endforeach
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
