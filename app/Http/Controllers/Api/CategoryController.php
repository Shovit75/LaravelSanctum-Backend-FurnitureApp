<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Furniture;
use App\Models\Category;
use Storage;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return response()->json([
            'message' => 'All categories are successfully provided in the data',
            'data' => $category
        ]);
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $category = new Category;
        $category -> name = $request['name'];
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->store('category', 'public');
            $category -> image = $imagepath;
        }
        $category->save();
        return response()->json([
            'message' => 'category created successfully',
            'data' => $category
        ],201);
    }

    public function show($id){
        $category = Category::findOrFail($id);
        $furnitures = Furniture::where('category_id', $category->id)->get();
        return response()->json([
            'message' => 'Category shown in data.',
            'data' => $category,
            'furnitures assigned' => $furnitures
        ],200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $category = Category::findOrFail($id);
        $oldImagePath = $category->image;
        if($category){
            $category -> name = $request['name'];
            if ($request->hasFile('image')) {
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $imagepath = $request->file('image')->store('category', 'public');
                $category -> image = $imagepath;
            } else {
                $category -> image = $oldImagePath;
            }
            $category->save();
            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $category
            ],200);
        }
        return response()->json([
            'message' => 'Category not found.',
            'data' => $category
        ],404);
    }
    
    public function destroy($id){
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully',
        ],200);
    }

    public function getfurniturefromcat($name){
        $category = Category::where('name', $name)->first();
        if($category){
            $furnitures = Furniture::where('category_id', $category->id)->get();
            return response()->json([
                'message' => 'Furnitures of the cat in data',
                'data' => $furnitures,
            ],200);
        }
        return response()->json([
            'message' => 'No Category Found',
        ],404);
    }
}