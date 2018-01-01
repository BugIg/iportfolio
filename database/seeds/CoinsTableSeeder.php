<?php

use Illuminate\Database\Seeder;
use App\Models\Coin;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coins = factory(Coin::class, 50)->create();
    }
}
