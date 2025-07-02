<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFI - Редактирование заказа</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Общие стили из предоставленного кода */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #3f3f3f; /* Цвет фона, как на скриншоте */
            color: #ffffff; /* Общий цвет текста */
            scroll-behavior: smooth;
        }
        .nav-link { margin-left: 40px; }
        .first-link { margin-left: 40px; }
        .my-auto { margin-left: 130px; }
        .my-bask { margin-left: 130px; }

        .auth-section {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 22px 20px;
        }

        .auth-card {
            max-width: 900px; /* Умеренная ширина для формы */
            width: 100%;
            color: white;
            font-family: "Montserrat", sans-serif;
            background-color: #7a3a2d; /* Цвет карточки */
            border: dashed 2px white; /* Белая пунктирная рамка */
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .admin-dashboard-links {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
        }

        .admin-link {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
            transition: background-color 0.3s ease;
        }

        .admin-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .admin-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-bottom: 2px solid #ffd700;
            color: #ffd700;
        }

        /* Стили для полей ввода и кнопки */
        .custom-input, .custom-select {
            background-color: #3f3f3f;
            border: 1px solid #666;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            width: 100%; /* Ширина на 100% контейнера */
            max-width: 400px; /* Максимальная ширина для поля */
        }
        .custom-input:focus, .custom-select:focus {
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
        .space-y-6 > div {
            margin-bottom: 20px;
        }
        .space-y-6 {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Стили для элементов заказа в форме редактирования */
        .order-details-section {
            background-color: #6a2a22; /* Цвет карточки заказа, темнее основного */
            border: dashed 1px rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .order-details-section h4 {
            font-size: 20px;
            color: #ffd700;
            margin-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
        }
        .order-details-section p {
            margin-bottom: 10px;
            font-size: 16px;
            color: #f5f5f5;
        }
        .order-details-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .order-details-section ul li {
            padding: 8px 0;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
        }
        .order-details-section ul li:last-child {
            border-bottom: none;
        }
        .order-details-section img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 10px;
        }
        .item-row {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
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

            <hr class="self-stretch mt-6 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full"/>

            <nav class="flex flex-wrap gap-5 justify-between mt-8 max-w-full text-xl text-white">
                <div class="flex gap-10 items-center max-md:max-w-full">
                    <a href="/" class="self-stretch text-5xl font-bold basis-auto max-md:text-4xl">
                        PROFI
                    </a>
                    <a href="/map" class="first-link">Контакты</a>
                    <a href="/catalog" class="nav-link">Каталог</a>
                    <a href="{{ route('cart') }}" class="nav-link relative">
                        Корзина
                        <span id="cart-counter" class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"
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

            <hr class="self-stretch mt-7 w-full border border-solid border-neutral-600 min-h-px max-md:max-w-full"/>

            <h2 class="mt-20 text-3xl font-semibold text-white text-center w-full max-md:mt-10">РЕДАКТИРОВАНИЕ ЗАКАЗА</h2>
        </header>

        <main class="flex flex-col items-center py-20">
            <section class="auth-section admin-section">
                <div class="auth-card admin-card">
                    <nav class="admin-dashboard-links">
                        <a href="{{ route('admin.dashboard') }}" class="admin-link @if(Request::routeIs('admin.dashboard')) active @endif">Панель</a>
                        <a href="{{ route('admin.products.index') }}" class="admin-link @if(Request::routeIs('admin.products.*')) active @endif">Товары</a>
                        <a href="{{ route('admin.categories.index') }}" class="admin-link @if(Request::routeIs('admin.categories.*')) active @endif">Категории</a>
                        <a href="{{ route('admin.orders.index') }}" class="admin-link @if(Request::routeIs('admin.orders.*')) active @endif">Заказы</a>
                    </nav>

                    {{-- Flash-сообщения (Laravel session flash) --}}
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

                    <h2 class="text-2xl font-bold text-white text-center mb-5">Редактировать Заказ №{{ $order->id }}</h2>

                    <div class="order-details-section">
                        <h4>Детали заказа</h4>
                        <p><strong>Пользователь:</strong> {{ $order->user ? $order->user->name : 'N/A' }} ({{ $order->user ? $order->user->email : 'N/A' }})</p>
                        <p><strong>Общая сумма:</strong> {{ number_format($order->total_amount, 2, ',', ' ') }} ₽</p>
                        <p><strong>Дата создания:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                        <p><strong>Последнее обновление:</strong> {{ $order->updated_at->format('d.m.Y H:i') }}</p>

                        <h4>Товары в заказе:</h4>
                        <ul>
                            @foreach ($order->items as $item)
                                <li class="item-row">
                                    @php
                                        $imageSrc = '/placeholder.png'; // Дефолтное изображение
                                        if ($item->product && $item->product->image) {
                                            if (strpos($item->product->image, '/') !== false || strpos($item->product->image, '\\') !== false) {
                                                $imageSrc = asset('storage/' . $item->product->image);
                                            } else {
                                                $imageSrc = asset('images/' . $item->product->image);
                                            }
                                        }
                                    @endphp
                                    <img src="{{ $imageSrc }}" alt="Изображение товара">
                                    <span>{{ $item->product ? $item->product->name : 'Товар удален' }} ({{ $item->quantity }} шт. x {{ number_format($item->price, 2, ',', ' ') }} ₽)</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="status" class="custom-label">Статус заказа</label>
                            <select name="status" id="status" class="mt-1 block w-full custom-select">
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $key }}" @if($order->status == $key) selected @endif>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="custom-button">Сохранить изменения</button>
                            <a href="{{ route('admin.orders.index') }}" class="custom-button">Отменить</a>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <p class="mt-10 text-sm text-white/70 text-center text-xl">Мечты - это характеристики нашей личности....</p>
        <img
            loading="lazy"
            src="/images/image 3.png"
            class="mt-4 w-130 aspect-square mx-auto"
            alt="Small decorative image"
        />

        <hr class="mt-20 w-full h-px border border-solid border-neutral-600 max-md:mt-20 max-md:mr-1.5"/>
        <footer class="flex items-center mt-8 w-[912px] max-w-full text-xl text-white">
            <h2 class="text-5xl font-bold mr-[110px]">PROFI</h2>
            <a href="https://t.me/aksler30" class="mr-[110px] hover:text-gray-300">Наш тг</a>
            <a href="#vk" class="mr-[110px] hover:text-gray-300">Вконтакте</a>
            <a href="mailto:profi38@mail.ru hover:text-gray-300">profi38@mail.ru</a>
        </footer>
        <hr class="w-full h-px mt-7 border border-solid border-neutral-600 max-md:mr-1.5"/>
    </div>
</body>
</html>