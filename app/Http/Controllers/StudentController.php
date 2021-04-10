<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Facades\DB;
use App\Models\ClassModel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $student = Student::with('class')->get();
        $paginate = Student::orderBy('id_student','asc')->paginate(3);
        return view('student.index',['student'=>$student,'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = ClassModel::all();
        return view('student.create',['class'=> $class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Name' => 'required',
            'Class' => 'required',
            'Major' => 'required',
            'Address' => 'required',
            'DateOfBirth' => 'required',
            ]);

            Student::create($request->all());

            return redirect()->route('student.index')
                ->with('success', 'Student Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $Student = Student::find($Nim);
        return view('student.detail', compact('Student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $Student = DB::table('student')->where('nim', $Nim)->first();;
        return view('student.edit', compact('Student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Name' => 'required',
            'Class' => 'required',
            'Major' => 'required',
            'Address' => 'required',
            'DateOfBirth' => 'required',
            ]);

            Student::find($Nim)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        Student::find($Nim)->delete();
        return redirect()->route('student.index')
            -> with('success', 'Student Successfully Deleted');
    }
};
