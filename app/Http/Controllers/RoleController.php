<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class RoleController extends Controller
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
        $roles = Role::orderByDesc('id')->get();
        $title = "Role Management";
        return view('role.index', compact('roles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Role";
        return view('role.create', compact ('title'));
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

        Role::create($request->all());
        Alert::success('Success!!', 'Create role success');
        return redirect()->to('role');
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
        $title = "Edit Role";
        $edit = Role::find($id); //blank
        //$edit = User::findOrFail($id); 404
        return view('role.edit', compact('title', 'edit'));
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

        Role::find($id)->update($data);
        return redirect()->to('role');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::find($id)->delete();
        return redirect()->to('role');
    }
}
