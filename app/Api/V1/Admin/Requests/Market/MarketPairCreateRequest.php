<?php
namespace App\Api\V1\Admin\Requests\Market;

use Dingo\Api\Http\FormRequest;

class MarketPairCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'market_id'     => 'required',
            'currency_id'     => 'required',
            'coin_id'     => 'required',
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