@extends('layouts.app') {{-- Предполагаем, что layouts.app включает вашу боковую панель и общую структуру --}}

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Управление заказами</h1>

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

        <div class="flex justify-start mb-4"> {{-- Здесь убраны кнопки "Добавить товар" и "Управление категориями" --}}
            <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Вернуться на дашборд
            </a>
            
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-neutral-600 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-neutral-700 text-white">
                        <th class="py-2 px-4 text-left">ID Заказа</th>
                        <th class="py-2 px-4 text-left">Пользователь</th>
                        <th class="py-2 px-4 text-left">Сумма</th>
                        <th class="py-2 px-4 text-left">Статус</th>
                        <th class="py-2 px-4 text-left">Дата</th>
                        <th class="py-2 px-4 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b border-neutral-500 text-gray-200">
                            <td class="py-2 px-4">{{ $order->id }}</td>
                            <td class="py-2 px-4">{{ $order->user->name ?? 'Гость (ID: ' . $order->user_id . ')' }}</td>
                            <td class="py-2 px-4">{{ number_format($order->total_price, 2, ',', ' ') }} ₽</td>
                            <td class="py-2 px-4">
                                <span class="px-2 py-1 rounded text-sm font-semibold
                                    @if ($order->status->value === 'pending') bg-yellow-500 text-yellow-900
                                    @elseif ($order->status->value === 'shipped') bg-blue-500 text-blue-900
                                    @elseif ($order->status->value === 'delivered') bg-green-500 text-green-900
                                    @elseif ($order->status->value === 'cancelled') bg-red-500 text-red-900
                                    @endif">
                                    {{ $order->status->ruName() }}
                                </span>
                            </td>
                            <td class="py-2 px-4">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td class="py-2 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded text-sm">Просмотр</a>
                                    {{-- Если хотите, добавьте кнопки для редактирования/удаления заказа здесь,
                                        но обычно для заказов меняют только статус --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-400">Заказов пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection