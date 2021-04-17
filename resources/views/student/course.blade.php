@extends('student.layout')
@section('content')
<div class="container mt-5">
    <div class="pull-left mt-3">
        <center>
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </center>
    </div>
    <div class="row justify-content-center align-items-center">
        <div style="width: 80rem;">
            <center>
                <h1>KHS</h1>
            </center>
            <div>
                <ul class="list-group list-group-flush">
                @foreach ($student as $mhs)
                    <p><b>Nim: </b>{{$mhs->nim}}</p>
                    <p><b>Name: </b>{{$mhs->name}}</p>
                    <p><b>Class: </b>{{$mhs->class->class_name}}</p>
                </ul>
            </div> 
            
            <table class="table table-bordered">
                <tr>
                    <th>Course Name</th>
                    <th>Credit</th>
                    <th>Semester</th>
                    <th>Score</th>
                </tr>
                @foreach ($Student->course as $course)
                <tr>

                    <td>{{ $course ->course_name }}</td>
                    <td>{{ $course ->sks}}</td>
                    <td>{{ $course ->semester}}</td>
                    <td>{{ $course ->pivot->score }}</td>
                </tr>
                @endforeach


            </table>
            <a class="btn btn-success mt-3" href="{{ route('student.index') }}">Back</a>
        </div>
    </div>
</div>
@endsection
