<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required|min:10|max:11'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vùi lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Vui lòng nhập số điện thoại ít nhất 10 số',
            'phone.max' => 'Vui lòng nhập số điện thoại nhiều nhất 11 số'
        ];
    }
}
