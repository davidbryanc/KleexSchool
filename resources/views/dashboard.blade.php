@extends('layouts.app')

@section('head')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@endsection

@section('content')


<main class="content">
    <div class="card" id="welcome">
        <div class="card-body">
            <div class="header">
               Kleex School
            </div>
            <section id="profile-section">
                <div class="row mt-3">
                    <div class="col d-flex justify-content-center">
                        <img src="{{ asset('assets/profiles/dummy.png') }}" alt="">
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col py-3">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-4">Nama</div>
                            <div class="col-8 col-sm-8 col-md">: Alexander Kenrick Duanto</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">NIPN</div>
                            <div class="col-8 col-sm-8 col-md">: 28634591</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Kelas</div>
                            <div class="col-8 col-sm-8 col-md">: 7</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Jenis Kelamin</div>
                            <div class="col-8 col-sm-8 col-md">: Pria</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Alamat</div>
                            <div class="col-8 col-sm-8 col-md">: Surabaya</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Tgl. Lahir</div>
                            <div class="col-8 col-sm-8 col-md">: 2003-01-17</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">No. Telp</div>
                            <div class="col-8 col-sm-8 col-md">: 081234567890</div>
                        </div>
                    </div>
                    {{-- <div class="col-2">
                        
                    </div> --}}
                </div>
            </section>
        </div>
    </div>
</main>
    
@endsection