@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="text-center">
                        <img width="128px" src="{{ asset('img/logo_unisba.png') }}" alt="">
                    </p>

                    <h2 class="text-center">SELAMAT DATANG DI SISTEM SIDANG SARJANA </br> FAKULTAS MIPA </br> UNIVERSITAS ISLAM BANDUNG</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection