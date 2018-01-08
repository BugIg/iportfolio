<?php

namespace App\Api\V1\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Admin\Requests\Coin\CoinCreateRequest;
use App\Api\V1\Admin\Requests\Coin\CoinUpdateRequest;
use App\Api\V1\Admin\Transformers\CoinTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\Coin\CoinRepositoryInterface;


class CoinController extends Controller
{
    use Helpers;

    /**
     * @var CoinRepositoryInterface
     */
    protected $repository;

    /**
     * Create a new controller instance
     *
     * @param CoinRepositoryInterface $repository
     */
    public function __construct(CoinRepositoryInterface $repository)
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
        $coins = $this->repository->paginate(50);

        return $this->response->paginator($coins, new CoinTransformer);
    }

    /**
     * POST /coins/{id}
     * Show the form for creating a new resource.
     *
     * @param CoinCreateRequest $request
     * @return mixed
     */
    public function store(CoinCreateRequest $request)
    {
        $coin = $this->repository->create($request->all());
        if ( $coin ) {
            $this->response->created();
        } else {
            $this->response->errorInternal("Unable to create coin. Please try again");
        }
    }

    /**
     * GET /coins/{id}
     * Display the specified resource.
     *
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        try {
            return $this->response->item($this->repository->find($id), new CoinTransformer)->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Not found coin");
        }
    }

    /**
     * PUT /coins/{id}
     * Update coin details
     *
     * @param CoinUpdateRequest $request
     * @param int $id
     *
     * @return \Dingo\Api\Http\Response
     */
    function update(CoinUpdateRequest $request, int $id) {

        try {
            $this->repository->update( $request->all(), $id );
            return $this->response->array(['message' => 'Coin has been updated successfully', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Unable to update coin. Please try again");
        }
    }

    /**
     * DELETE /coins/{id}
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
            $this->response->errorNotFound("Unable to delete coin. Please try again");
        }

    }
}
