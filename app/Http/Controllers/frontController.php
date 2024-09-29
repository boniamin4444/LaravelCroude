<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class frontController extends Controller
{
    
    // Display all products and categories
    public function index()
    {
        $categories = Category::all();
        $products = Product::all(); // Initially load all active products

        return view('welcome', compact('categories', 'products'));
    }

    // Filter products by selected categories using AJAX
    public function filterProducts(Request $request)
    {
        // If categories are selected, filter products by the selected categories
        if ($request->has('categories') && !empty($request->categories)) 
        {
            $categories = $request->categories; // Get the selected categories array

            // Fetch products where category_id is in the selected categories (without status restriction)
            $products = Product::whereIn('category_id', $categories)->get();
        } 
        else 
        {
            // If no category is selected, return all products (active and inactive)
            $products = Product::all();
        }

        // Return the filtered products as JSON
        return response()->json($products);
    }
  }