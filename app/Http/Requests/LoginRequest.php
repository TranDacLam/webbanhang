<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'txtEmail' => 'required|email',
            'txtPassword' => 'required|min:6|max:20'
        ];
    }

    public function messages()
    {
        return [
            'txtEmail.required' => 'Vùi lòng nhập Email',
            'txtEmail.email' => 'Email không đúng định dạng',
            'txtPassword.required'  => 'Vui lòng nhập Password',
            'txtPassword.min' => 'Mật khẩu ít nhất 6 ký tự',
            'txtPassword.max' => 'Mật khẩu nhiều nhất 20 ký tự'
        ];
    }
}
