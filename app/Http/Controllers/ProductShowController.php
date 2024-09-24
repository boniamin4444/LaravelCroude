<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductShowController extends Controller
{
    public function show()
{
    // Retrieve the product by ID
    $products = Product::with('category')->paginate(5);

    // Return a view to display the product details
    return view('welcome', compact('products'));
}

}
