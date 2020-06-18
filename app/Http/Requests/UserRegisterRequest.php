<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:tb_users',
            'name' => 'required|string|max:50',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email é obrigatório!',
            'name.required' => 'Nome é Obrigatório!',
            'password.required' => 'Senha é obrigatório!'
        ];
    }
}
