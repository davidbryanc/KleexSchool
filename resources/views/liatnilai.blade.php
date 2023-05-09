@extends('layouts.app')

@section('head')
<link href="{{ asset('css/liatnilai.css') }}" rel="stylesheet">

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js" integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
@endsection

@section('content')
<main class="content">

    <div class="row w-100 m-0">
        <div class="col-12">
            {{-- Card Identitas --}}
            <div class="card">
                <div class="card-header ">
                    Action
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-3 d-flex align-items-center">
                            Select Semester :
                        </div>
                        <div class="col col-sm-8 col-md-7 d-flex align-items-center">
                            <select class="form-select" aria-label="Semester" id="selected-semester" onchange="showNilai()">
                                <option selected disabled>-- Select Semester --</option>
                                @foreach ($periods as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    {{-- <option value="2">Semester 2</option> --}}
                                @endforeach
                              </select>
                        </div>
                        <div class="col-2">
                            {{-- <form action="/exportpdf" method="get">
                                <input type="text" value="{{$user->username}}" name="username">
                                <input type="text">
                                <button type="submit"></button>
                            </form> --}}
                            <button id="export" class="btn btn-primary"> Export PDF</button>
                        </div>
                    </div>
                   
                </div>
            </div>
            {{-- End of Card Identitas --}}
        </div>
    </div>
    <div class="spacing"></div>

    <div id="exportContent">
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
            <div class="col-12">
                {{-- Card Nilai --}}
                <div class="card">
                    <div class="card-header">
                        Score Report
                    </div>
                    <div class="card-body">
                        {{-- Row Pilih Semester --}}
                        
                        {{-- End of Row Pilih Semester --}}
                        <div class="row my-1">
                            <div class="col">
                                <div class="row" id="semester">
                                    
                                </div>
                                <div class="table-responsive">
                                    
                                    <table class="table" id="table">
                                        <thead class="table-dark" style="text-align: center;">
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th>Subject</th>
                                                <th width="10%">Mid Score</th>
                                                <th width="10%">End Score</th>
                                                <th width="10%">Final Score</th>
                                                <th>Predicate</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center" id="grades">
                                            {{-- @for ($i = 1; $i <= 10; $i++)
                                            <tr>
                                                <td>{{$i}}.</td>
                                                <td style="text-align: left">Ilmu Pengetahuan Alam</td>
                                                <td>100</td>
                                                <td>95.5</td>
                                                <td><b>97.75</b></td>
                                                <td>A</td>
                                            </tr>
                                            @endfor --}}
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
    </div>
    
</main>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('js/printThis.js') }}"></script>

<script type="">

    $(document).ready(function () {
        $('#export').click(function () { 
            $('#exportContent').printThis();
        });
    });

    const showNilai = () => {
        let period_id = $(`#selected-semester`).val()

        const table = document.getElementById('grades')
        table.innerHTML = ''
        const semester = document.getElementById('semester')
        semester.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("show.nilai") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'period_id': period_id
            },
            success: function(data) {
                data.grades.forEach((grade,index) => {
                    table.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td style="text-align: left">${data.subjects[index].name}</td>
                            <td>${grade.mid_score}</td>
                            <td>${grade.end_score}</td>
                            <td><b>${grade.final_score}</b></td>
                            <td>${grade.nisbi}</td>
                        </tr>
                    `
                })
                semester.innerHTML +=`
                <div class="col-4 col-sm-4 col-md-3">Semester</div>
                <div class="col-8 col-sm-8 col-md-9 mb-3">:  ${data.semester}</div>
                `
            }
        })
    }

</script>
@endsection