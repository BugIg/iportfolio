<?php

namespace App\Api\V1\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Api\V1\Requests\UserCreateRequest;
use App\Api\V1\Requests\UserUpdateRequest;
use App\Transformers\UserTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        if ( !$limit = $request->get('limit') ) {
            $limit = 25;
        }
        if ( $currentPage = $request->get('page') ) {
            Paginator::currentPageResolver(function() use ($currentPage) {
                return $currentPage;
            });
        }
        $users = User::paginate($limit);

        return $this->response->paginator($users, new UserTransformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param UserCreateRequest $request
     * @return mixed
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->all());
        if ( $user ) {
            $this->response->created();
        } else {
            $this->response->errorInternal("Unable to create user. Please try again");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        $user = User::find($id);

        if($user == null)
            $this->response->errorNotFound("Not found user.");

        return $this->response->item($user, new UserTransformer)->setStatusCode(200);
    }
    /**
     * Update user details
     *
     * @param UserUpdateRequest $request
     * @param int $id
     *
     * @return \Dingo\Api\Http\Response
     */
    function update(UserUpdateRequest $request, int $id) {

        $user = User::find($id);
        if($user == null)
            $this->response->errorNotFound("Not found user.");
        $user->email    = $request->get('email');
        $user->name     = $request->get('name');
        $user->password = $request->get('password');
        $user->role     = $request->get('role');

        if ( $user->update() ) {
            return $this->response->array(['message' => 'User has been updated successfully', 'status' => 200]);
        } else {
            $this->response->errorInternal("Unable to update user. Please try again");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user == null)
            $this->response->errorNotFound("Not found user");

        if ( $user->delete() ) {
            $this->response->noContent();
        } else {
            $this->response->errorInternal("Unable to delete user. Please try again");
        }
    }
}
