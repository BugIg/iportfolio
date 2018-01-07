<?php

namespace App\Api\V1\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Api\V1\Requests\UserRequest;
use App\Transformers\UserTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

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
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(UserRequest $request)
    {
//        $validator = \Validator::make($request->all(), [
//            'email'    => 'required|email|unique:users',
//            'name'     => 'required',
//            'password' => 'required|min:6'
//        ]);
//        if ($validator->fails()) {
//            throw new StoreResourceFailedException('Could not create new user.', $validator->errors());
//        }

        $user = User::create([
            'email'    => $request->get('email'),
            'name'     => $request->get('name'),
            'password' => Hash::make($request->get('password'))
        ]);
        if ( $user ) {
            return $this->response->item($user, new UserTransformer)->setStatusCode(200);
        } else {
            return $this->response->array(['message' => 'Unable to create user. Please try again', 'status' => 200]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \Dingo\Api\Http\Request $request
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return $this->response->item($user, new UserTransformer)->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Dingo\Api\Http\Request $request
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return $this->response->item($user, new UserTransformer)->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(UserRequest $request, int $id) {
        $validator = \Validator::make($request->all(), [
            'id'       => 'required',
            'email'    => 'required|email|unique:users',
            'name'     => 'required',
            'password' => 'min:6'
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not able to update user.', $validator->errors());
        }
        $user = User::findOrFail($id);
        $user->email    = $request->get('email');
        $user->name     = $request->get('name');
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        if ( $user->save() ) {
            return $this->response->array(['message' => 'User has been updated successfully', 'status' => 200]);
        } else {
            return $this->response->array(['message' => 'Unable to update user. Please try again', 'status' => 200]);
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
        if ( $user = User::find($id)->delete() ) {
            return $this->response->array(['message' => 'User has been deleted successfully', 'status' => 200]);
        } else {
            return $this->response->array(['message' => 'Unable to delete user. Please try again', 'status' => 200]);
        }
    }
}
