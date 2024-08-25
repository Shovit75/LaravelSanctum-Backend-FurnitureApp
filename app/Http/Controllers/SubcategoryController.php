<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Storage;

class SubcategoryController extends Controller
{
    public function index(){
        $subcat = Subcategory::all();
        return view('subcategory.index', compact('subcat'));
    }

    public function create(){
        $cat = Category::all();
        return view('subcategory.create', compact('cat'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required'
        ]);
        $subcat = new Subcategory;
        $subcat -> name = $request['name'];
        $subcat -> category_id = $request['category_id'];
        $imagepath = $request->file('image')->store('subcategories', 'public');
        $subcat -> image = $imagepath;
        $subcat->save();
        return redirect()->route('subcategory.index');
    }

    public function edit($id)
    {
        $subcat = Subcategory::find($id);
        $cat = Category::all();
        $savedcategory_id = $subcat->category_id;
        return view('subcategory.edit', compact('subcat','cat','savedcategory_id'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required'
        ]);
        $subcat = Subcategory::find($id);
        $subcat -> name = $request['name'];
        $subcat -> category_id = $request['category_id'];
        if($request['image']){
            if ($subcat->image) {
                Storage::disk('public')->delete($subcat->image);
            }
            $imagepath = $request->file('image')->store('subcategories', 'public');
            $subcat -> image = $imagepath;
        }
        $subcat->save();
        return redirect()->route('subcategory.index');
    }

    public function delete($id){
        $subcat = Subcategory::find($id);
        if ($subcat->image) {
            Storage::disk('public')->delete($subcat->image);
        }
        $subcat->delete();
        return redirect()->route('subcategory.index');
    }
}
