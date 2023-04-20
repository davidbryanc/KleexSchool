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
                            <div class="col-8 col-sm-8 col-md-9">: {{ $user->student->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Kelas</div>
                            <div class="col-8 col-sm-8 col-md-9">: {{ $user->student->class }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">No. Induk</div>
                            <div class="col-8 col-sm-8 col-md-9">: {{ $user->username }}</div>
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
                            <tbody style="text-align: center" id="list-pinjam">
                                @foreach ($rents as $index => $rent)
                                    <tr>
                                        <td>{{$index + 1}}.</td>
                                        <td style="text-align: left" id="book_{{ $rent->id }}" >{{ $rent->name }}</td>
                                        <td><button type="button" class="btn btn-warning" onclick="returnBook({{ $rent->id }})">Return</button></td>
                                    </tr>  
                                @endforeach  
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
                            <tbody style="text-align: center" id="list-buku">
                                @foreach ($books as $index => $book)
                                <tr>
                                    <td >{{$index + 1}}.</td>
                                    <td style="text-align: left" id="book_{{ $book->id }}" >{{ $book->name }}</td>
                                    <td><button type="button" class="btn btn-primary" onclick="rentBook({{ $book->id }})">Rent</button></td>
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

    const rentBook = (id) => {
        let name = $(`#book_${id}`).text()
        if (!confirm("Are you sure borrowing a book called " + name + "?")) return

        const list1 = document.getElementById('list-buku')
        list1.innerHTML = ''

        const list2 = document.getElementById('list-pinjam')
        list2.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("rent.book") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function(data) {
                if(data.status == "Success"){
                    alert("The process of borrowing books was successful")
                }else{
                    alert("Borrowing books failed, borrowed books can not be more than 3 pieces")
                }

                data.books.forEach((book,index) => {
                    list1.innerHTML += `
                        <tr>
                            <td >${index + 1}.</td>
                            <td style="text-align: left" id="book_${ book.id }" >${ book.name }</td>
                            <td><button type="button" class="btn btn-primary" onclick="rentBook(${ $book.id })">Rent</button></td>
                        </tr>  
                    `
                })

                data.rents.forEach((rent,index) => {
                    list2.innerHTML += `
                        <tr>
                            <td>${index + 1}.</td>
                            <td style="text-align: left" id="book_${ rent.id }" >${ rent.name }</td>
                            <td><button type="button" class="btn btn-warning" onclick="returnBook(${ rent.id })">Return</button></td>
                        </tr>  
                    `
                })
            }
        })
    }
    
    const returnBook = (id) => {
        let name = $(`#book_${id}`).text()
        if (!confirm("Are you sure to return the book entitled " + name + "?")) return

        $.ajax({
            type: 'POST',
            url: '{{ route("return.book") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
            },
            success: function(data) {
            }
        })
    }
</script>
@endsection