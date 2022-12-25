@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-danger">PERHATIAN!!</h3>
                </div>
                <div class="card-body">
                    <li class="list-group-item"><p class="text-danger">Dokumen SKPI Yang Dimasukan Meliputi</p></li>
                    <ul class="list-group">
                        <li class="list-group-item">1)	Pengurus Lembaga Kemahasiswaan atau organisasi Kemahasiswaan (bukti sertifikat)</li>
                        <li class="list-group-item">2)	Kepanitian kegiatan: ketua, sekretaris, bendahara, koordinator bidang, anggota panitia (maksimal 5 kegiatan)  (bukti sertifikat)</li>
                        <li class="list-group-item">3)	Prestasi mengikuti kegiatan  disertai bukti pendukung (Piagam pengahargaan )</li>
                        <li class="list-group-item">4)	Pemakalah dalam kegaiatn seminar yang disertai bukti pendukung (bukti sertifikat)</li>
                        <li class="list-group-item">5)	Peserta pelatihan atau workshop yang disertai bukti pendukung(bukti sertifikat)</li>
                        <li class="list-group-item">6)	Peserta dalam seminar/webinar tingkat nasional/internasional  (bukti sertifikat)</li>
                        <li class="list-group-item">7)	Magang/Kuliah praktik/Kuliah Kerja Lapangan yang disertai bukti pendukung (bukti sertifikat)</li>
                        <li class="list-group-item">8)	Kegiatan MBKM (bukti sertifikat)</li>
                        <li class="list-group-item">9)	Anggota penelitian/PKM dosen  yang disertai dengan bukti lembar pengesahan (bukti lembar pengesahan)</li>
                        <li class="list-group-item">10)	Menghasilkan publikasi ilmiah baik di jurnal atau book chapter (bukti artikel yang sudah dipublikasi)</li>
                        <li class="list-group-item">11)	Melaksanaan program kreatifitas mahasiswa (bukti laporan)</li>
                        <li class="list-group-item">12)	Asisten laboratorium (bukti sertifikat)</li>
                    </ul>
                </div>
            </div>
            @can('skpi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('user.skpis.create') }}">
                            Tambah Skpi
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    Daftar Skpi
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Skpi">
                            <thead>
                                <tr>
                                    <th>
                                        NPM
                                    </th>
                                    <th>
                                        Nama Kegiatan (Bahasa Indonesia)
                                    </th>
                                    <th>
                                        Nama Kegiatan (Bahasa Inggris)
                                    </th>
                                    <th>
                                        Keterangan
                                    </th>
                                    <th>
                                        File
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skpis as $key => $skpi)
                                    <tr data-entry-id="{{ $skpi->id }}">
                                        <td>
                                            {{ $skpi->nama->nik ?? '' }}
                                        </td>
                                        <td>
                                            {{ $skpi->kualifikasi ?? '' }}
                                        </td>
                                        <td>
                                            {{ $skpi->kegiatan ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Skpi::KETERANGAN_SELECT[$skpi->keterangan] ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($skpi->file as $key => $media)
                                                <a href="https://{{ $media->getUrl() }}" target="_blank">
                                                    View File
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('skpi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('user.skpis.show', $skpi->id) }}">
                                                    View
                                                </a>
                                            @endcan

                                            @can('skpi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('user.skpis.edit', $skpi->id) }}">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('skpi_delete')
                                                <form action="{{ route('user.skpis.destroy', $skpi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('skpi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('user.skpis.massDestroy') }}",
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
  let table = $('.datatable-Skpi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection