<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Storage;

class CategoryController extends Controller
{
    public function index(){
        $cat = Category::all();
        return view('category.index', compact('cat'));
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $cat = new Category;
        $cat -> name = $request['name'];
        $imagepath = $request->file('image')->store('categories', 'public');
        $cat -> image = $imagepath;
        $cat->save();
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $cat = Category::find($id);
        return view('category.edit', compact('cat'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $cat = Category::find($id);
        $cat -> name = $request['name'];
        if($request['image']){
            if ($cat->image) {
                Storage::disk('public')->delete($cat->image);
            }
            $imagepath = $request->file('image')->store('categories', 'public');
            $cat -> image = $imagepath;
        }
        $cat->save();
        return redirect()->route('category.index');
    }

    public function delete($id){
        $cat = Category::find($id);
        if ($cat->image) {
            Storage::disk('public')->delete($cat->image);
        }
        $cat->delete();
        return redirect()->route('category.index');
    }

}
