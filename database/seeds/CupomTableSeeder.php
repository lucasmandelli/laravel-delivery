<?php

use Illuminate\Database\Seeder;
use LaravelDelivery\Models\Cupom;
use LaravelDelivery\Models\Product;

class CupomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cupom::class, 10)->create();
    }
}
