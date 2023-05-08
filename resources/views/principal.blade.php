@extends('layouts.app')

@section('head')
<link href="{{ asset('css/principal.css') }}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
<main class="content">
    <div class="row w-100 m-0">
        {{-- <div class="col-2">
            <div class="card">
                <div class="card-header">
                    Tambah Tahun Ajaran
                </div>
                <div class="card-body d-flex justify-content-center">
                    <button type="button" class="btn btn-primary">Tambah</button>
                </div>
            </div> --}}
        {{-- </div> --}}
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Input Data Guru / Murid
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-2">
                                <span>Role</span>
                            </div>
                            <div class="col">
                                <div class="radio-container">
                                    <span>:</span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Teacher" id="guruRadio" name="type-radio">
                                        <label for="guruRadio">Teacher</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Student" id="muridRadio" name="type-radio">
                                        <label for="muridRadio">Student</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <label for="namaText">Nama</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <span>:</span>
                                <input class="form-control" type="text" placeholder="" aria-label="" id="namaText">
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-2 d-flex align-items-center">
                                <label for="namaText">Alamat</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <span>:</span>
                                <input class="form-control" type="text" placeholder="" aria-label="" id="kotaText">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <label for="dateInput">Tgl. Lahir</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <span>:</span>
                                <input type="date" class="form-control" id="dateInput">
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-2 d-flex align-items-center">
                                <label for="genderInput">Jenis Kelamin</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <div class="radio-container">
                                    <span>:</span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Male" id="lakiRadio" name="gender-radio">
                                        <label for="lakiRadio">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Female" id="perempuanRadio" name="gender-radio">
                                        <label for="perempuanRadio">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <label for="dateInput">No. Telp</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <span>:</span>
                                <input type="text" class="form-control" id="telpText">
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-2 d-flex align-items-center">
                                <label for="dateInput">Kelas</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <span>:</span>
                                <select name="select-kelas" id="kelasSelect" style="width: 19%;">
                                    <option value="" selected hidden>-- Pilih Kelas --</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <label for="usernameText">Username</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <span>:</span>
                                <input class="form-control" type="text" placeholder="" aria-label="" id="usernameText">
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-2 d-flex align-items-center">
                                <label for="namaText">Password</label>
                            </div>
                            <div class="col" style="display: flex; flex-direction:row;gap:20px;align-items:center">
                                <span>:</span>
                                <input class="form-control" type="text" placeholder="" aria-label="" id="passwordText">
                            </div>
                        </div>
                        <div class="row" >
                            <button type="button" class="btn btn-primary" id="tambahData" onclick="tambahDataSekolah()">Tambah</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.datepicker').datepicker();
    });

    const tambahDataSekolah = () => {
        let jenis = $('input[name=type-radio]:checked').val()     
        let nama = $(`#namaText`).val()
        let alamat = $(`#kotaText`).val()
        let tglLahir = $(`#dateInput`).val()
        let sex = $('input[name=gender-radio]:checked').val()
        let noTelp = $(`#telpText`).val()
        let kelas = $(`#kelasSelect`).val()
        let username = $(`#usernameText`).val()
        let password = $(`#passwordText`).val()

        $.ajax({
            type: 'POST',
            url: '{{ route("tambah.data") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'jenis': jenis,
                'nama': nama,
                'alamat': alamat,
                'tglLahir': tglLahir,
                'sex': sex,
                'noTelp': noTelp,
                'kelas': kelas,
                'username': username,
                'password': password,
            },
            success: function(data) {
                alert(data.message)
                window.location.reload();
            }
        })
    }
</script>
@endsection