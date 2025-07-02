<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
     public function index(Request $request)
    {
        // Получаем все категории из базы данных
        $allCategories = Category::all();

        // Логика для фильтрации продуктов (которая у вас, вероятно, уже есть)
        $query = Product::query();

        // Фильтрация по категориям
        $categoryIds = $request->input('categories', []);
        if (!empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }

        // Фильтрация по брендам (предполагаем, что бренд хранится в поле 'brand' продукта)
        $brands = $request->input('brands', []);
        if (!empty($brands)) {
            $query->whereIn('brand', $brands);
        }

        // Фильтрация по цене
        $minPrice = $request->input('min_price', 1290); // Дефолтные значения из вашего шаблона
        $maxPrice = $request->input('max_price', 12000);
        $query->whereBetween('price', [$minPrice, $maxPrice]);

        $products = $query->get();

        // Определяем текущие значения фильтров для сохранения состояния чекбоксов/полей
        $selectedCategoryIds = $request->input('categories', []);
        $selectedBrands = $request->input('brands', []);


        return view('catalog', [ // Убедитесь, что это правильное имя вашего Blade-файла
            'allCategories' => $allCategories, // Передаем все категории
            'products' => $products,
            'categoryIds' => $selectedCategoryIds, // Передаем выбранные ID категорий
            'brands' => $selectedBrands,       // Передаем выбранные бренды
            'minPrice' => $minPrice,           // Передаем текущее мин. значение цены
            'maxPrice' => $maxPrice,           // Передаем текущее макс. значение цены
            // ... другие переменные, если есть
        ]);
    }
}