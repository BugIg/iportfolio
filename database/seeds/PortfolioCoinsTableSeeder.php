<?php

use Illuminate\Database\Seeder;
use App\Models\PortfolioCoin;

class PortfolioCoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolio_coins = factory(PortfolioCoin::class, 50)->create();
    }
}
