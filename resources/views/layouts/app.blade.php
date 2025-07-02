<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-200">
    <div class="min-h-screen bg-gray-900">
        @include('layouts.navigation') 

        <nav class="bg-neutral-800 border-b border-neutral-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex items-center space-x-4">
                            {{-- Ссылка на админ-панель --}}
                            <a href="{{ route('index') }}" class="text-gray-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Главная
                            </a>
                            {{-- Ссылка на управление товарами --}}
                            <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Товары
                            </a>
                            {{-- Ссылка на управление категориями --}}
                            <a href="{{ route('admin.categories.index') }}" class="text-gray-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Категории
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="text-gray-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Заказы
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Если у тебя есть секция $header в твоем шаблоне, она будет здесь --}}
        @if (isset($header))
            <header class="bg-neutral-800 shadow border-b border-neutral-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-100">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="py-6"> 
            @yield('content')
        </main>
    </div>
</body>
</html>