<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class InstructorController extends Controller
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
        $instructors = Instructor::with('major')->orderByDesc('id')->get();
        $title = "Instructor Management";
        return view('instructor.index', compact('instructors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Instructor";
        $majors= Major::get();
        return view('instructor.create', compact('title', 'majors'));
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

        Instructor::create($request->all());
        Alert::success('Success!!', 'Create instructor Success');
        return redirect()->to('instructor');
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
        $title = "Edit Instructor";
        $edit = Instructor::with('user')->find($id); //blank
        $majors = Major::get();
        //$edit = User::findOrFail($id); 404
        return view('instructor.edit', compact('title', 'edit', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id, Instructor $instructor)
    {
        DB::beginTransaction();

        try {
            $dataUser =[
            'name'=>$request->name,
            'email'=>$request->email,
            ];
            $user = $instructor->user;
            //jika user ingin mengganti password
            if($request->filled('password')) {
                $dataUser['password']= $request->password;
            }

            $user->update($dataUser);

            $data =[
            'major_id'=>$request->major_id,
            'name'=>$request->name,
            'phone'=>$request->phone,
            ];

            $instructor->update($data);
            DB::commit();
            Alert::success('Success', "Update Isntructor Success");
            return redirect()->to('instructor');
            } catch (\Throwable $th) {
                DB::rollBack();
                return $th->getMessage();
                AllertLog::error('Fail!!', $th->getMessage());
                return back()->withInput();
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor) //ditambahin instructor disini kalau misal ada 2 id yg mau dihapus
    {
        try {
            $instructor->user()->delete();
            Alert::success('Success!', 'Delete instructor success');
            return redirect()->to('instructor');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Fail!!', $th->getMessage());
            return back();
    }
}
}
