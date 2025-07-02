<?php

namespace App\Http\Controllers;

use App\Models\Category; // Импортируем модель Category
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Отображает главную страницу с категориями.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получаем все категории из базы данных
        $categories = Category::all();

        // Передаем категории в представление
        return view('index', compact('categories'));
    }
}