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
                    Librarian Data
                </div>
                <div class="card-body">
                    <div id="identity">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Name</div>
                            <div class="col-8 col-sm-8 col-md-9">: {{ $user->teacher->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">NIPN</div>
                            <div class="col-8 col-sm-8 col-md-9">:  {{ $user->username }}</div>
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
                    List of Book Borrowers
                </div>
                <div class="card-body">
                    {{-- <button type="button" class="btn btn-primary"><i class="fa-solid fa-user-plus" style="margin-right: 4px"></i>Tambah</button> --}}
                    {{-- <label for="filter-username">Pencarian Nama Peminjam :</label>
                    <input type="search" placeholder="Search" onkeyup="search()" id="filter-username"> --}}
                    <div class="table-responsive my-3">
                        <table class="table" >
                            <thead class="table-dark" style="text-align: center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="25%">Book Title</th>
                                    <th width="25%">Name</th>
                                    <th width="">Borrow Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center" id="list-peminjam">
                                @foreach ($rented as $index => $r)
                                <tr>
                                    <td>{{$index+1}}.</td>
                                    <td style="text-align: left" style="max-width: 400px;">{{$r->book->name}}</td>
                                    <td >{{$r->student->name}}</td>
                                    <td>{{$r->rent_date}}</td> {{--Format e bebas--}}
                                    <td><button type="button" class="btn btn-success" onclick="accBook({{ $r->id }})" >Accept</button></td>
                                </tr>  
                                @endforeach
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
<script type="text/javascript">
    const accBook = (id) => {
        if (!confirm("Are you sure ?")) return

        const list1 = document.getElementById('list-peminjam')
        list1.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("acc.librarian") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function(data) {

                data.rented_update.forEach((rented,index) => {
                    list1.innerHTML += `
                        <tr>
                            <td>${index+1}.</td>
                            <td style="text-align: left" style="max-width: 400px;">${rented.book.name}</td>
                            <td>${rented.student.name}</td>
                            <td>${rented.rent_date}}</td>
                            <td><button type="button" class="btn btn-success" onclick="accBook(${ $rented.id })" >Accept</button></td>
                        </tr>  
                    `
                })
            }
        })
    }

</script>
@endsection