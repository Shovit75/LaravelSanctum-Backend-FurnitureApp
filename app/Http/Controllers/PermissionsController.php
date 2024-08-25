<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index(){
        $permission = Permission::all();
        return view('permissions.index', compact('permission'));
    }

    public function create(){
        return view('permissions.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
        ]);
        $permission = new Permission;
        $permission -> name = $request['name'];
        $permission -> guard_name = $request['guard_name'];
        $permission->save();
        return redirect()->route('permissions.index');
    }

    public function edit($id){
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
        ]);
        $permission = Permission::find($id);
        $permission -> name = $request['name'];
        $permission -> guard_name = $request['guard_name'];
        $permission->save();
        return redirect()->route('permissions.index');
    }

    public function delete($id){
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
