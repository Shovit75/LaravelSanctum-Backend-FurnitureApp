<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trustedpartner;
use Storage;

class TrustedController extends Controller
{
    public function index(){
        $trusted = Trustedpartner::all();
        return response()->json([
            'message' => 'All trusted partners are successfully provided in the data',
            'data' => $trusted
        ]);
    }

    public function show($id){
        $trusted = Trustedpartner::findOrFail($id);
        return response()->json([
            'message' => 'Trusted partners shown in data.',
            'data' => $trusted,
        ],200);
    }
    
}