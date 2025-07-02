<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryCrudController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Правила для загрузки изображения
            // Добавьте другие правила валидации, если есть другие поля
        ]);

        $data = $request->all();

        // Обработка загрузки изображения/иконки
        if ($request->hasFile('icon')) {
            // Сохраняем изображение в storage/app/public/category_icons
            // и получаем путь относительно 'public'
            $imagePath = $request->file('icon')->store('category_icons', 'public');
            $data['icon'] = $imagePath; // Сохраняем этот путь в поле 'icon'
        }

        // Если вы генерируете slug вручную
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно добавлена!');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Обработка загрузки нового изображения/иконки
        if ($request->hasFile('icon')) {
            // Удаляем старое изображение, если оно существует
            if ($category->icon) {
                \Storage::disk('public')->delete($category->icon);
            }
            $imagePath = $request->file('icon')->store('category_icons', 'public');
            $data['icon'] = $imagePath;
        }

        // Если вы генерируете slug вручную при обновлении
        if (isset($data['name']) && (!isset($data['slug']) || empty($data['slug']))) {
            $data['slug'] = Str::slug($data['name']);
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Прежде чем удалить категорию, можно рассмотреть варианты:
        // 1. Запретить удаление, если есть связанные товары.
        // 2. Установить category_id в NULL для связанных товаров (что мы уже сделали с onDelete('set null') в миграции products).
        // 3. Удалить связанные товары (обычно нежелательно).
        
        // Сейчас, благодаря onDelete('set null') в миграции products, при удалении категории
        // поле category_id у связанных товаров будет установлено в NULL.
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена!');
    }
}