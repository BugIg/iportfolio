<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'U.S. Dollar',
                'symbol_left' => '$',
                'symbol_right' => '',
                'code' => 'USD',
                'rank' => 1,
                'status' => 1
            ],
            [
                'name' => 'Bitcoin',
                'symbol_left' => 'Ƀ',
                'symbol_right' => '',
                'code' => 'BTC',
                'rank' => 7,
                'status' => 1
            ],
            [
                'name' => 'Ethereum',
                'symbol_left' => 'Ξ',
                'symbol_right' => '',
                'code' => 'ETH',
                'rank' => 8,
                'status' => 1
            ],
            [
                'name' => 'Euro',
                'symbol_left' => '€',
                'symbol_right' => '',
                'code' => 'EUR',
                'rank' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Pound Sterling',
                'symbol_left' => '£',
                'symbol_right' => '',
                'rank' => 5,
                'code' => 'GBP',
                'status' => 1,
            ],
            [
                'name' => 'Thai Baht',
                'symbol_left' => '฿',
                'symbol_right' => '',
                'rank' => 3,
                'code' => 'THB',
                'status' => 1,
            ],
            [
                'name' => 'Ukrainian hryvnia',
                'symbol_left' => '₴',
                'symbol_right' => '',
                'rank' => 4,
                'code' => 'UAH',
                'status' => 1,
            ],
            [
                'name' => 'Russian ruble',
                'symbol_left' => '₽',
                'symbol_right' => '',
                'rank' => 6,
                'code' => 'RUB',
                'status' => 1,
            ],
        ];

        DB::table('currencies')->insert($currencies);
    }
}
