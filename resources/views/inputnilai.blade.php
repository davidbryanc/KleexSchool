@extends('layouts.app')

@section('head')
<link href="{{ asset('css/inputnilai.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="content">

    <div class="row w-100 m-0">
        <div class="col-12">
            {{-- Card Identitas --}}
            <div class="card">
                <div class="card-header ">
                    Teacher Data
                </div>
                <div class="card-body">
                    <div id="identity">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">Name</div>
                            <div class="col-8 col-sm-8 col-md-9">: {{ $user->teacher->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-3">NIPN</div>
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
            <div class="card">
                <div class="card-header">
                    Semester
                </div>
                <div class="card-body row">
                    <div class="col-4 col-sm-4 col-md-3 d-flex align-items-center">
                        Select Semester
                    </div>
                    <div class="col-8 col-sm-8 col-md-9 d-flex align-items-center">
                        <select class="form-select" aria-label="Semester" id="selected-semester">
                            <option selected disabled>-- Select Semester --</option>
                            @foreach ($periods as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="spacing"></div>

    <div class="row w-100 m-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    List of Subjects
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-dark" style="text-align: center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Subject</th>
                                    <th width="">Edit</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                                @foreach($subject as $key => $value)
                                <tr>
                                    <td>{{$key + 1}}.</td>
                                    <td style="text-align: left">{{ $value->name }}</td>
                                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#listmurid" onclick="hiddenSubject({{ $value->id }})">
                                            <i class="fa-solid fa-pencil edit-icon"></i><span class="edit-btn">Edit</span>
                                        </button>
                                    </td>
                                </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <!-- Modal -->
    <div class="modal fade" id="listmurid" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #4b5fda;color:white;">
                    <h1 class="modal-title fs-5" id="">Student List</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-dark" style="text-align: center">
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Student Name</th>
                                    <th colspan="2">Score</th>
                                </tr>
                                <tr>
                                    <th width="10%">Mid Score</th>
                                    <th width="10%">End Score</th>
                                </tr>
                            </thead>
                            <tbody id="detail">
                                @foreach ($students as $key=>$value)
                                    <tr style="text-align: center">
                                        <td>{{$key+1}}.</td>
                                        <td>{{ $value->name }}</td>
                                        <input type="hidden" class = "student-id" value = "{{ $value->id }}">
                                        <input type="hidden" id = "subject-id" value = "">
                                        <td><input type="number" inputmode="numeric" class="form-class nts" id="nts_" max="100" min="0"></td>
                                        <td><input type="number" inputmode="numeric" class="form-class nas" id="nas_" max="100" min="0"></td>                                   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="inputNilai()"><i class="fa-solid fa-download edit-icon" style="color: #ffffff;"></i>Save changes</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script type="text/javascript">
    const inputNilai = () => {
        let studentId = $(`.student-id`).map(function() { return $(this).val() }).get()
        let periodId = $(`#selected-semester`).val()
        let subjectId = $(`#subject-id`).val()
        let nts = $(`.nts`).map(function() { return $(this).val() }).get()
        let nas = $(`.nas`).map(function() { return $(this).val() }).get()

        if(Math.max.apply(Math, nas) > 100 || Math.max.apply(Math, nts) > 100){
            alert("The score must not greater than 100")
            return
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("input.nilai") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'studentId': studentId,
                'periodId': periodId,
                'subjectId': subjectId,
                'nts': nts,
                'nas': nas,
            },
            success: function(data) {
                alert(data.message)
                $('#listmurid').modal('hide')
            }
        })
    }

    const hiddenSubject = (subjectId) => {
        // $(`#subject-id`).val(subjectId)
        let periodId = $(`#selected-semester`).val()
        const detail = document.getElementById('detail')
        detail.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("detail.nilai") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'periodId': periodId,
                'subjectId': subjectId,
            },
            success: function(data) {
                data.grades.forEach((grade,index) => {
                    detail.innerHTML += `
                        <tr style="text-align: center">
                            <td>${index+1}.</td>
                            <td>${ data.students[index].name }</td>
                            <input type="hidden" class = "student-id" value = "${ data.students[index].id }">
                            <input type="hidden" id = "subject-id" value = "${subjectId}">
                            <td><input type="number" inputmode="numeric" class="form-class nts" id="nts_" max="100" min="0" value="${ grade.mid_score }"></td>
                            <td><input type="number" inputmode="numeric" class="form-class nas" id="nas_" max="100" min="0" value="${ grade.end_score }"></td>                                   
                        </tr>
                    `
                })
            }
        })
    } 
</script>
@endsection