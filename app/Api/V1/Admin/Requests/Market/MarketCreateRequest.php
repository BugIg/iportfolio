<?php
namespace App\Api\V1\Admin\Requests\Market;

use Dingo\Api\Http\FormRequest;

class MarketCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => 'required|unique:markets',
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