<?php
namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'    => 'required|email|unique:users',
            'name'     => 'required',
            'password' => 'required|min:6'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}