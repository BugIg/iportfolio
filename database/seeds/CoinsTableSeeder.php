<?php

use Illuminate\Database\Seeder;
use App\Models\Coin;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Webpatser\Uuid\Uuid;
use Intervention\Image\ImageManagerStatic as Image;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/all/coinlist');

        $body = $response->getBody();
        $data = json_decode($body, TRUE);
        $coin = [];
        foreach ($data['Data'] as $k => $datum) {
            if($k === 'BRONZ') continue;

            $coin = [
                'name' => $datum['CoinName'],
                'code' => $datum['Symbol'],
                'rank' => $datum['SortOrder'],
                'status' => 1,
                'description' => '',
                'details'=> json_encode([
                    'website' => '',
                    'algorithm' => $datum['Algorithm'] != 'N/A'? $datum['Algorithm'] : null,
                    'proof_type' => $datum['ProofType'] != 'N/A'? $datum['ProofType'] : null,
                    'fully_premined' => $datum['FullyPremined'] != 'N/A'? $datum['FullyPremined'] : null,
                    'total_coin_supply' => $datum['TotalCoinSupply'] != 'N/A'? $datum['TotalCoinSupply'] : null,
                    'pre_mined_value' => $datum['PreMinedValue'] != 'N/A'? $datum['PreMinedValue'] : null,
                    'total_coins_free_float' => $datum['TotalCoinsFreeFloat'] != 'N/A'? $datum['TotalCoinsFreeFloat'] : null,
                ])
            ];

            $item = DB::table('coins')->where('code', $datum['Symbol'])->get();

            if($item->first()) continue;
            $id = DB::table('coins')->insertGetId($coin);

            //https://www.cryptocompare.com/media/12318415/42.png
            if(!empty($datum['ImageUrl'])) {
                $base64Image = base64_encode(file_get_contents('https://www.cryptocompare.com' . $datum['ImageUrl']));

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
                    $img->save('public/images/coins/' . $id . '.' . $extension);
                    DB::table('coins')->where('id', $id)
                        ->update(['logo_ext' => $extension]);
                }
            }
            unset($coin);
        }
    }
}
