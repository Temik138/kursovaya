@extends('layouts.app') {{-- Предполагаем, что layouts.app включает вашу боковую панель и общую структуру --}}

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Детали заказа №{{ $order->id }}</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-neutral-600 p-6 rounded-lg shadow-md mb-6 text-gray-200">
            <p class="text-lg mb-2"><strong>Пользователь:</strong> {{ $order->user->name ?? 'Гость (ID: ' . $order->user_id . ')' }}</p>
            <p class="text-lg mb-2"><strong>Дата заказа:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p class="text-lg mb-4"><strong>Общая сумма:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} ₽</p>

            <div class="flex items-center mb-4">
                <p class="text-lg mr-4"><strong>Текущий статус:</strong>
                    <span class="px-2 py-1 rounded text-sm font-semibold
                        @if ($order->status->value === 'pending') bg-yellow-500 text-yellow-900
                        @elseif ($order->status->value === 'shipped') bg-blue-500 text-blue-900
                        @elseif ($order->status->value === 'delivered') bg-green-500 text-green-900
                        @elseif ($order->status->value === 'cancelled') bg-red-500 text-red-900
                        @endif">
                        {{ $order->status->ruName() }}
                    </span>
                </p>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PUT')
                    <select name="status" class="bg-neutral-700 text-white p-2 rounded border border-neutral-500 focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ $status->ruName() }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Обновить статус
                    </button>
                </form>
            </div>

            <h3 class="text-2xl font-semibold mt-6 mb-4">Товары в заказе:</h3>
            @if ($order->items->isEmpty())
                <p>В этом заказе нет товаров.</p>
            @else
                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex items-center bg-neutral-700 p-4 rounded-lg">
                            @if($item->product && $item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded mr-4">
                            @else
                                <div class="w-20 h-20 flex items-center justify-center bg-neutral-500 text-gray-400 rounded mr-4 text-center text-sm">Нет<br>изображения</div>
                            @endif
                            <div>
                                <p class="text-xl font-semibold">{{ $item->product_name }}</p>
                                <p class="text-md text-gray-300">Количество: {{ $item->quantity }}</p>
                                <p class="text-md text-gray-300">Цена за шт.: {{ number_format($item->price, 2, ',', ' ') }} ₽</p>
                                <p class="text-md text-gray-300">Общая стоимость позиции: {{ number_format($item->quantity * $item->price, 2, ',', ' ') }} ₽</p>
                                @if($item->selected_size)
                                    <p class="text-md text-gray-300">Размер: {{ $item->selected_size }}</p>
                                @endif
                                @if($item->product && $item->product->sku)
                                    <small class="text-sm text-gray-400">Артикул: {{ $item->product->sku }}</small>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <a href="{{ route('admin.orders.index') }}" class="mt-6 inline-block bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            Вернуться к списку заказов
        </a>
    </div>
@endsection