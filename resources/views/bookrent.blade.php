@extends('layouts.app')

@section('head')
<link href="{{ asset('css/bookrent.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="content">
    <div class="row w-100 m-0">
        <div class="col-12">
            {{-- Card Identitas --}}
            <div class="card">
                <div class="card-header ">
                    Data Siswa
                </div>
                <div class="card-body">
                    <div id="identity">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Nama</div>
                            <div class="col-8 col-sm-8 col-md-9">: </div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Kelas</div>
                            <div class="col-8 col-sm-8 col-md-9">: </div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">No. Induk</div>
                            <div class="col-8 col-sm-8 col-md-9">: </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Card Identitas --}}
        </div>
    </div>

    <div class="spacing"></div>

    <div class="row w-100 m-0">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Buku yang Sedang Dipinjam
                </div>
                <div class="card-body">
                    <div class="table-responsive my-3">
                        <table class="table" >
                            <thead class="table-dark thead-sticky" style="text-align: center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="">Judul Buku</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center" id="list-peminjam">
                                @for ($i = 1; $i <= 65; $i++)
                                <tr>
                                    <td>{{$i}}.</td>
                                    <td style="text-align: left">Buku Paket Ilmu Pengetahuan Alam</td>
                                    <td><button type="button" class="btn btn-warning">Return</button></td>
                                </tr>  
                                @endfor  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Daftar Buku yang Tersedia
                </div>
                <div class="card-body">
                    <label for="filter-username">Pencarian Judul Buku :</label>
                    <input type="text" value="" id="filter-title">
                    <div class="table-responsive my-3">
                        <table class="table" >
                            <thead class="table-dark thead-sticky" style="text-align: center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="">Judul Buku</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center" id="list-peminjam">
                                @for ($i = 1; $i <= 65; $i++)
                                <tr>
                                    <td>{{$i}}.</td>
                                    <td style="text-align: left">Buku Paket Ilmu Pengetahuan Alam</td>
                                    <td><button type="button" class="btn btn-primary">Pinjam</button></td>
                                </tr>  
                                @endfor  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</main>
@endsection