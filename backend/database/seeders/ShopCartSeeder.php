<?php

namespace Database\Seeders;

use App\Models\ShopCart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        ShopCart::factory(1)->create();
    }
}
