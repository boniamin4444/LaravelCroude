<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;


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

	public function applyCoupon(Request $request)
	{
		//Validated controller
		$request->validate([
			'coupon_code' => 'required|string',
		]);

		//fetch coupon

		$coupon = Coupon::where('coupon_code', $request->coupon_code)
		    ->where('status', 'active')
		    ->where('expire_date', '>=', Carbon::now())
		    ->first();

		if(!$coupon)
		{
			return back()->with('error','Invalid or Expired Coupon');

		}

		$cartItems = session()->get('cart',[]);
		$subtotal = array_reduce( $cartItems, function($sum, $item){

			return $sum + ($item['price'] * $item['quantity']);
		},0);

		$subtotal = ($subtotal * $coupon->value) /100;
		session()->put('discount', $discount);

		return back()->with('success','Coupon applied successfully');
	}

	public function Placeholder()
	{
		session()->forget('cart');
		session()->forget('discount');
		return redirect()->route('cart.view')->with('success','order place successfully');
	}
}
