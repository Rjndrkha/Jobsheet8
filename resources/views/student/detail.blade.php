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

                <h1>KARTU HASIL STUDI (KHS)</h1>
            </center>
            <div>
                <div class="row">
                    <div style="margin:0px 0px 0px 70px;">
                        <a class="btn btn-success" href="#">Print PDF</a>
                    </div>
                </div>
                <br>
                <ul class="list-group list-group-flush">

                    <p><b>Nim: </b>{{$Student->nim}}</p>
                    <p><b>Name: </b>{{$Student->name}}</p>
                    <p><b>Class: </b>{{$Student->class->class_name}}</p>
                </ul>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>Course Name</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Score</th>
                </tr>

                






            </table>
            <a class="btn btn-success mt-3" href="{{ route('student.index') }}">Back</a>
        </div>
    </div>
</div>
@endsection