<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Product::truncate();
        Category::truncate();
        ProductImage::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Определяем категории и их иконки
        $categoryData = [
            'Ветровки' => 'images/vet.png', // Используйте путь относительно storage/app/public
            'Кофты и футболки' => 'images/kof.png',
            'Штаны и шорты' => 'images/shtan.png',
            'Обувь' => 'images/kr.png',
            'Головные уборы' => 'images/kep.png',
        ];

        $categoryModels = [];
        foreach ($categoryData as $categoryName => $iconPath) {
            $categoryModels[$categoryName] = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName), // Добавьте slug для категорий
                'icon' => $iconPath, // Задаем путь к иконке
            ]);
        }

        $productsData = [
            [
                'name' => 'Куртка RedFox',
                'description' => 'Куртка спортивного дизайна из трехслойного материала Softshell с мембраной 10 000 мм и водоотталкивающей пропиткой.',
                'main_image' => 'images/redfox1.png',
                'images' => [
                    '/images/redfox2.png',
                    '/images/redfox.png',
                ],
                'price' => 10900,
                'in_stock' => true,
                'brand' => 'RedFox',
                'category' => 'Ветровки',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Кроссовки Salomon мужские',
                'description' => 'Система пластиковых «крыльев» по бокам верха обуви. Поддерживает стопу, защищает от пронации и супинации, исключает растягивание верха обуви в сырую погоду и увеличивает срок её службы. Водостойкая, ветрозащитная и паропроницаемая мембрана. Микропористая структура не пропускает капли воды снаружи, в то время как молекулы пота свободно выводятся сквозь мембрану.',
                'main_image' => 'images/kr_salomon1.png',
                'images' => [
                    '/images/kr_salomon2.png',
                    '/images/kr_salomon.png',
                ],
                'price' => 8700,
                'in_stock' => true,
                'brand' => 'Salomon',
                'category' => 'Обувь',
                'sizes' => ['40', '41', '42', '43', '44'],
            ],
            [
                'name' => 'Шорты Puma',
                'description' => 'Шорты puma помогут вам достичь наилучших результатов. Шорты оснащены технологией отвода влаги, чтобы вы оставались сухими, имеют светоотражающую графику для повышения безопасности и сетчатую вставку для улучшения воздухопроницаемости.',
                'main_image' => 'images/sh_puma.png',
                'images' => [
                    '/images/sh_puma3.png',
                    '/images/sh_puma2.png',
                ],
                'price' => 3200,
                'in_stock' => true,
                'brand' => 'Puma',
                'category' => 'Штаны и шорты',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Футболка Manto',
                'description' => 'Тренировочная футболка Manto Logo. Разработана для тренировок любого уровня интенсивности. Мягкая, приятная на ощупь. Изготовлена из сверхлёгкого материала. Использованы экологически чистые красители.',
                'main_image' => 'images/futb_manto.png',
                'images' => [
                    '/images/futb_manto2.png',
                    '/images/futb_manto3.png',
                ],
                'price' => 3200,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Кофты и футболки',
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
            ],
            [
                'name' => 'Кепка Manto',
                'description' => 'Бейсболка Manto Logo Classic Black. Размер регулируется застёжкой. Состав: 80% хлопок, 20% полиэстер.',
                'main_image' => 'images/kep_manto.png',
                'images' => [
                    '/images/kep_manto2.png',
                ],
                'price' => 2100,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Головные уборы',
                'sizes' => ['OS'],
            ],
            [
                'name' => 'Кофта HardTrain',
                'description' => 'Худи Hardcore Training х Ground Shark The Moment of Truth. Коллаборация иллюстратора John Connell, автора проекта Ground Shark и производителя спортивной экипировки Hardcore Training. Мир - это не солнышко с радугой, говорит нам бойцовский пёс с очередной футболки от НСТ.',
                'main_image' => 'images/kof_train.png',
                'images' => [
                    '/images/kof_train.png',
                ],
                'price' => 5800,
                'in_stock' => true,
                'brand' => 'HardTrain',
                'category' => 'Кофты и футболки',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Кофта HardCore',
                'description' => 'Худи Hardcore Training Helmet Black. Кофта с капюшоном. Выполнена кофта из плотного, но при этом мягкого материала. Широкие манжеты дают хорошее прилегание рукавов к рукам. Большой карман-кенгуру. Качественная вышивка.',
                'main_image' => 'images/kof_hard.png',
                'images' => [
                    '/images/kof_hard1.png',
                    '/images/kof_hard3.png',
                ],
                'price' => 5800,
                'in_stock' => true,
                'brand' => 'HardCore',
                'category' => 'Кофты и футболки',
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
            ],
            [
                'name' => 'Кроссовки Tyr Torf',
                'description' => 'Кроссовки для фитнеса Tyr Turf Trainer 544. В кроссфите очень важно иметь качественную и удобную обувь, которая бы обеспечивала комфорт и безопасность во время самых сложных упражнений. Кроссовки Tyr Turf Trainer разработаны специально для функциональных тренировок и кроссфита (и в зале, и на улице). Изготовлены из высококачественных материалов.',
                'main_image' => 'images/tyr.png',
                'images' => [
                    '/images/tyr2.png',
                    '/images/tyr3.png',
                ],
                'price' => 12000,
                'in_stock' => true,
                'brand' => 'Tyrtorf',
                'category' => 'Обувь',
                'sizes' => ['40', '41', '42', '43', '44'],
            ],
            [
                'name' => 'Шапка Manto',
                'description' => 'Шапка Manto Classic Black. Зимний головной убор классической конструкции с широким подворотом. Материал характеризуется мягкостью и комфортным прилеганием. Размер - универсальный. Состав: 100% акрил.',
                'main_image' => 'images/shap_manto1.png',
                'images' => [
                    '/images/shap_manto.png',
                ],
                'price' => 2300,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Головные уборы',
                'sizes' => ['OS'],
            ],
            [
                'name' => 'Штаны HardCore',
                'description' => 'Детские спортивные штаны Hardcore Training Doodles. Лёгкие и стильные джоггеры для тренировочного процесса и прогулок. Выполнены штаны из мягкого и дышащего материала. Зауженный крой в нижней части брюк. Несколько карманов по бокам. Удобная посадка на поясе. В нижней части присутствуют манжеты. Использованы только экологически чистые краски.',
                'main_image' => 'images/shtan_hard.png',
                'images' => [
                    '/images/shtan_hard2.png',
                    '/images/shtan_hard3.png',
                ],
                'price' => 5290,
                'in_stock' => true,
                'brand' => 'HardCore',
                'category' => 'Штаны и шорты',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Штаны Manto',
                'description' => 'Летние лёгкие спортивные штаны Manto Classic Black. Отлично подойдут и для тренировок, и в качестве прогулочного варианта в тёплое время года. На бедрах штаны удерживаются с помощью резинки и шнурка, спрятанного в пояс. Манжеты в нижней части брюк оснащены резинкой. Присутствуют карманы.',
                'main_image' => 'images/shtan_manto.png',
                'images' => [
                    '/images/shtan_manto2.png',
                    '/images/shtan_manto.png',
                ],
                'price' => 4600,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Штаны и шорты',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Шорты Manto мужские',
                'description' => 'Мужские шорты S/Lab Sense 6, разработанные спортсменами и для спортсменов, — удачный выбор для активных тренировок. <br /> Внутренние шорты из материала с технологией 37.5 эффективно отводят влагу и излишки тепла. <br /> Вместительный сетчатый пояс-карман для важных мелочей. <br /> Тянущаяся в 4 направлениях ткань и прямой крой для свободы движений. Присутствуют карманы.',
                'main_image' => 'images/short_manto.png',
                'images' => [
                    '/images/short_manto2.png',
                    '/images/short_manto3.png',
                ],
                'price' => 3990,
                'in_stock' => true,
                'brand' => 'Manto',
                'category' => 'Штаны и шорты',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Шорты Salomon женские',
                'description' => 'Спортивные шорты идеальный вариант для занятия спортом в жаркое лето. Представляем Вашему вниманию тренировочные шорты AGILE SHORTS! Многофункциональные шорты выполнены из специальной ткани AdvancedSkin Active Dry, которая отводит влагу и распределяет ее по поверхности, где она быстро испаряется, благодаря этому Вы сохраните сухость и комфорт кожи.',
                'main_image' => '/images/sh_salomon.png',
                'images' => [
                    '/images/sh_salomon2.png',
                    '/images/sh_salomon3.png',
                ],
                'price' => 3790,
                'in_stock' => true,
                'brand' => 'Salomon',
                'category' => 'Штаны и шорты',
                'sizes' => ['XS', 'S', 'M', 'L'],
            ],
            [
                'name' => 'Тапки Reebok UFC',
                'description' => 'Мужские сланцы Reebok Combat Flip. Традиционные сланцы от Reebok. Замечательный аксессуар для фанатов UFC. Шлепанцы быстро сохнут! Вам не придется тратить время на просушку обуви. Верх модели выполнен из гладкого плотного полимера.',
                'main_image' => 'images/ufc1.png',
                'images' => [
                    '/images/ufc.png',
                    '/images/ufc2.png',
                ],
                'price' => 1290,
                'in_stock' => true,
                'brand' => 'Reebok',
                'category' => 'Обувь',
                'sizes' => ['40', '41', '42', '43', '44'],
            ],
            [
                'name' => 'Ветровка BadBoy',
                'description' => 'Ветровка Bad Boy. Легкая ветровка для повседневного использования. Ветровка тонкая, мягкая, приятная на ощупь. На фронтальной части присутствуют 3 кармана. На спине так же имеется карман. Застёгивается ветровка на молнию.',
                'main_image' => 'images/badboy.png',
                'images' => [
                    '/images/badboy2.png',
                ],
                'price' => 4500,
                'in_stock' => true,
                'brand' => 'BadBoy',
                'category' => 'Ветровки',
                'sizes' => ['M', 'L', 'XL'],
            ],
            [
                'name' => 'Ветровка Sitka',
                'description' => 'Кофта с капюшоном Sitka Traverse Hoody. Ткань из полиэстера с подкладкой из берберского флиса с высоким ворсом. Экологичная ткань из переработанных материалов. Флисовые вставки средней плотности по бокам и в области подмышек для оптимального комфорта и свободы движений. Прочная водоотталкивающая пропитка защищает от небольших осадков и предотвращает намокание ткани.',
                'main_image' => 'images/sitka.png',
                'images' => [
                    '/images/sitka2.png',
                ],
                'price' => 12000,
                'in_stock' => true,
                'brand' => 'Sitka',
                'category' => 'Ветровки',
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
            ],
        ];

        foreach ($productsData as $data) {
            $product = Product::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
                'image' => $data['main_image'],
                'price' => $data['price'],
                'in_stock' => $data['in_stock'],
                'brand' => $data['brand'],
                'category_id' => $categoryModels[$data['category']]->id,
                'size' => $data['sizes'],
            ]);

            foreach ($data['images'] as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $imageUrl,
                    'order' => $index + 1,
                ]);
            }
        }
    }
}