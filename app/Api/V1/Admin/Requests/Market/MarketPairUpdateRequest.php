<?php
namespace App\Api\V1\Admin\Requests\Market;

use Dingo\Api\Http\FormRequest;

class MarketPairUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'currency_id'     => 'required|integer',
            'coin_id'     => 'required|integer',
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