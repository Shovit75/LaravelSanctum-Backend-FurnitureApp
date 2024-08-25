<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Furniture;
use App\Models\Category;
use App\Models\Subcategory;
use Storage;

class FurnitureController extends Controller
{
    public function index(){
        $furniture = Furniture::all();
        return view('furniture.index', compact('furniture'));
    }

    public function create(){
        $cat = Category::all();
        $subcat = Subcategory::all();
        return view('furniture.create', compact('cat','subcat'));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();    
        return response()->json(['subcategories' => $subcategories]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'featured' => 'required|boolean'
        ]);
        $furniture = new Furniture;
        $furniture -> name = $request['name'];
        $furniture -> description = $request['description'];
        $furniture -> price = $request['price'];
        $furniture -> category_id = $request['category_id'];
        $furniture -> featured = $request['featured'];
        $furniture -> subcategory_id = $request['subcategory_id'];
        $imagepath = $request->file('image')->store('furniture', 'public');
        $furniture -> image = $imagepath;
        $furniture->save();
        return redirect()->route('furniture.index');
    }

    public function edit($id)
    {
        $cat = Category::all();
        $furniture = Furniture::find($id);
        $savedcategory_id = $furniture->category_id;
        $savedsubcat_id = $furniture->subcategory_id;
        $subcat = Subcategory::where('category_id', $savedcategory_id)->get();
        return view('Furniture.edit', compact('furniture','cat','subcat','savedcategory_id','savedsubcat_id'));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'featured' => 'required|boolean'
        ]);
        $furniture = Furniture::find($id);
        $furniture -> name = $request['name'];
        $furniture -> description = $request['description'];
        $furniture -> price = $request['price'];
        $furniture -> category_id = $request['category_id'];
        $furniture -> subcategory_id = $request['subcategory_id'];
        $furniture -> featured = $request['featured'];
        if($request['image']){
            if ($furniture->image) {
                Storage::disk('public')->delete($furniture->image);
            }
            $imagepath = $request->file('image')->store('furniture', 'public');
            $furniture -> image = $imagepath;
        }
        $furniture->save();
        return redirect()->route('furniture.index');
    }

    public function delete($id){
        $furniture = Furniture::find($id);
        if ($furniture->image) {
            Storage::disk('public')->delete($furniture->image);
        }
        $furniture->delete();
        return redirect()->route('furniture.index');
    }
}
