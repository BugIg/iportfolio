<?php

namespace App\Api\V1\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Admin\Requests\Market\MarketCreateRequest;
use App\Api\V1\Admin\Requests\Market\MarketUpdateRequest;
use App\Api\V1\Admin\Transformers\MarketTransformer;
use App\Api\V1\Admin\Transformers\MarketPairTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\Market\MarketRepositoryInterface;
use App\Repositories\MarketPair\MarketPairRepositoryInterface;


class MarketController extends Controller
{
    use Helpers;

    /**
     * @var MarketRepositoryInterface
     */
    protected $marketRepository;
    /**
     * @var MarketPairRepositoryInterface
     */
    protected $marketPairRepository;

    /**
     * Create a new controller instance
     *
     * @param MarketRepositoryInterface $marketRepository
     * @param MarketPairRepositoryInterface $marketPairRepository
     * @internal param MarketRepositoryInterface $repository
     * @internal param MarketPairRepositoryInterface $marketPairsRepository
     */
    public function __construct(MarketRepositoryInterface $marketRepository,
                                MarketPairRepositoryInterface $marketPairRepository)
    {
        $this->marketRepository = $marketRepository;
        $this->marketPairRepository = $marketPairRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $markets = $this->marketRepository->paginate(50);

        return $this->response->paginator($markets, new MarketTransformer);
    }

    /**
     * GET /markets/{id}/pairs
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return mixed
     */
    public function getMarketPairs($id) {

        $market_pairs = $this->marketPairRepository->findByField('market_id', $id);

        return $this->response->collection($market_pairs, new MarketPairTransformer);

    }


    /**
     * POST /markets/{id}
     * Show the form for creating a new resource.
     *
     * @param MarketCreateRequest $request
     * @return mixed
     */
    public function store(MarketCreateRequest $request)
    {
        $market = $this->marketRepository->create($request->all());
        if ( $market ) {
            $this->response->created();
        } else {
            $this->response->errorInternal("Unable to create market. Please try again");
        }
    }

    /**
     * GET /markets/{id}
     * Display the specified resource.
     *
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        try {
            return $this->response->item($this->marketRepository->find($id), new MarketTransformer)->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Not found market");
        }
    }

    /**
     * PUT /markets/{id}
     * Update market details
     *
     * @param MarketUpdateRequest $request
     * @param int $id
     *
     * @return \Dingo\Api\Http\Response
     */
    function update(MarketUpdateRequest $request, int $id) {

        try {
            $this->marketRepository->update( $request->all(), $id );
            return $this->response->array(['message' => 'Market has been updated successfully', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Unable to update market. Please try again");
        }
    }

    /**
     * DELETE /markets/{id}
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->marketRepository->delete($id);
            $this->response->noContent();
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Unable to delete market. Please try again");
        }

    }
}
