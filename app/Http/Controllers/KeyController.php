<?php

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class KeyController extends Controller
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
        $keys = Key::orderByDesc('id')->get();
        $title = "Key Management";
        return view('key.index', compact('keys', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Key";
        return view('key.create', compact ('title'));
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

        Key::create($request->all());
        Alert::success('Success!!', 'Create Key Success');
        return redirect()->to('key');
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
        $title = "Edit Key";
        $edit = Key::find($id); //blank
        //$edit = User::findOrFail($id); 404
        return view('key.edit', compact('title', 'edit'));
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

        Key::find($id)->update($data);
        return redirect()->to('key');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Key::find($id)->delete();
        return redirect()->to('key');
    }
}
