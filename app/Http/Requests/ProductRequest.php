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
            'discount' => 'Desconto'
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
            'store_id.required' => ' O campo :attribute é obrigatório',
            'product_name.required' => 'O campo :attribute é obrigatório',
            'description.required' => 'O campo :attribute é obrigatório',
            'price.required' => 'O campo :attribute é orbigatório',
            'discount.required' => 'O campo :attribute é obrigatório'
        ];
    }
}
