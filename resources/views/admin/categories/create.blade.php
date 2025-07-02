@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Добавить новую категорию</h1>

        {{-- Очень важно: добавить enctype="multipart/form-data" для загрузки файлов! --}}
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-neutral-600 p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-200 text-sm font-bold mb-2">Название категории:</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" required value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Добавляем поле для загрузки изображения/иконки --}}
            <div class="mb-4">
                <label for="icon" class="block text-gray-200 text-sm font-bold mb-2">Изображение/Иконка категории:</label>
                {{-- Важно: name="icon" соответствует полю в вашей модели Category --}}
                <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:shadow-outline file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600" id="icon" name="icon" accept="image/*">
                @error('icon')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                <p class="text-gray-400 text-xs mt-1">Рекомендуемый размер изображения: квадратное, не более 2MB.</p>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Сохранить категорию
                </button>
                <a href="{{ route('admin.categories.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Отмена
                </a>
            </div>
        </form>
    </div>
@endsection