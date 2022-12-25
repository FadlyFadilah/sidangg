@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white" style="background-color: #004675;">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        SELAMAT DATANG DI SISTEM SIDANG SARJANA FAKULTAS MIPA
                    </div>
                </div>
                <div class="card text-white mt-3" style="background-color: #004675;">
                    <div class="card-header">
                        Langkah - Langkah Penggunaan
                    </div>
                    <div class="card-body">
                        1. Klik Menu Profile di kanan atas </br>
                        2. Isi menu Identitas Mahasiswa </br>
                        3. Isi Menu Identitas Orang Tua </br>
                        4. Lengkapi Dokumen Persyaratan Sidang </br>
                        5. Hubungi Admin Fakultas Untuk Konfirmasi Dan Dan Diverifikasi </br>
                        6. Jika ada data yang ditolak, silahkan upload kembali persyaratan tersebut </br>
                        7. Jika status sudah berubah menjadi “Disetujui Wakil Dekan 1” maka pilih Dosen Pembimbing dan Dosen
                        Penguji </br>
                        8. Proses Pendaftaran Selesai </br>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
