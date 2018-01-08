<?php
namespace App\Api\V1\Admin\Requests\Coin;

use Dingo\Api\Http\FormRequest;

class CoinCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => 'required|unique:coins',
            'symbol'     => 'required|unique:coins',
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