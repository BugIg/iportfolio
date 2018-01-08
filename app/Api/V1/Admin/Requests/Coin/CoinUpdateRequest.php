<?php
namespace App\Api\V1\Admin\Requests\Coin;

use Dingo\Api\Http\FormRequest;

class CoinUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'    => 'required|unique:coins,name,' . $this->route('coin'),
            'symbol'    => 'required|unique:coins,symbol,' . $this->route('coin'),
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