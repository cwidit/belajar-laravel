<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;


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
        $instructors = Instructor::with(['major', 'user'])->orderByDesc('id')->get();
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
    $request->validate([
        'major_id' => 'required',
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'phone' => 'nullable',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Instructor::create([
        'major_id' => $request->major_id,
        'name' => $request->name,
        'phone' => $request->phone,
        'user_id' => $user->id,
    ]);

    Alert::success('Success!!', 'Create instructor Success');

    return redirect()->route('instructor.index');
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
   public function destroy(Instructor $instructor)
{
    try {
        $instructor->user()->delete(); // hapus user
        $instructor->delete();         // hapus instructor

        Alert::success('Success!', 'Delete instructor success');
        return redirect()->route('instructor.index');
    } catch (\Throwable $th) {
        Alert::error('Fail!!', $th->getMessage());
        return back();
    }
}
}
