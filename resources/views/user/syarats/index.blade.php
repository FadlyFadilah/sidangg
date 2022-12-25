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
                            aria-controls="home" aria-selected="true">Syarat Sidang</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form method="POST" action="{{ route('user.syarats.store') }}" enctype="multipart/form-data">
                            <table class="table table-bordered table-striped">
                                @csrf
                                <tr>
                                    <th>
                                        <div class="form-group {{ $errors->has('skripsi') ? 'has-error' : '' }}">
                                            <label for="skripsi">File Skripsi (Sudah Ditandatangani Pembimbing) </label>
                                            <input class="form-control-file" type="file" name="skripsi" id="skripsi"
                                                value="{{ old('skripsi', '') }}">
                                            @if ($errors->has('skripsi'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('skripsi') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a
                                                href="{{ asset('/storage/' . $syarat->skripsi) }}">{{ $syarat->skripsi }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->skripsistatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->skripsistatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->skripsistatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @if ($syarat === null)
                                    <tr>
                                        <th colspan="3">
                                            <div class="form-group {{ $errors->has('judul') ? 'has-error' : '' }}">
                                                <label for="judul">Judul Skripsi</label>
                                                <input class="form-control" type="text" name="judul" id="judul"
                                                    value="{{ old('judul', '') }}">
                                                @if ($errors->has('judul'))
                                                    <span class="help-block"
                                                        role="alert">{{ $errors->first('judul') }}</span>
                                                @endif
                                            </div>
                                        </th>
                                    </tr>
                                @else
                                    <tr>
                                        <th colspan="3">
                                            <div class="form-group {{ $errors->has('judul') ? 'has-error' : '' }}">
                                                <label for="judul">Judul Skripsi</label>
                                                <input class="form-control" type="text" name="judul" id="judul"
                                                    value="{{ old('judul', $syarat->judul) }}">
                                                @if ($errors->has('judul'))
                                                    <span class="help-block"
                                                        role="alert">{{ $errors->first('judul') }}</span>
                                                @endif
                                            </div>
                                        </th>
                                    </tr>
                                @endif
                                <tr>
                                    <th>
                                        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                            <label for="photo">Pas Photo (format .jpg/.png) </label>
                                            <input class="form-control-file" type="file" name="photo" id="photo"
                                                value="{{ old('photo', '') }}">
                                            @if ($errors->has('photo'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <img width="128px" src="{{ asset('/storage/' . $syarat->photo) }}"
                                                alt="Pas Photo">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->photostatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->photostatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->photostatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="form-group {{ $errors->has('ppmb') ? 'has-error' : '' }}">
                                            <label for="ppmb">Sertifikat PPMB</label>
                                            <input class="form-control-file" type="file" name="ppmb" id="ppmb"
                                                value="{{ old('ppmb', '') }}">
                                            @if ($errors->has('ppmb'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('ppmb') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a href="{{ asset('/storage/' . $syarat->ppmb) }}">{{ $syarat->ppmb }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->ppmbstatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->ppmbstatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->ppmbstatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div
                                            class="form-group {{ $errors->has('serticalonsarjana') ? 'has-error' : '' }}">
                                            <label for="serticalonsarjana">Sertifikat Pesantren Calon
                                                Sarjana</label>
                                            <input class="form-control-file" type="file" name="serticalonsarjana"
                                                id="serticalonsarjana" value="{{ old('serticalonsarjana', '') }}">
                                            @if ($errors->has('serticalonsarjana'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('serticalonsarjana') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a
                                                href="{{ asset('/storage/' . $syarat->serticalonsarjana) }}">{{ $syarat->serticalonsarjana }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->serticalonsarjanastatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->serticalonsarjanastatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->serticalonsarjanastatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div
                                            class="form-group {{ $errors->has('sertibebasperpus') ? 'has-error' : '' }}">
                                            <label for="sertibebasperpus">Surat Keterangan Bebas Perpustakaan Universitas
                                            </label>
                                            <input class="form-control-file" type="file" name="sertibebasperpus"
                                                id="sertibebasperpus" value="{{ old('sertibebasperpus', '') }}">
                                            @if ($errors->has('sertibebasperpus'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('sertibebasperpus') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a
                                                href="{{ asset('/storage/' . $syarat->sertibebasperpus) }}">{{ $syarat->sertibebasperpus }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->sertibebasperpusstatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->sertibebasperpusstatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->sertibebasperpusstatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="form-group {{ $errors->has('sertimaba') ? 'has-error' : '' }}">
                                            <label for="sertimaba">Sertifikat Pesantren Maba</label>
                                            <input class="form-control-file" type="file" name="sertimaba"
                                                id="sertimaba" value="{{ old('sertimaba', '') }}">
                                            @if ($errors->has('sertimaba'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('sertimaba') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a
                                                href="{{ asset('/storage/' . $syarat->sertimaba) }}">{{ $syarat->sertimaba }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->sertimabastatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->sertimabastatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->sertimabastatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="form-group {{ $errors->has('bebaslab') ? 'has-error' : '' }}">
                                            <label class="" for="bebaslab">Surat Keterangan Bebas Peminjaman Alat
                                                Laboratorium </label>
                                            <input class="form-control-file" type="file" name="bebaslab"
                                                id="bebaslab" value="{{ old('bebaslab', '') }}">
                                            @if ($errors->has('bebaslab'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('bebaslab') }}</span>
                                            @endif
                                            <span class="help-block">*Hanya Prodi Farmasi</span>
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a
                                                href="{{ asset('/storage/' . $syarat->bebaslab) }}">{{ $syarat->bebaslab }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->bebaslabstatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->bebaslabstatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->bebaslabstatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="form-group {{ $errors->has('transkrip') ? 'has-error' : '' }}">
                                            <label for="transkrip">File Transkrip Nilai</label>
                                            <input class="form-control-file" type="file" name="transkrip"
                                                id="transkrip" value="{{ old('transkrip', '') }}">
                                            @if ($errors->has('transkrip'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('transkrip') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a
                                                href="{{ asset('/storage/' . $syarat->transkrip) }}">{{ $syarat->transkrip }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->transkripstatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->transkripstatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->transkripstatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="form-group {{ $errors->has('pembayaran') ? 'has-error' : '' }}">
                                            <label for="pembayaran">Bukti Pembayaran Biaya Sidang Sarjana</label>
                                            <input class="form-control-file" type="file" name="pembayaran"
                                                id="pembayaran" value="{{ old('pembayaran', '') }}">
                                            @if ($errors->has('pembayaran'))
                                                <span class="help-block"
                                                    role="alert">{{ $errors->first('pembayaran') }}</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($syarat === null)
                                            <a href="#"></a>
                                        @else
                                            <a
                                                href="{{ asset('/storage/' . $syarat->pembayaran) }}">{{ $syarat->pembayaran }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($syarat === null)
                                            <i class="fa-2x fas fa-ellipsis-h"></i>
                                        @else
                                            @if ($syarat->pembayaranstatus == 0)
                                                <i class="fa-2x fas fa-ellipsis-h"></i>
                                            @elseif ($syarat->pembayaranstatus == 1)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                            @elseif ($syarat->pembayaranstatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <button class="btn btn-danger" type="submit">
                                                Simpan
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        @if ($syarat === null)
                            <p></p>
                        @else
                            <div class="form-group">
                                <label for="feedback">Status Persyaratan Sidang</label>
                                <p class="form-control" id="feedback">{{ $syarat->status }}</p>
                            </div>
                        @endif
                        @if ($syarat === null)
                            <p></p>
                        @else
                            <div class="form-group">
                                <label for="feedback">Pesan</label>
                                <textarea class="form-control" id="feedback" rows="3" disabled>{{ $syarat->feedback }}</textarea>
                            </div>
                        @endif
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
