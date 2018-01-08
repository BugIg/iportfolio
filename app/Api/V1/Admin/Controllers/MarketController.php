<?php

namespace App\Api\V1\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Admin\Requests\Market\MarketCreateRequest;
use App\Api\V1\Admin\Requests\Market\CoinUpdateRequest;
use App\Api\V1\Admin\Transformers\MarketTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\Market\MarketRepositoryInterface;


class MarketController extends Controller
{
    use Helpers;

    /**
     * @var MarketRepositoryInterface
     */
    protected $repository;

    /**
     * Create a new controller instance
     *
     * @param MarketRepositoryInterface $repository
     */
    public function __construct(MarketRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $markets = $this->repository->paginate(50);

        return $this->response->paginator($markets, new MarketTransformer);
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
        $market = $this->repository->create($request->all());
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
            return $this->response->item($this->repository->find($id), new MarketTransformer)->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Not found market");
        }
    }

    /**
     * PUT /markets/{id}
     * Update market details
     *
     * @param CoinUpdateRequest $request
     * @param int $id
     *
     * @return \Dingo\Api\Http\Response
     */
    function update(CoinUpdateRequest $request, int $id) {

        try {
            $this->repository->update( $request->all(), $id );
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
            $this->repository->delete($id);
            $this->response->noContent();
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Unable to delete market. Please try again");
        }

    }
}
