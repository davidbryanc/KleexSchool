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
                        <img src="{{ asset('images/p'.$user->username.'.png') }}" alt="">
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col py-3">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-4">Name</div>
                            <div class="col-8 col-sm-8 col-md">: {{ $profile->name }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">NIPN/NISN</div>
                            <div class="col-8 col-sm-8 col-md">: {{ $user->username }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Status</div>
                            <div class="col-8 col-sm-8 col-md">: {{ $user->role }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Class</div>
                            <div class="col-8 col-sm-8 col-md">: {{ $profile->class }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Gender</div>
                            <div class="col-8 col-sm-8 col-md">: {{ $profile->gender }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Address</div>
                            <div class="col-8 col-sm-8 col-md">: {{ Crypt::decryptString($profile->address) }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Birth Date</div>
                            <div class="col-8 col-sm-8 col-md">: {{ $profile->birth_date }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4 col-sm-4 col-md-4">Phone Number</div>
                            <div class="col-8 col-sm-8 col-md">: {{ Crypt::decryptString($profile->phone_number) }}</div>
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