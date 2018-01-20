<?php

namespace App\Console\Commands;
use App\Repositories\MarketPair\MarketPairRepositoryInterface;
use App\Repositories\MarketExchangePair\MarketExchangePairRepositoryInterface;
use BugIg\Bitexthai\BitexthaiAPI;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CronBitcoinExchangeThailand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitexthai:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start on the collection of the latest price';

    /**
     * @var MarketPairRepositoryInterface
     */
    protected $marketPairRepo;

    /**
     * @var MarketExchangePairRepositoryInterface
     */
    protected $marketExchangePairRepo;

    /**
     * Create a new command instance.
     *
     * @param MarketPairRepositoryInterface $marketPairRepo
     * @param MarketExchangePairRepositoryInterface $marketExchangePairRepo
     */
    public function __construct(MarketPairRepositoryInterface $marketPairRepo,
                                MarketExchangePairRepositoryInterface $marketExchangePairRepo)
    {
        parent::__construct();

        $this->marketPairRepo = $marketPairRepo;
        $this->marketExchangePairRepo = $marketExchangePairRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->addCurrencyPairingToDB();
    }

    private function addCurrencyPairingToDB() {
        $market_pairs = $this->marketPairRepo->findByField('market_id', 3);
        $api = new BitexthaiAPI;
        foreach ($market_pairs as $market_pair) {
            $pair = $api->getCurrencyPairing($market_pair->currency->code, $market_pair->coin->code);

            $data = [
                'market_pair_id' => $market_pair->id,
                'exchange_rate' => $pair->last_price,
                'from_date'=> Carbon::now()->toIso8601String(),
                'to_date'=> Carbon::now()->addSeconds(10)->toIso8601String(),
                'change'=> $pair->change,
                'volume_24hours'=> $pair->volume_24hours,
                'order_book'=> json_encode((array) $pair->orderbook),
            ];

            $this->marketExchangePairRepo->create($data);
        }
    }
}
