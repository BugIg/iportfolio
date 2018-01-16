<?php

namespace App\Api\V1\Admin\Controllers;

use App\Http\Controllers\Controller;
//use App\Api\V1\Admin\Requests\Market\MarketCreateRequest;
//use App\Api\V1\Admin\Requests\Market\MarketUpdateRequest;
use App\Api\V1\Admin\Transformers\MarketPairTransformer;
use App\Models\MarketPair;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\MarketPair\MarketPairRepositoryInterface;

class MarketPairsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $market_pairs = $this->repository->all();

        return $this->response->collection($market_pairs, new MarketPairTransformer);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
