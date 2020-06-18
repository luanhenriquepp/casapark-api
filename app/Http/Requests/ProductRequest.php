<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => '',
            'product_name' => '',
            'description' => '',
            'price' => '',
            'discount' => '',
            'link_whatsapp' => '',
            'price_with_discount' => ''
        ];
    }
}
