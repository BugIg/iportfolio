<?php
namespace App\Api\V1\Admin\Requests\User;

use Dingo\Api\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'    => 'required|email|unique:users,email,' . $this->route('user'),
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