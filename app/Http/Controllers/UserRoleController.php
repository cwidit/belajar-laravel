<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userRoles = USerRole::with('user', 'role')->orderByDesc('id')->get(); //manggil objek misal nama dan role nya apa base on id
        $title = "User Role Management";
        return view('user-role.index', compact('userRoles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $roles = Role::get();
        $title = "Create New User Role";
        return view('user-role.create', compact ('title','users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert into user () value ()
        $validate = $request->validate([
            'user_id'=>'required',
            'role_id'=>'required'
        ]);

        UserRole::create($request->all());
        Alert::success('Success!!', 'Create User Role Success');
        return redirect()->to('user-role');
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
