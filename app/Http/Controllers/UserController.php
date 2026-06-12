<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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
        $users = User::orderByDesc('id')->get();
        $title = 'User Management';

        $deleteTitle='Hapus User!';
        $deleteText="Do you sure delete this user??";
        confirmDelete($deleteTitle, $deleteText);


        return view('user.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create New User';
        $roles = Role::get();
        return view('user.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //insert into user () value ()
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $user->roles()->sync($request->role_ids); //agar user bisa lebih dari satu rolenya

            DB::commit();
            Alert::success('Success!!', 'Create user success');
            return redirect()->to('user');
        } catch (\Throwable $th) {
            return $th->getMessage();
            DB::rollBack();
            Alert::error('Fail!!', 'An error acurred while saving the user');
            return back()->withInput();
        }
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
        $title = 'Edit User';
        $edit = User::find($id); //blank
        $roles = Role::get();
        //$edit = User::findOrFail($id); 404
        return view('user.edit', compact('title', 'edit', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            //jika user memasukkan password
            if (filled($request->password)) {
                $data['password'] = $request->password;
            }

            $user = User::find($id);
            $user->update($data);
            $user->roles()->sync($request->role_ids);
            DB::commit();
            Alert::success('Succes', 'Data Update');
            return redirect()->to('user');
        } catch (\Throwable $th) {
            return $th->getMessage();
            DB::rollBack();
            Alert::error('Fail!!', 'Update Failed');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Delete', 'Success Delete User!!');
        return redirect()->to('user');
    }
}
