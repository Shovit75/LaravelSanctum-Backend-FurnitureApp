<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create(){
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'permissions' => 'required'
        ]);
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }

    public function edit($id){
        $permissions = Permission::all();
        $roles = Role::find($id);
        $selectedpermissions = $roles->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('roles','permissions','selectedpermissions'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'permissions' => 'required'
        ]);
        $role = Role::findOrFail($id);
        $role -> name = $request->input('name');
        $role -> guard_name = $request->input('guard_name');
        $role -> save();
        $role -> syncPermissions($request->input('permissions'));
        return redirect()->route('roles.index');
    }

    public function delete($id){
        $roles = Role::find($id);
        $roles->permissions()->detach();
        $roles -> delete();
        return redirect()->route('roles.index');
    }
}
