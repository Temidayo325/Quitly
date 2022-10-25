<?php

namespace App\Http\Requests\User;

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
             'name' => 'required|string',
             'email' => 'required|unique:users,email|email:rfc,dns',
             'institution' => 'required|string',
             'nickname' => 'required|unique:users,nickname',
             'password' => 'required|string'
        ];
    }
}
