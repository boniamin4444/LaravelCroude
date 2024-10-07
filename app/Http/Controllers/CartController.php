<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function viewCart()
    {
    	$cart = session()->get('cart',[]);
    	return view('cart.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
    	$productId = $request->input('product_id');
    	$product = Product::find($productId);

    	$cart = session()->get('cart',[]);

    	if(isset($cart[$productId]))
    	{
    		$cart[$productId]['quantity']++;
    	}

    	else
    	{
    		$cart[$productId]  = [

    			"name" => $product->product_name,
    			"quantity"=> 1,
    			"price" => $product->price
    		];
    	}


    	session()->put('cart',$cart);
    	return response()->json(['status'=>'Product added to the cart!']);
    }

    public function removeFromCart(Request $request)
    {
    	$cart = session()->get('cart');

    	if(isset($cart[$request->product_id]))
    	{
    		unset($cart[$request->product_id]);
    		session()->put('cart', $cart);
    		return response()->json(['status'=>'Product removed successfully']);
    	}

    	return response()->json(['status'=>'Product not found in the cart'], 404);
    }

    public function clearCart()
    {
    	session()->forget('cart');
    	return redirect()->back()->with('success','Cart cleared successfully');
    }
}
