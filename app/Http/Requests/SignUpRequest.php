<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'txtFullName' => 'required',
            'txtEmail' => 'required|email|unique:users,email',
            'txtPass' => 'required|min:6|max:20',
            'txtRepass' => 'required|same:txtPass'
        ];
    }

    public function messages()
    {
        return [
            'txtFullName.required' => 'Vui lòng nhập Họ tên',
            'txtEmail.required' => 'Vui lòng nhập Email',
            'txtEmail.email' => 'Email không đúng định dạng',
            'txtEmail.unique' => 'Email này đã tồn tại',
            'txtPass.required' => 'Vui lòng nhập password',
            'txtPass.min' => 'Mật khẩu ít nhất 6 ký tự',
            'txtPass.max' => 'Mật khẩu nhiều nhất 20 ký tự',
            'txtRepass.required' => 'Vui lòng nhập Re passowrd',
            'txtRepass.same' => 'Vui lòng xác nhận đúng password'
        ];
    }
}
