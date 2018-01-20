<?php

namespace App\Api\V1\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Admin\Requests\Market\MarketPairCreateRequest;
use App\Api\V1\Admin\Requests\Market\MarketPairUpdateRequest;
use App\Api\V1\Admin\Transformers\MarketPairTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\MarketPair\MarketPairRepositoryInterface;

class MarketPairController extends Controller
{
    use Helpers;
    /**
     * @var MarketPairRepositoryInterface
     */
    protected $repository;

    /**
     * Create a new controller instance
     *
     * @param MarketPairRepositoryInterface $repository
     */
    public function __construct(MarketPairRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * GET /markets/{id}/pairs
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return mixed
     */
    public function index($id) {

        $market_pairs = $this->repository->findByField('market_id', $id);

        return $this->response->collection($market_pairs, new MarketPairTransformer);
    }
    /**
     * POST /markets/{id}/pairs
     * Show the form for creating a new resource.
     *
     * @param MarketPairCreateRequest $request
     * @return mixed
     */
    public function store(MarketPairCreateRequest $request)
    {
        $market = $this->repository->create($request->all());
        if ( $market ) {
            $this->response->created();
        } else {
            $this->response->errorInternal("Unable to create market. Please try again");
        }
    }

    /**
     * GET /markets/{id}/pairs/{pair}
     * Display the specified resource.
     *
     * @param  int $market_id
     * @param  int $pair_id
     * @return \Illuminate\Http\Response
     */
    public function show($market_id, $pair_id)
    {

    }


    /**
     * PUT /markets/{id}/pairs/{pair}
     * Update market pair details
     *
     * @param MarketPairUpdateRequest $request
     * @param int $market_id
     * @param int $pair_id
     * @return \Dingo\Api\Http\Response
     *
     */
    function update(MarketPairUpdateRequest $request, int $market_id, int $pair_id) {
        try {
            $this->repository->update( $request->all(), $pair_id );
            return $this->response->array(['message' => 'Market Pair has been updated successfully', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Unable to update market. Please try again");
        }
    }

    /**
     * DELETE /markets/{id}/pairs/{pair}
     * Remove the specified resource from storage.
     *
     * @param  int $market_id
     * @param  int $pair_id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(int $market_id, int $pair_id)
    {
        try {
            $this->repository->delete($pair_id);
            $this->response->noContent();
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Unable to delete market pair. Please try again");
        }
    }
}
