<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductCrudController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
   public function create()
{
    $categories = Category::all();
    $availableSizes = config('products.available_sizes'); // <-- Получаем размеры из конфига
    return view('admin.products.create', compact('categories', 'availableSizes')); // <-- Передаем availableSizes
}

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'in_stock' => 'required|boolean',
        'brand' => 'nullable|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'size' => 'nullable|array', 
        'size.*' => 'string|max:255|in:' . implode(',', config('products.available_sizes')),
    ]);

     $data = $request->except('image');
    $data['slug'] = Str::slug($request->name);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('images', 'public');
    }

   
    if (!isset($data['size'])) {
        $data['size'] = null; 
    }

    Product::create($data);

    return redirect()->route('admin.products.index')->with('success', 'Товар успешно добавлен!');
}
    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
{
    $categories = Category::all();
    $availableSizes = config('products.available_sizes'); // <-- Получаем размеры из конфига
    return view('admin.products.edit', compact('product', 'categories', 'availableSizes')); // <-- Передаем availableSizes
}

    /**
     * Update the specified product in storage.
     */
   // ... (начало контроллера) ...

public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'in_stock' => 'required|boolean',
        'brand' => 'nullable|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        // Валидация для массива размеров
        'size' => 'nullable|array',
        'size.*' => 'string|max:255|in:' . implode(',', config('products.available_sizes')),
    ]);

     $data = $request->except('image');
    $data['slug'] = Str::slug($request->name);

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::delete('public/' . $product->image); 
        }
        $data['image'] = $request->file('image')->store('images', 'public');
    } else {
        $data['image'] = $product->image;
    }

    if (!isset($data['size'])) {
        $data['size'] = null; 
    }

    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', 'Товар успешно обновлен!');
}

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
        Storage::delete('public/' . $product->image);
    }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно удален!');
    }
}