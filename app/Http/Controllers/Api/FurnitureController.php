<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Furniture;
use Auth;
use Hash;
use Storage;

class FurnitureController extends Controller
{
    public function index(){
        $furniture = Furniture::all();
        return response()->json([
            'message' => 'All furnitures provided in the data',
            'data' => $furniture
        ]);
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'featured' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $furniture = new Furniture;
        $furniture -> category_id = $request['category_id'];
        $furniture -> subcategory_id = $request['subcategory_id'];
        $furniture -> name = $request['name'];
        $furniture -> description = $request['description'];
        $furniture -> price = $request['price'];
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->store('furniture', 'public');
            $furniture -> image = $imagepath;
        }
        $furniture -> featured = $request['featured'];
        $furniture->save();
        return response()->json([
            'message' => 'Furniture created successfully',
            'data' => $furniture
        ],201);
    }

    public function show($id){
        $furniture = Furniture::findOrFail($id);
        return response()->json([
            'message' => 'Furniture shown in data.',
            'data' => $furniture
        ],200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'featured' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $furniture = Furniture::findOrFail($id);
        $oldImagePath = $furniture->image;
        if($furniture){
            $furniture -> category_id = $request['category_id'];
            $furniture -> subcategory_id = $request['subcategory_id'];
            $furniture -> name = $request['name'];
            $furniture -> description = $request['description'];
            $furniture -> price = $request['price'];
            if ($request->hasFile('image')) {
                if ($furniture->image) {
                    Storage::disk('public')->delete($furniture->image);
                }
                $imagepath = $request->file('image')->store('furniture', 'public');
                $furniture -> image = $imagepath;
            } else {
                $furniture -> image = $oldImagePath;
            }
            $furniture -> featured = $request['featured'];
            $furniture->save();
            return response()->json([
                'message' => 'Furniture updated successfully',
                'data' => $furniture
            ],200);
        }
        return response()->json([
            'message' => 'Furniture not found.',
            'data' => $furniture
        ],404);
    }
    
    public function destroy($id){
        $furniture = Furniture::findOrFail($id);
        if ($furniture->image) {
            Storage::disk('public')->delete($furniture->image);
        }
        $furniture->delete();
        return response()->json([
            'message' => 'Furniture deleted successfully',
        ],200);
    }
}