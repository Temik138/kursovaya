<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{

public function run()
{
    $categories = [
        ['name' => 'ветровки', 'slug' => 'windbreakers', 'icon' => 'https://i.ibb.co/xSJN9V1C/Vector.png'],
        ['name' => 'кофты', 'slug' => 'sweaters', 'icon' => 'https://i.ibb.co/BKscrw3Q/Group.png'],
        ['name' => 'штаны', 'slug' => 'pants', 'icon' => 'https://i.ibb.co/Mx7Z3CMC/Group-1.png'],
        ['name' => 'обувь', 'slug' => 'shoes', 'icon' => 'https://i.ibb.co/VckXFkDT/Group-2.png'],
        ['name' => 'головные уборы', 'slug' => 'hats', 'icon' => 'https://i.ibb.co/FkJ6PcrG/Vector-1.png'],
    ];
    
    foreach ($categories as $category) {
        Category::create($category);
    }
}
}