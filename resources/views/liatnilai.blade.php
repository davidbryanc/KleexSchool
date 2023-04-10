@extends('layouts.app')

@section('head')
<link href="{{ asset('css/liatnilai.css') }}" rel="stylesheet">
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
                            <div class="col-8 col-sm-8 col-md-9">: Alexander Kenrick Duanto</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Kelas</div>
                            <div class="col-8 col-sm-8 col-md-9">: VII-A / 1</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">No. Induk</div>
                            <div class="col-8 col-sm-8 col-md-9">: 1534345</div>
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
            {{-- Card Nilai --}}
            <div class="card">
                <div class="card-header">
                    Daftar Nilai
                </div>
                <div class="card-body">
                    {{-- Row Pilih Semester --}}
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-3 d-flex align-items-center">
                            Pilih Semester :
                        </div>
                        <div class="col col-sm-8 col-md-9 d-flex align-items-center">
                            <select class="form-select" aria-label="Semester" id="selected-semester">
                                <option selected disabled>-- Pilih Semester --</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                              </select>
                        </div>
                    </div>
                    {{-- End of Row Pilih Semester --}}

                    <div class="row my-3">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark" style="text-align: center">
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th>Mata Pelajaran</th>
                                            <th width="10%">KKM</th>
                                            <th width="10%">NTS</th>
                                            <th width="10%">NAS</th>
                                            <th width="10%">NA</th>
                                            <th>Predikat</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        @for ($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td>{{$i}}.</td>
                                            <td style="text-align: left">Ilmu Pengetahuan Alam</td>
                                            <td>75</td>
                                            <td>100</td>
                                            <td>95.5</td>
                                            <td><b>97.75</b></td>
                                            <td>A</td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Card Nilai --}}
        </div>
    </div>
    
</main>
@endsection