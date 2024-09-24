<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{

    public function index()
    {
        // Fetch all products with their associated category and paginate them
        $products = Product::with('category')->paginate(5);
        return view('products.index', compact('products'));
    }


    public function create()
    {
        // Fetch all categories to display in the form
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
       

    
    $validatedData = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'product_name' => 'required|string|max:255',
        'details' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'required|in:active,inactive',
    ]);

    // Handle the image upload
    if ($request->hasFile('image')) 
    {
        $imagePath = $request->file('image')->store('products', 'public');
        $validatedData['image'] = $imagePath;
    }


    Product::create($validatedData);
   
    return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    
    public function edit($encryptedId)
    {
       
        $id = Crypt::decrypt($encryptedId);
        $product = Product::findOrFail($id);      
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    
    public function update(Request $request, $encryptedId)
    {
        
        $id = Crypt::decrypt($encryptedId);
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

       
        $product = Product::findOrFail($id);

      
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

       
        $product->update($validatedData);

      
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    
    public function destroy($id)
    {
       
        $product = Product::findOrFail($id);
        $product->delete();
      
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
?>
