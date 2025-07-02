<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFI - Мои заказы</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Общие стили из предоставленного кода */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #3f3f3f;
            /* Цвет фона, как на скриншоте */
            color: #ffffff;
            /* Общий цвет текста */
            scroll-behavior: smooth;
        }

        .nav-link {
            margin-left: 40px;
        }

        .first-link {
            margin-left: 40px;
        }

        .my-auto {
            margin-left: 130px;
        }

        .my-bask {
            margin-left: 130px;
        }

        .auth-section {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 22px 20px;
        }

        .auth-card {
            max-width: 1000px;
            width: 1000px;
            color: white;
            font-family: "Montserrat", sans-serif;
        }

        .profile-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
        }

        .tab-link {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
            transition: background-color 0.3s ease;
        }

        .tab-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .tab-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-bottom: 2px solid #ffd700;/
        }

        /* Стили для полей ввода и кнопки (хотя их здесь нет, но для единообразия) */
        .custom-input {
            background-color: #3f3f3f;
            border: 1px solid #666;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            width: 300px;
            max-width: 100%;
        }

        .custom-input:focus {
            outline: none;
            border-color: #7a7a7a;
            box-shadow: 0 0 0 1px #7a7a7a;
        }

        .custom-label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        .custom-button {
            background-color: #525252;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #616161;
        }

        .space-y-6>div {
            margin-bottom: 20px;
        }

        .space-y-6 {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Стили для списка заказов */
        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-card {
            border: dashed 1px rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .order-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            /* Для адаптивности */
        }

        .order-header h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .order-header p {
            margin: 5px 0;
            font-size: 16px;
            color: #f5f5f5;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            color: #28a745;
        }

        .status-pending {
            color: #ffc107;
        }

        .status-shipped {
            color: #6c757d;/
        }

        .status-delivered {
            color: #28a745;
        }

        .status-cancelled {
            color: #dc3545;
        }


        .order-items ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
        }

        .order-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .order-item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .order-item-image-placeholder {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            font-size: 12px;
            text-align: center;
            flex-shrink: 0;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item-details {
            font-size: 15px;
            color: #f5f5f5;
        }

        .no-orders-message {
            text-align: center;
            margin-top: 50px;
            font-size: 18px;
            color: #f5f5f5;
        }

        .no-orders-message .button {
            margin-top: 20px;
            display: inline-block;
        }

        /* Общие стили кнопок */
        .button {
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            display: inline-block;
            cursor: pointer;
        }

        .primary-button {
            background-color: #525252;
            color: white;
            border: none;
        }

        .primary-button:hover {
            background-color: #616161;
        }

        .cancel-button {
            background-color: #dc3545;
            /* Красный для отмены */
            color: white;
            border: none;
            margin-left: 10px;
            /* Отступ от статуса */
        }

        .cancel-button:hover {
            background-color: #c82333;
        }

        .cancel-button:disabled {
            background-color: #6c757d;
            /* Серый, когда отключена */
            cursor: not-allowed;
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .auth-card {
                padding: 20px;
            }

            .auth-title {
                font-size: 28px;
            }

            .order-card {
                padding: 15px;
            }

            .order-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-header h3,
            .order-header p {
                margin-bottom: 5px;
            }

            .cancel-button {
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
            }
        }

        /* Стили для флеш-сообщений */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-left: 5px solid;
            border-radius: 4px;
        }

        .success-alert {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .error-alert {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="flex overflow-hidden flex-col items-center pt-5 bg-neutral-700">
        <header class="w-full flex flex-col items-center">
            <p class="text-sm text-white underline max-md:max-w-full">
                Многие люди терпят неудачу только потому, что сдаются в двух шагах от успеха.
            </p>

            <hr class="self-stretch mt-6 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full" />

            <nav class="flex flex-wrap gap-5 justify-between mt-8 max-w-full text-xl text-white">
                <div class="flex gap-10 items-center max-md:max-w-full">
                    <a href="/" class="self-stretch text-5xl font-bold basis-auto max-md:text-4xl">
                        PROFI
                    </a>
                    <a href="/map" class="first-link">Контакты</a>
                    <a href="/catalog" class="nav-link">Каталог</a>
                    <a href="{{ route('cart') }}" class="nav-link relative">
                        Корзина
                        <span id="cart-counter"
                            class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"
                            style="display: {{ auth()->check() && \App\Http\Controllers\CartController::getCartItemCount() > 0 ? 'flex' : 'none' }}">
                            {{ auth()->check() ? \App\Http\Controllers\CartController::getCartItemCount() : 0 }}
                        </span>
                    </a>
                </div>

                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link mt-2.5 hover:text-gray-300">
                            Админ-панель
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link mt-2.5 hover:text-gray-300">Выйти</button>
                    </form>
                    <a href="{{ route('profile.edit') }}" class="mt-2.5 hover:text-gray-300">Профиль</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link mt-2.5 hover:text-gray-300">Войти</a>
                    <a href="{{ route('register') }}" class="mt-2.5 hover:text-gray-300">Зарегистрироваться</a>
                @endauth
            </nav>

            <hr class="self-stretch mt-7 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full" />

            <h2 class="mt-20 text-3xl font-semibold text-white text-center w-full max-md:mt-10">Личный кабинет</h2>
        </header>

        <main class="flex flex-col items-center py-20">
            <section class="auth-section profile-section">
                <div class="auth-card profile-card">
                    <nav class="profile-tabs">
                        <a href="{{ route('profile.edit') }}"
                            class="tab-link @if(Request::routeIs('profile.edit')) active @endif">Профиль</a>
                        <a href="{{ route('profile.orders.index') }}"
                            class="tab-link @if(Request::routeIs('profile.orders.index')) active @endif">Мои заказы</a>
                    </nav>

                    @if (session('success'))
                        <div class="alert success-alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert error-alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2 class="text-2xl font-bold text-white text-center mb-5">Ваши заказы</h2>
                    @if ($orders->isEmpty())
                        <div class="no-orders-message">
                            <p>У вас пока нет оформленных заказов.</p>
                            <a href="{{ route('catalog') }}" class="button primary-button">Начать покупки</a>
                        </div>
                    @else
                        <div class="orders-list">
                            @foreach ($orders as $order)
                                <div class="order-card">
                                    <div class="order-header">
                                        <div>
                                            <h3>Заказ № {{ $order->id }}</h3>
                                            <p>Статус: <span
                                                    class="status-badge status-{{ $order->status->value }}">{{ $order->status->ruName() }}</span>
                                            </p>
                                            <p>Дата: {{ $order->created_at->format('d.m.Y H:i') }}</p>
                                            <p>Общая сумма: {{ number_format($order->total_price, 2, ',', ' ') }} ₽</p>
                                        </div>
                                        @if ($order->status->canBeCancelled())
                                            <form action="{{ route('profile.orders.cancel', $order) }}" method="POST"
                                                onsubmit="return confirm('Вы уверены, что хотите отменить этот заказ?');">
                                                @csrf
                                                <button type="submit" class="button cancel-button">Отменить заказ</button>
                                            </form>
                                        @else
                                            <button type="button" class="button cancel-button" disabled>Отменить заказ</button>
                                        @endif
                                    </div>
                                    <div class="order-items">
                                        <h4>Товары в заказе:</h4>
                                        <ul>
                                            @foreach($order->items as $item)
                                                <li class="order-item">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                            alt="{{ $item->product->name }}" class="order-item-image">
                                                    @else
                                                        <div class="order-item-image-placeholder">Нет<br>изображения</div>
                                                    @endif
                                                    <div>
                                                        <div class="item-name">{{ $item->product_name }}</div> {{-- Используйте
                                                        $item->product_name, так как вы его сохраняете --}}
                                                        <div class="item-details">{{ $item->quantity }} шт. x
                                                            {{ number_format($item->price, 2, ',', ' ') }} ₽ =
                                                            {{ number_format($item->quantity * $item->price, 2, ',', ' ') }} ₽</div>
                                                        @if($item->product && $item->product->sku)
                                                            <small class="item-details">Артикул: {{ $item->product->sku }}</small>
                                                        @endif
                                                        @if($item->selected_size)
                                                            <div class="item-details">Размер: {{ $item->selected_size }}</div>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        </main>

        <p class="mt-10 text-sm text-white/70 text-center text-xl">Мечты - это характеристики нашей личности....</p>
        <img loading="lazy" src="/images/image 3.png" class="mt-4 w-130 aspect-square mx-auto"
            alt="Small decorative image" />

        <hr class="mt-20 w-full h-px border border-solid border-neutral-600 max-md:mt-20 max-md:mr-1.5" />
        <footer class="flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
            <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
            <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
            <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
            <a href="mailto:profi38@mail.ru hover:text-gray-300">profi38@mail.ru</a>
        </footer>
        <hr class="w-full h-px mt-7 border border-solid border-neutral-600 max-md:mr-1.5" />
    </div>
</body>

</html>