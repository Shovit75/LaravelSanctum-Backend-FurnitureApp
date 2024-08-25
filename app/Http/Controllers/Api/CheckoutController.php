<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use Auth;
use Storage;

class CheckoutController extends Controller
{
    public function index(){
        $checkout = Checkout::all();
        return response()->json([
            'message' => 'All checkouts provided in the data',
            'data' => $checkout
        ]);
    }
    
    public function store(Request $request){
        $request->validate([
            'webuser_id' => 'required|exists:webusers,id',
            'items' => 'required|array',
            'total' => 'required|numeric|min:0',
        ]);
        $checkout = new Checkout;
        $checkout -> webuser_id = $request['webuser_id'];
        $checkout -> total = $request['total'];
        $checkout -> items = $request['items'];
        $checkout->save();
        return response()->json([
            'message' => 'checkout created successfully',
            'data' => $checkout
        ],201);
    }

    public function show($id){
        $checkout = Checkout::findOrFail($id);
        return response()->json([
            'message' => 'checkout shown in data.',
            'data' => $checkout
        ],200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'webuser_id' => 'required|exists:webusers,id',
            'items' => 'required|array',
            'total' => 'required|numeric|min:0',
        ]);
        $checkout = Checkout::findOrFail($id);
        if($checkout){
            $checkout -> webuser_id = $request['webuser_id'];
            $checkout -> total = $request['total'];
            $checkout -> items = $request['items'];
            $checkout->save();
            return response()->json([
                'message' => 'checkout updated successfully',
                'data' => $checkout
            ],200);
        }
        return response()->json([
            'message' => 'checkout not found.',
            'data' => $checkout
        ],404);
    }
    
    public function destroy($id){
        $checkout = Checkout::findOrFail($id);
        $checkout->delete();
        return response()->json([
            'message' => 'checkout deleted successfully',
        ],200);
    }
}