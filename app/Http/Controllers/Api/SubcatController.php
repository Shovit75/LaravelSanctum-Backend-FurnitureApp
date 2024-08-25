<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Furniture;
use App\Models\Subcategory;
use Storage;

class SubcatController extends Controller
{
    public function index(){
        $subcat = Subcategory::all();
        return response()->json([
            'message' => 'All categories are successfully provided in the data',
            'data' => $subcat
        ]);
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $subcat = new Subcategory;
        $subcat -> name = $request['name'];
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->store('subcategory', 'public');
            $subcat -> image = $imagepath;
        }
        $subcat->save();
        return response()->json([
            'message' => 'Subcategory created successfully',
            'data' => $subcat
        ],201);
    }

    public function show($id){
        $subcat = Subcategory::findOrFail($id);
        $furnitures = Furniture::where('subcategory_id', $subcat->id)->get();
        return response()->json([
            'message' => 'Subcategory shown in data.',
            'data' => $subcat,
            'furnitures assigned' => $furnitures
        ],200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $subcat = Subcategory::findOrFail($id);
        $oldImagePath = $subcat->image;
        if($subcat){
            $subcat -> name = $request['name'];
            if ($request->hasFile('image')) {
                if ($subcat->image) {
                    Storage::disk('public')->delete($subcat->image);
                }
                $imagepath = $request->file('image')->store('subcategory', 'public');
                $subcat -> image = $imagepath;
            } else {
                $subcat -> image = $oldImagePath;
            }
            $subcat->save();
            return response()->json([
                'message' => 'Subcategory updated successfully',
                'data' => $subcat
            ],200);
        }
        return response()->json([
            'message' => 'Subcategory not found.',
            'data' => $subcat
        ],404);
    }
    
    public function destroy($id){
        $subcat = Subcategory::findOrFail($id);
        if ($subcat->image) {
            Storage::disk('public')->delete($subcat->image);
        }
        $subcat->delete();
        return response()->json([
            'message' => 'Subcategory deleted successfully',
        ],200);
    }

    public function getfurniturefromsubcat($id){
        $subcategory = Subcategory::findOrFail($id);
        $subname = $subcategory->name;
        $furnitures = Furniture::where('subcategory_id', $subcategory->id)->get();
        if($subcategory){
            return response()->json([
                'message' => 'Furnitures of the subcat in data',
                'name' => $subname,
                'data' => $furnitures,
            ],200);
        }
        return response()->json([
            'message' => 'No Subcategory Found',
        ],404);
    }
}