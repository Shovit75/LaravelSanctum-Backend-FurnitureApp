<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    public function index(){
        $checkout = Checkout::all();
        return view('checkout.index', compact('checkout'));
    }

    public function delete($id){
        $checkout = Checkout::find($id);
        $checkout->delete();
        return redirect()->route('checkout.index');
    }
}
