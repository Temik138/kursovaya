<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $categoryIds = $request->input('categories', []);
        $brands = $request->input('brands', []);
        $minPrice = $request->input('min_price', 1290); 
        $maxPrice = $request->input('max_price', 12000); 

        $products = Product::query()
            ->with('category') 
            ->whereBetween('price', [$minPrice, $maxPrice]); 

        if (!empty($categoryIds)) {
            $products->whereIn('category_id', $categoryIds);
        }

        if (!empty($brands)) {
            $products->whereIn('brand', $brands);
        }

        $products = $products->get(); 
        
        $allCategories = Category::all();

        return view('catalog', compact(
            'products',
            'allCategories',
            'categoryIds',
            'brands',
            'minPrice',
            'maxPrice'
        ));
    }
}