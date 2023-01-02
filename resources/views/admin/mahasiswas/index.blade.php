@extends('layouts.admin')
@section('content')
<div class="content">
    @can('mahasiswa_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.mahasiswas.create') }}">
                    Tambah Identitas Mahasiswa
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar Mahasiswa
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Mahasiswa">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        Nama
                                    <th>
                                        NPM
                                    </th>
                                    <th>
                                        Prodi
                                    </th>
                                    <th>
                                        Tempat Lahir
                                    </th>
                                    <th>
                                        Tanggal lahir
                                    </th>
                                    <th>
                                        Alamat
                                    </th>
                                    <th>
                                        No Handphone
                                    </th>
                                    <th>
                                        Asal Sekolah (SMA/SMK)
                                    </th>
                                    <th>
                                        Media Sosial
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswas as $key => $mahasiswa)
                                    <tr data-entry-id="{{ $mahasiswa->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $mahasiswa->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->user->nik ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->prodi ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->tempat_lahir ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->ttl ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->alamat ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->no_hp ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->asal_sekolah ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->medsos ?? '' }}
                                        </td>
                                        <td>
                                            @can('mahasiswa_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.mahasiswas.show', $mahasiswa->id) }}">
                                                    View
                                                </a>
                                            @endcan

                                            @can('mahasiswa_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.mahasiswas.edit', $mahasiswa->id) }}">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('mahasiswa_delete')
                                                <form action="{{ route('admin.mahasiswas.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('mahasiswa_delete')
  let deleteButtonTrans = 'Delete'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mahasiswas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Mahasiswa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection