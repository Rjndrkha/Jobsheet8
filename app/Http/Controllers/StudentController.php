<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use App\Models\CourseModel;
use App\Models\CourseStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Collection\paginate;
use Illuminate\Support\Collection\collapse;
use DB;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $search = request()->query('search');
        if($search){
        $student = Student::with('class')
                ->where('name','like',"%".$search."%")
                ->orderBy('id_student', 'asc')
                ->paginate();
        }
        else{
        $student = Student::with('class')
                ->orderBy('id_student', 'asc')
                ->paginate(3);
        }
        return view('student.index', ['student' => $student]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = ClassModel::all();
        return view('student.create', ['class' => $class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO : Implementasikan Proses Simpan Ke Database
        // return "Proses Simpan ke database";

        $request->validate([
            'Nim' => 'required',
            'Name' => 'required',
            'class' => 'required',
            'Major' => 'required',
            'Photo' => 'required',
            
        ]);

        $student = new Student;
        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        $student->major = $request->get('Major');
        
        $student = new Student2;
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }
        Student2::create([
            
            'photo' => $image_name,
        ]);

        $class = new ClassModel;
        $class->id = $request->get('class');
        
        $student->class()->associate($class);
        $student->save();


        return redirect()->route('student.index')
            ->with('success', 'Student Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $Student = Student::with('class')->where('Nim', $nim)->first();
        return view('student.detail', ['Student' => $Student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        $Student = student::with('class')->where('nim', $nim)->first();
        $class = ClassModel::all();
        return view('student.edit', compact('Student', 'class'));
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
            'class' => 'required',
            'Major' => 'required',
            'image' => 'required',
            
        ]);

        $student = new Student;
        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        $student->major = $request->get('Major');
        
        $image_name = new Student;
        if ($student->photo && file_exists(storage_path('app/public/' . $student->photo))) {
            Storage::delete('public/' . $student->photo);
        }
        $image_name = $request->file('image')->store('images', 'public');
        $student->photo = $image_name;


        $class = new ClassModel;
        $class->id = $request->get('class');

        $student->class()->associate($class);
        $student->save();


        return redirect()->route('student.index')
            ->with('success', 'Student Berhasil Ditambahkan');
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
            ->with('success', 'Student Successfully Deleted');
    }

    public function search(Request $request)
    {

        $student = Student::when($request->keyword, function ($query) use ($request) {

            $query->where('name', 'like', "%{$request->keyword}%")

                ->orWhere('nim', 'like', "%{$request->keyword}%")

                ->orWhere('class', 'like', "%{$request->keyword}%")

                ->orWhere('major', 'like', "%{$request->keyword}%");
        })->paginate(5);

        $student->appends($request->only('keyword'));
        return view('student.index', compact('student'));
    }
}
