<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-800 text-white p-6 rounded-lg">
                <h1 class="text-2xl font-bold">Админ-панель</h1>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.products.index') }}" class="block p-4 bg-neutral-700 hover:bg-neutral-600 rounded transition">
                        Управление товарами
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="block p-4 bg-neutral-700 hover:bg-neutral-600 rounded transition">
                        Управление категориями
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>