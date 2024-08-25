<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webuser;
use Hash;

class WebuserController extends Controller
{
    public function index()
    {
        $webuser = Webuser::all();
        return view('webusers.index', compact('webuser'));
    }

    public function create(){
        return view('webusers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
        $webuser = new Webuser;
        $webuser->name = $request['name'];
        $webuser->email = $request['email'];
        $webuser->password = Hash::make($request['password']);
        $webuser->save();
        return redirect()->route('webusers.index');
    }

    public function edit($id){
        $webuser = Webuser::find($id);
        return view('webusers.edit', compact('webuser'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
        $webuser = Webuser::find($id);
        $webuser->name = $request['name'];
        $webuser->email = $request['email'];
        $webuser->password = Hash::make($request['password']);
        $webuser->save();
        return redirect()->route('webusers.index');
    }

    public function delete($id){
        $webuser = Webuser::find($id);
        $webuser -> delete();
        return redirect()->route('webusers.index');
    }
}
