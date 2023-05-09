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
                    Student Data 
                </div>
                <div class="card-body">
                    <div id="identity">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Name</div>
                            <div class="col-8 col-sm-8 col-md-9">: {{ $user->student->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Class</div>
                            <div class="col-8 col-sm-8 col-md-9">: {{ $user->student->class }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">NISN</div>
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
                    Borrowed Books
                </div>
                <div class="card-body">
                    <div class="table-responsive my-3">
                        <table class="table" >
                            <thead class="table-dark thead-sticky" style="text-align: center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="">Book Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center" id="list-pinjam">
                                @foreach ($rents as $index => $rent)
                                    @if($rent->is_returned == 1)
                                        <tr>
                                            <td>{{$index + 1}}.</td>
                                            <td style="text-align: left" id="book_{{ $rent->book->id }}" >{{ $rent->book->name }}</td>
                                            <td>Pending</button></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$index + 1}}.</td>
                                            <td style="text-align: left" id="book_{{ $rent->book->id }}" >{{ $rent->book->name }}</td>
                                            <td><button type="button" class="btn btn-warning" onclick="returnBook({{ $rent->book->id }})">Return</button></td>
                                        </tr>
                                    @endif  
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
                    List of Available Books
                </div>
                <div class="card-body">
                    <label for="filter-username">Book Title Search :</label>
                    <input type="search" id="search" placeholder="Search" onkeyup="search()">
                    <div class="table-responsive my-3">
                        <table class="table" >
                            <thead class="table-dark thead-sticky" style="text-align: center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="">Book Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center" id="list-buku">
                                @foreach ($books as $index => $book)
                                <tr>
                                    <td >{{$index + 1}}.</td>
                                    <td style="text-align: left" id="book_{{ $book->id }}" >{{ $book->name }}</td>
                                    <td><button type="button" class="btn btn-primary" onclick="rentBook({{ $book->id }})">Borrow</button></td>
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
                    alert("The process of borrowing book was successful")
                }else{
                    alert("Borrowing books failed, borrowed book can not be more than 3 pieces")
                }

                data.books.forEach((book,index) => {
                    list1.innerHTML += `
                        <tr>
                            <td >${index + 1}.</td>
                            <td style="text-align: left" id="book_${ book.id }" >${ book.name }</td>
                            <td><button type="button" class="btn btn-primary" onclick="rentBook(${ book.id })">Rent</button></td>
                        </tr>  
                    `
                })

                data.rents.forEach((rent,index) => {
                    if(rent.is_returned == 1){
                        list2.innerHTML += `
                        <tr>
                            <td>${index + 1}.</td>
                            <td style="text-align: left" id="book_${ data.books2[index].id }" >${ data.books2[index].name }</td>
                            <td>Pending</td>
                        </tr>  
                        `
                    }else{
                        list2.innerHTML += `
                            <tr>
                                <td>${index + 1}.</td>
                                <td style="text-align: left" id="book_${ data.books2[index].id }" >${ data.books2[index].name }</td>
                                <td><button type="button" class="btn btn-warning" onclick="returnBook(${ data.books2[index].id })">Return</button></td>
                            </tr>  
                        `
                    }
                })
            }
        })
    }
    
    const returnBook = (id) => {
        let name = $(`#book_${id}`).text()
        if (!confirm("Are you sure to return the book entitled " + name + "?")) return

        const list1 = document.getElementById('list-buku')
        list1.innerHTML = ''

        const list2 = document.getElementById('list-pinjam')
        list2.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("return.book") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function(data) {
                if(data.status == "Success"){
                    alert("The process of returning book was successful, please wait until the librarian confirmed")
                }else{
                    alert("Returning book failed")
                }

                data.books.forEach((book,index) => {
                    list1.innerHTML += `
                        <tr>
                            <td >${index + 1}.</td>
                            <td style="text-align: left" id="book_${ book.id }" >${ book.name }</td>
                            <td><button type="button" class="btn btn-primary" onclick="rentBook(${ book.id })">Rent</button></td>
                        </tr>  
                    `
                })

                data.rents.forEach((rent,index) => {
                    if(rent.is_returned == 1){
                        list2.innerHTML += `
                        <tr>
                            <td>${index + 1}.</td>
                            <td style="text-align: left" id="book_${ data.books2[index].id }" >${ data.books2[index].name }</td>
                            <td>Pending</td>
                        </tr>  
                        `
                    }else{
                        list2.innerHTML += `
                            <tr>
                                <td>${index + 1}.</td>
                                <td style="text-align: left" id="book_${ data.books2[index].id }" >${ data.books2[index].name }</td>
                                <td><button type="button" class="btn btn-warning" onclick="returnBook(${ data.books2[index].id })">Return</button></td>
                            </tr>  
                        `
                    }
                })
            }
        })
    }

    const search = () =>{
        let value = $('#search').val()

        const list1 = document.getElementById('list-buku')
        list1.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("search.book") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'value': value,
            },
            success: function(data) {

                data.books.forEach((book,index) => {
                    list1.innerHTML += `
                        <tr>
                            <td >${index + 1}.</td>
                            <td style="text-align: left" id="book_${ book.id }" >${ book.name }</td>
                            <td><button type="button" class="btn btn-primary" onclick="rentBook(${ book.id })">Borrow</button></td>
                        </tr>  
                    `
                })
            }
        })
    }

</script>
@endsection