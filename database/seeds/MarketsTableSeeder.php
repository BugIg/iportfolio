<?php

use Illuminate\Database\Seeder;
use App\Models\Market;

class MarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markets = factory(Market::class, 20)->create();
    }
}
