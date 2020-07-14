<?php

namespace App\Http\Requests\Amazon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CreateMarketPlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            'seller_id' => 'required',
            'mws_auth_token' => 'required',
            'amazon_marketplace_id' => 'required',
        ];
    }

    public function response (array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse(collect($errors)->first(), 200);
        }

    }
}
