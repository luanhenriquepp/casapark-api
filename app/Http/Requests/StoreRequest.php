<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'link_wpp' => 'required',
            'store_name' => 'required',
            'store_image' => 'required',
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
            'link_wpp'      => 'Link do WhatsApp',
            'store_name'    => 'Nome da Loja'
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
            'link_wpp.required' => 'Link do whatsapp é obrigatório',
            'store_name.required' => 'Nome da loja é obrigatório'
        ];
    }
}
