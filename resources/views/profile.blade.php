@extends('layouts.app')

@section('head')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="content">
    <div class="row w-100 m-0">
        <div class="col-12">
            {{-- Card Identitas --}}
            <div class="card">
                <div class="card-header ">
                    Profile
                </div>
                <div class="card-body">
                    <div id="identity">
                        <div class="row">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-3">Nama</div>
                                    <div class="col-8 col-sm-8 col-md-9">: Alexander Kenrick Duanto</div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-3">NIPN</div>
                                    <div class="col-8 col-sm-8 col-md-9">: 28634591</div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-3">Jenis Kelamin</div>
                                    <div class="col-8 col-sm-8 col-md-9">: Pria</div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-3">Alamat</div>
                                    <div class="col-8 col-sm-8 col-md-9">: Surabaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-3">Tgl. Lahir</div>
                                    <div class="col-8 col-sm-8 col-md-9">: 2003-01-17</div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-3">No. Telp</div>
                                    <div class="col-8 col-sm-8 col-md-9">: 081234567890</div>
                                </div>
                            </div>
                            <div class="col-2">
                                <img src="{{ asset('assets/profiles/dummy.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Card Identitas --}}
        </div>
    </div>

@endsection
