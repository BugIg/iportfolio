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
        $markets = [
            [
                'name' => 'Binance',
                'status' => 1,
                'rank' => 1,
                'description' => 'Binance is a cryptocurrency exchange with a focus on the Chinese market and other Chinese coins. Currently, it supports English and Chinese users. The Binance token (BNB) was created during the ICO event to fund the development of the Binance exchange.
Binance is capable of processing 1.4 mil orders/second, has multi-language support – Chinese, English, Korean, Japanese and has all the major coins available – BTC, ETH, LTC, BNB etc. Trading fee is 0.1%',
                'details' => json_encode([
                    'country' => 'China',
                    'twitter' => '@binance_2017',
                    'website' => 'https://www.binance.com/',
                ])
            ],
            [
                'name' => 'BX.in.th',
                'status' => 1,
                'rank' => 3,
                'description' => 'BX.in.th is a Thailand-based exchange by Bitcoin Co. Ltd., a company that has been providing services Bitcoin and other crypto-currency, such as Ethereum, Ripple and ICO tokens, since 2013. Through BX.in.th, users can buy and sell Bitcoin and other cryptocurrencies for THB.',
                'details' => json_encode([
                    'country' => 'Thailand',
                    'twitter' => '@BitcoinThai',
                    'website' => 'https://bx.in.th/',
                ])
            ],
            [
                'name' => 'Kucoin',
                'status' => 1,
                'rank' => 2,
                'description' => 'Kucoin is a multi-cryptocurrency exchange with Service Centers based in China. Kucoin offers trading pairs such as BTC/BCH, BTC/DASH, BTC/NEO, BTC/ETH, BTC/RDN, BTC/LTC, BTC/CVC, BTC/KCS, BTC/RPX, etc. It also provides users with a mobile app available for iOS and Android.',
                'details' => json_encode([
                    'country' => 'China',
                    'twitter' => '@kucoincom',
                    'website' => 'https://www.kucoin.com/',
                ])
            ]
        ];


        foreach ($markets as $market) {
            $id = DB::table('markets')->insertGetId($market);

            if ($market['name'] === 'Binance') {
                $image = 'https://www.cryptocompare.com/media/9350818/binance.png';
            } elseif ($market['name'] === 'Kucoin') {
                $image = 'https://www.cryptocompare.com/media/16746542/kucoin-exchange.png';
            } elseif ($market['name'] === 'BX.in.th') {
                $image = 'https://www.cryptocompare.com/media/14913562/bxinth.png';
            }

            $base64Image = $base64Image = base64_encode(file_get_contents( $image));
            $img = Image::make($base64Image);
            $mime = $img->mime();
            if ($mime == 'image/jpeg')
                $extension = 'jpg';
            elseif ($mime == 'image/png')
                $extension = 'png';
            elseif ($mime == 'image/gif')
                $extension = 'gif';
            else
                $extension = null;

            if ($extension) {
                $img->save('public/images/markets/' . $id . '.' . $extension);
                DB::table('markets')->where('id', $id)
                    ->update(['logo_ext' => $extension]);
            }
        }

    }
}
