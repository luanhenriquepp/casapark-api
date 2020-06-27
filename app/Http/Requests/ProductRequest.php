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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'store_id' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'path' => ''
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'store_id' => 'Id da loja',
            'product_name' => 'Nome do produto',
            'description' => 'Descrição',
            'price' => 'Preço',
            'discount' => 'Desconto',
            'price_with_discount' => 'Preço final',
            'store_image' => 'Foto'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'store_id.required' => 'Id da loja',
            'product_name.required' => 'Nome do produto',
            'description.required' => 'Descrição',
            'price.required' => 'Preço',
            'discount.required' => 'Desconto',
            'price_with_discount.required' => 'Preço final',
            'product_image.mimes:jpeg,png' => 'A foto deve ser em formato jpeg ou png',            'link_wpp.required' => 'Link do whatsapp é obrigatório',

        ];
    }
}
