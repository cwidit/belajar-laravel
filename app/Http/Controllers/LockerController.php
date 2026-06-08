<?php

namespace App\Http\Controllers;
use App\Models\Locker;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Locker Management';
        $lockers = Locker::all();
        return view('locker.index', compact('title', 'lockers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Locker';
        return view('locker.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  $request->validate([
        //     'locker_name' => 'required|unique:lockers,locker_name',
        //     'batch' => 'required|in:1,2,3,4',
        //     'major_name' => 'required|in:Web Programming,Multimedia,Content Creator,Teknisi Jaringan',
        //     'status' => 'required|in:Available,Unavailable,Damaged,Missing',
        // ]);

        Locker::create([
            'locker_name' => $request->locker_name,
            'batch' => $request->batch,
            'major_name' => $request->major_name,
            'status' => $request->status,
        ]);

        Alert::success('Success!!', 'Create Locker Success');
        return redirect()->to('locker');
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
        $title = "Edit locker";
        $locker= Locker::find($id);
        return view('locker.edit', compact('title', 'locker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'locker_name' => 'required|'.Rule::unique("lockers","locker_name")->ignore($id),
            'batch' => 'required|in:1,2,3,4',
            'major_name' => 'required|in:Web programming,Multimedia,Content Creator,Teknisi Jaringan',
            'status' => 'required|in:Available,Unavailable,Damaged,Missing',
        ]);
        $data = Locker::find($id);
        $data ->update(
            $request->all()
        );
        Alert::success('Success', 'Update Data Success');
        return redirect()->route('locker.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Locker::find($id)->delete();
        Alert::success('Delete', 'Delete Data Success!');
        return redirect()->route('locker.index');
    }
}
