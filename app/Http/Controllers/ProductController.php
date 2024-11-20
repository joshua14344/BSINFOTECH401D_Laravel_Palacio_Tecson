<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',['products'=>$products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
{
    // Validate the data
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required|mimes:jpeg,png,gif,jpg,svg,webp,avif|max:10000'
    ]);
    
    // Upload image file
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('products'), $imageName);

    // Create new product and save it
    $product = new Product();
    $product->image = $imageName;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->save();

    // Redirect to the index page with a success message
    return redirect()->route('products.index')->withSuccess('Product Added Successfully!');
}


    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
{
    // Validate data
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'nullable|mimes:jpeg,png,gif,jpg,svg,webp|max:10000'
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id); // It's better to use findOrFail to avoid null values

    // Check if the user uploaded an image
    if ($request->hasFile('image')) {
        // Upload image file
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        // Update the product image
        $product->image = $imageName;
    }

    // Update the product's name and description
    $product->name = $request->name;
    $product->description = $request->description;

    // Save the updated product
    $product->save();

    // Redirect to the main index page (products.index) with a success message
    return redirect()->route('products.index')->withSuccess('Product Updated Successfully!');
}

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return back()->withSuccess('Product Deleted Successfully!');
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return view('products.show',['product' => $product]);
    }
}
