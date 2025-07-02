@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Редактировать товар: {{ $product->name }}</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
            class="bg-neutral-600 p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-200 text-sm font-bold mb-2">Название:</label>
                <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-200 text-sm font-bold mb-2">Описание:</label>
                <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="description" name="description" rows="5"
                    required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-200 text-sm font-bold mb-2">Цена:</label>
                <input type="number"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="price" name="price" min="0" step="0.01" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-200 text-sm font-bold mb-2">Изображение:</label>
                <input type="file" class="block w-full text-sm text-gray-200
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100" id="image" name="image">
                @if ($product->image)
                    <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="mt-2 w-32 h-32 object-cover rounded">
                @else
                    <p class="text-gray-400 text-sm mt-2">Текущее изображение отсутствует.</p>
                @endif
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="in_stock" class="block text-gray-200 text-sm font-bold mb-2">В наличии:</label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="in_stock" name="in_stock" required>
                    <option value="1" {{ old('in_stock', $product->in_stock) ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ !old('in_stock', $product->in_stock) ? 'selected' : '' }}>Нет</option>
                </select>
                @error('in_stock')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="brand" class="block text-gray-200 text-sm font-bold mb-2">Бренд:</label>
                <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="brand" name="brand" value="{{ old('brand', $product->brand) }}">
                @error('brand')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="size" class="block text-gray-300 text-sm font-bold mb-2">Размеры:</label>
                <select name="size[]" id="size" multiple
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($availableSizes as $sizeOption)
                        <option value="{{ $sizeOption }}" {{ in_array($sizeOption, old('size', $product->size ?? [])) ? 'selected' : '' }}>
                            {{ $sizeOption }}
                        </option>
                    @endforeach
                </select>
                @error('size')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                <p class="text-gray-400 text-xs mt-1">Используйте **Ctrl + клик (Windows/Linux)** или **Cmd + клик (macOS)**
                    для выбора нескольких размеров.</p>
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-gray-200 text-sm font-bold mb-2">Категория:</label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="category_id" name="category_id">
                    <option value="">Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Сохранить изменения
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Отмена
                </a>
            </div>
        </form>
    </div>
@endsection