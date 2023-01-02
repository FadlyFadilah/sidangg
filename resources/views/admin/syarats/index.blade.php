@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('syarat_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-6">
                    <a class="btn btn-success" href="{{ route('admin.syarats.create') }}">
                        Tambah Syarat Sidang
                    </a>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-warning" data-toggle="modal"
                        data-target="#modal-default"><i class="fas fa-calendar"></i>
                        Filter Status</button>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Daftar Syarat Sidang
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-syarat">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            NPM
                                        </th>
                                        <th>
                                            Mahasiswa
                                        </th>
                                        <th>
                                            Prodi
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($syarats as $key => $syarat)
                                        <tr data-entry-id="{{ $syarat->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $syarat->mahasiswa->user->nik ?? '' }}
                                            </td>
                                            <td>
                                                {{ $syarat->mahasiswa->user->name ?? '' }}
                                            </td>
                                            <td class="text-capitalize">
                                                {{ $syarat->mahasiswa->prodi ?? '' }}
                                            </td>
                                            <td>
                                                {{ $syarat->status ?? '' }}
                                            </td>
                                            <td>
                                                @can('syarat_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('admin.syarats.show', $syarat->id) }}">
                                                        View
                                                    </a>
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Filter Status</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.syarats.indexx') }}" method="post" required>
                                @csrf
                                <div class="modal-body">
                                    <select name="status" class="form-control" id="status">
                                        <option selected hidden>--Pilih Salah Satu!--</option>
                                        <option value="Belum Terverifikasi">Belum Terverifikasi</option>
                                        <option value="Terverifikasi Admin Fakultas">Terverifikasi Admin Fakultas</option>
                                        <option value="Terverifikasi Dengan Perbaikan">Terverifikasi Dengan Perbaikan</option>
                                        <option value="Disetujui Kasie Akademik">Disetujui Kasie Akademik</option>
                                        <option value="Disetujui Wakil Dekan 1">Disetujui Wakil Dekan 1</option>
                                    </select>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-flat btn-primary">Ubah Status</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
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
            @can('syarat_delete')
                let deleteButtonTrans = 'Delete'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.syarats.massDestroy') }}",
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
            let table = $('.datatable-syarat:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
