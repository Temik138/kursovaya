<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Enums\OrderStatus; // Убедитесь, что этот Enum существует и корректен
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Для логирования ошибок

class OrderController extends Controller
{
    /**
     * Отображает список всех заказов для админ-панели.
     */
    public function index()
    {
        // Получаем все заказы с их элементами (order_items) и связанными продуктами
        // Используем with('user') для загрузки информации о пользователе
        $orders = Order::with('user', 'items.product')->orderBy('created_at', 'desc')->paginate(10); // Пагинация для удобства

        // Передаем все возможные статусы для фильтрации/выбора (хотя для index пока не используется)
        $statuses = OrderStatus::cases();

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    /**
     * Отображает детали конкретного заказа.
     */
    public function show(Order $order)
    {
        // Загружаем связанные элементы заказа, их продукты и пользователя
        $order->load('items.product', 'user');

        // Передаем все возможные статусы для возможности изменения
        $statuses = OrderStatus::cases();

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    /**
     * Обновляет статус заказа.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:' . implode(',', array_map(fn($case) => $case->value, OrderStatus::cases()))],
        ]);

        try {
            // Преобразуем строковое значение статуса в объект Enum
            $newStatus = OrderStatus::from($request->input('status'));

            $order->status = $newStatus;
            $order->save();

            return redirect()->back()->with('success', 'Статус заказа успешно обновлен.');
        } catch (\ValueError $e) {
            // Ошибка, если передан некорректный статус, который не является частью Enum
            Log::error("Попытка установить недействительный статус заказа: " . $request->input('status') . " для заказа ID: " . $order->id . " | Ошибка: " . $e->getMessage());
            return redirect()->back()->with('error', 'Недопустимый статус заказа.');
        } catch (\Exception $e) {
            Log::error("Ошибка при обновлении статуса заказа ID: " . $order->id . " | Ошибка: " . $e->getMessage());
            return redirect()->back()->with('error', 'Произошла ошибка при обновлении статуса заказа.');
        }
    }
}