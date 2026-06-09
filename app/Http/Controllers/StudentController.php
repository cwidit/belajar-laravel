<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Major;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // kalau pakai select * from users
        //$users = User::orderBy('id', 'desc')->get();
        // kalau pakai latest (desc) dan oldest (asc) maka
        //$users = User::latest()->get();
        $students = Student::with('major')->orderByDesc('id')->get();
        $title = "Student Management";
        return view('student.index', compact('students', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Student";
        $majors= Major::get();
        return view('student.create', compact('title', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert into user () value ()
        $validate = $request->validate([

        'major_id'=>'required',
        'name'=>'required',
        'phone'=>'nullable'
        ]);

        Student::create($request->all());
        Alert::success('Success!!', 'Create Student Success');
        return redirect()->to('student');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Student";
        $edit = Student::find($id); //blank
        $majors = Major::get();
        //$edit = User::findOrFail($id); 404
        return view('student.edit', compact('title', 'edit', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =[
            'major_id'=>$request->major_id,
            'name'=>$request->name,
            'is_active'=>$request->is_active,
        ];
        //jika user memasukkan password

        Student::find($id)->update($data);
        Alert::success('Success', "Update Student Success");
        return redirect()->to('student');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::find($id)->delete();
        Alert::success('Success!', 'Delete student success');
        return redirect()->to('student');
    }
}
