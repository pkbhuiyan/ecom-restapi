<?php

use App\Model\Review;
use App\Model\Product;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,5)->create();
        factory(Product::class,50)->create();
        factory(Review::class,350)->create();


    }
}
