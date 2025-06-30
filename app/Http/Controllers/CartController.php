<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

class CartController extends Controller
{
    /**
     * Метод для добавления товара в корзину.
     * Он получает product_id и size_id из данных POST-запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
     public function add(Request $request)
    {
        // 1. Валидируем основные поля
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'selected_size' => 'nullable|string', 
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $selectedSize = $request->input('selected_size');

        $product = Product::find($productId);

        if (!$product) {
            return back()->with('error', 'Товар не найден.');
        }

        if ($selectedSize) {

            $availableSizes = $product->size; 

            if (!in_array($selectedSize, $availableSizes)) {

                return back()->withErrors(['selected_size' => 'Выбранный размер недоступен для этого товара.']);
            }
        }

        $cart = session()->get('cart', []);

        $cartKey = $productId . ($selectedSize ? '-' . $selectedSize : '');

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                "product_id" => $productId,
                "quantity" => $quantity,
                "selected_size" => $selectedSize, 
                "product_name" => $product->name,
                "product_image" => $product->image,
                "product_price" => $product->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Товар добавлен в корзину!');
    }

    /**
     * Метод для отображения содержимого корзины.
     *
     * @return \Illuminate\View\View
     */
public function index()
{
    $cartItems = session()->get('cart', []); 

    $detailedCartItems = [];
    foreach ($cartItems as $cartKey => $details) { 
        $product = \App\Models\Product::find($details['product_id']);

        if ($product) {
            $detailedItem = (object) [
                'id' => $cartKey, 
                'product_id' => $details['product_id'],
                'quantity' => $details['quantity'],
                'selected_size' => $details['selected_size'] ?? null, 
                'product' => $product,
            ];
            $detailedCartItems[] = $detailedItem;
        }
    }

    return view('cart', [
        'cartItems' => $detailedCartItems,
        'isEmpty' => empty($detailedCartItems),
        'itemsCount' => count($detailedCartItems),
        'total' => collect($detailedCartItems)->sum(function($item) {
            return ($item->product->price ?? 0) * $item->quantity;
        }),
    ]);
}

    /**
     * Метод для обновления количества товара в корзине.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $itemKey  Уникальный ключ товара в корзине (product_id-size_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $itemKey)
    {
        $request->validate([
            'operation' => 'required|in:increase,decrease',
        ]);

        $cart = Session::get('cart', []);

        if (isset($cart[$itemKey])) {
            if ($request->input('operation') == 'increase') {
                $cart[$itemKey]['quantity']++;
            } elseif ($request->input('operation') == 'decrease') {
                if ($cart[$itemKey]['quantity'] > 1) {
                    $cart[$itemKey]['quantity']--;
                } else {
                    // Если количество станет 0, удаляем товар из корзины
                    unset($cart[$itemKey]);
                }
            }
            Session::put('cart', $cart);
            return back()->with('success', 'Количество товара обновлено.');
        }

        return back()->with('error', 'Товар в корзине не найден.');
    }

    /**
     * Метод для удаления товара из корзины.
     *
     * @param  string  $itemKey  Уникальный ключ товара в корзине (product_id-size_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($itemKey)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemKey])) {
            unset($cart[$itemKey]);
            Session::put('cart', $cart);
            return back()->with('success', 'Товар удален из корзины.');
        }

        return back()->with('error', 'Товар в корзине не найден.');
    }

    /**
     * Метод для получения количества товаров в корзине (для AJAX).
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public static function getCartItemCount(): int
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}