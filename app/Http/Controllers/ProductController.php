<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'Created';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:Created,Synced,Failed',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        } else {
            $validated['image_url'] = $product->image_url;
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return Inertia::render('Products/Show', [
            'product' => $product
        ]);
    }
}
