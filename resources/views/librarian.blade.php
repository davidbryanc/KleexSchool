@extends('layouts.app')

@section('head')
<link href="{{ asset('css/librarian.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="content">
    <div class="row w-100 m-0">
        <div class="col-12">
            {{-- Card Identitas --}}
            <div class="card">
                <div class="card-header ">
                    Data Petugas Perpustakaan
                </div>
                <div class="card-body">
                    <div id="identity">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Nama</div>
                            <div class="col-8 col-sm-8 col-md-9">: Nico Victorio</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">NIPN</div>
                            <div class="col-8 col-sm-8 col-md-9">: 28634591</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Card Identitas --}}
        </div>
    </div>

    <div class="spacing"></div>

    <div class="row w-100 m-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Daftar Peminjam
                </div>
                <div class="card-body">
                    {{-- <button type="button" class="btn btn-primary"><i class="fa-solid fa-user-plus" style="margin-right: 4px"></i>Tambah</button> --}}
                    <label for="filter-username">Pencarian No. Induk :</label>
                    <input type="number" min="0" value="" id="filter-username">
                    <div class="table-responsive my-3">
                        <table class="table" >
                            <thead class="table-dark" style="text-align: center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="25%">Judul Buku</th>
                                    <th width="25%">Nama Peminjam</th>
                                    <th width="">Tgl. Pinjam</th>
                                    <th width="">Tgl. Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center" id="list-peminjam">
                                @for ($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td>{{$i}}.</td>
                                    <td style="text-align: left" style="max-width: 400px;">Buku Paket Ilmu Pengetahuan Alam</td>
                                    <td >Alexander Kenrick Duanto</td>
                                    <td>15/04/2023 14:07</td> {{--Format e bebas--}}
                                    <td>18/04/2023 14:25</td> {{--Format e bebas--}}
                                    <td><button type="button" class="btn btn-success">Terima</button></td>
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

@section('script')

@endsection