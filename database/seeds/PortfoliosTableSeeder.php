<?php

use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolios = factory(Portfolio::class, 50)->create();
    }
}
