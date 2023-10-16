<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // DB::statement('SET FOREING_KEY_CHEKS = 0');

        // User::truncate();
        // Category::truncate();
        // Product::truncate();
        // Transaction::truncate();
        // DB::table('category_product')->truncate();

        //*? lo eliminé porque voy a usar php artisan migrate:fresh --seed

        User::factory(200)->create();
        Category::factory(30)->create();
        Product::factory(1000)->create()->each(
            function($producto){
            $categorias = Category::all()->random(mt_rand(1,5))->pluck('id');

            $producto -> categories() -> attach($categorias);
            }
        );
        Transaction::factory(1000)->create();
    }
}
