<?php
    $username = $_GET['']
?>

<table class="table" >
    <thead class="table-dark" style="text-align: center">
        <tr>
            <th width="5%">No.</th>
            <th>Mata Pelajaran</th>
            <th width="10%">NTS</th>
            <th width="10%">NAS</th>
            <th width="10%">NA</th>
            <th>Predikat</th>
        </tr>
    </thead>
    <tbody style="text-align: center" id="grades">

    </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
{{-- <script>
    const  = () => {

        const table = document.getElementById('grades')
        table.innerHTML = ''

        $.ajax({
            type: 'POST',
            url: '{{ route("exportpdf") }}',
            data: {
                '_token': ',
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
            }
        })
    }
</script> --}}