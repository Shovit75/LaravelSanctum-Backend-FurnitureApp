<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'roles' => 'required|exists:roles,name'
        ]);
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        if ($request->has('roles')){ 
            $user->assignRole($request->roles);
        }
        return redirect()->route('users.index');
    }

    public function edit($id){
        $users = User::find($id);
        $roles = Role::all();
        $selectedrole = $users->roles->pluck('id')->toArray();
        return view('users.edit', compact('users','roles','selectedrole'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'roles' => 'required|exists:roles,name'
        ]);
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        if ($request->has('roles')){ 
            $user->syncRoles($request->roles);
        }
        return redirect()->route('users.index');
    }

    public function delete($id){
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }

}
