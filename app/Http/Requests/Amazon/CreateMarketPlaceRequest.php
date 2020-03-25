<?php

namespace App\Http\Requests\Amazon;

use Illuminate\Foundation\Http\FormRequest;

class CreateMarketPlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seller_id' => 'required',
            'marketplace_id' => 'required'
        ];
    }
}
