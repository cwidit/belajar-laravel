<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class MajorController extends Controller
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
        $majors = Major::orderByDesc('id')->get();
        $title = "Major Management";
        return view('major.index', compact('majors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Najor";
        return view('major.create', compact ('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert into user () value ()
        $validate = $request->validate([
            'name'=>'required',
            'is_active'=>'required'
        ]);

        Major::create($request->all());
        Alert::success('Success!!', 'Create Major Success');
        return redirect()->to('major');
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
        $title = "Edit Major";
        $edit = Major::find($id); //blank
        //$edit = User::findOrFail($id); 404
        return view('major.edit', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =[
            'name'=>$request->name,
            'is_active'=>$request->is_active,
        ];
        //jika user memasukkan password

        Major::find($id)->update($data);
        return redirect()->to('major');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Major::find($id)->delete();
        return redirect()->to('major');
    }
}
