<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus=Menu::all();
        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $parents = Menu::where('parent_id', '=', null)->get(); // atau filter sesuai kebutuhan

        return view('menu.create', compact('roles', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'name' => 'required|string',
            'icon' => 'nullable|string',
            'url' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $menu = Menu::create($validate);

        if ($request->roles) {
            $menu->roles()->attach($request->roles);
        }

        Alert::success('Success', 'Create Menu Success!');
        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $menu = Menu::findOrFail($id);
    $roles = Role::all();
    $parents = Menu::whereNull('parent_id')
        ->where('id', '!=', $menu->id)
        ->get();

    $menuRoles = $menu->roles->pluck('id')->toArray();

    return view('menu.edit', compact('menu', 'roles', 'parents', 'menuRoles'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu=Menu::find($id);
         $validate = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'name' => 'required|string',
            'icon' => 'nullable|string',
            'url' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);
        $menu->update($validate);
        $menu->roles()->sync($request->roles);
         Alert::success('Success', 'Create Menu Success!');
        return redirect()->route('menu.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $menu=Menu::find($id);
      $menu->delete();

       Alert::success('Delete', 'Delete Menu Success!');
        return redirect()->route('menu.index');
    }
}
