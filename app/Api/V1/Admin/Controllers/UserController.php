<?php

namespace App\Api\V1\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Admin\Requests\User\UserCreateRequest;
use App\Api\V1\Admin\Requests\User\UserUpdateRequest;
use App\Api\V1\Admin\Transformers\UserTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Repositories\User\UserRepositoryInterface;


class UserController extends Controller
{
    use Helpers;

    /**
     * @var UserRepositoryInterface
     */
    protected $repository;

    /**
     * Create a new controller instance
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
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
        $users = $this->repository->paginate(50);

        return $this->response->paginator($users, new UserTransformer);
    }

    /**
     * POST /users/{id}
     * Show the form for creating a new resource.
     *
     * @param UserCreateRequest $request
     * @return mixed
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->repository->create($request->all());
        if ( $user ) {
            $this->response->created();
        } else {
            $this->response->errorInternal("Unable to create user. Please try again");
        }
    }

    /**
     * GET /users/{id}
     * Display the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        try {
            return $this->response->item($this->repository->find($id), new UserTransformer)->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Not found user");
        }
    }

    /**
     * PUT /users/{id}
     * Update user details
     *
     * @param UserUpdateRequest $request
     * @param int $id
     *
     * @return \Dingo\Api\Http\Response
     */
    function update(UserUpdateRequest $request, int $id) {

        try {
            $this->repository->update( $request->all(), $id );
            return $this->response->array(['message' => 'User has been updated successfully', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            $this->response->errorNotFound("Unable to update user. Please try again");
        }
    }

    /**
     * DELETE /users/{id}
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
            $this->response->errorNotFound("Unable to delete user. Please try again");
        }

    }
}
