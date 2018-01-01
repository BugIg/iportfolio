<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(MarketsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CoinsTableSeeder::class);
        $this->call(PortfoliosTableSeeder::class);
        $this->call(PortfolioCoinsTableSeeder::class);
    }
}
