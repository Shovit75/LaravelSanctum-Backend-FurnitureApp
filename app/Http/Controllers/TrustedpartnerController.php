<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trustedpartner;
use Storage;

class TrustedpartnerController extends Controller
{
    public function index(){
        $trusted = Trustedpartner::all();
        return view('trustedpartners.index', compact('trusted'));
    }

    public function create(){
        return view('trustedpartners.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $trusted = new Trustedpartner;
        $trusted -> name = $request['name'];
        $imagepath = $request->file('image')->store('trustedpartners', 'public');
        $trusted -> image = $imagepath;
        $trusted->save();
        return redirect()->route('trustedpartners.index');
    }

    public function edit($id)
    {
        $trusted = Trustedpartner::find($id);
        return view('trustedpartners.edit', compact('trusted'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $trusted = Trustedpartner::find($id);
        $trusted -> name = $request['name'];
        if($request['image']){
            if ($trusted->image) {
                Storage::disk('public')->delete($trusted->image);
            }
            $imagepath = $request->file('image')->store('trustedpartners', 'public');
            $trusted -> image = $imagepath;
        }
        $trusted->save();
        return redirect()->route('trustedpartners.index');
    }

    public function delete($id){
        $trusted = Trustedpartner::find($id);
        if ($trusted->image) {
            Storage::disk('public')->delete($trusted->image);
        }
        $trusted->delete();
        return redirect()->route('trustedpartners.index');
    }
}
