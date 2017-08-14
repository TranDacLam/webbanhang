<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'txtName' => 'required|unique:products,name',
            'txtUnitPrice' => 'required|integer|digits_between:1,10',
            'txtPromotionPrice' => 'integer',
            'txtUnit' => 'required',
            'fileImagePro' => 'required|image|mimes:png,jpg,jpeg,bmp'
        ];
    }

    public function messages()
    {
        return [
            'txtName.required' => 'Vùi lòng nhập tên sản phẩm',
            'txtName.unique' => 'Tên sản phẩm này đã tồn tại',
            'txtUnitPrice.required' => 'Vùi lòng nhập đơn giá',
            'txtUnitPrice.required' => 'Đơn giá là số nguyên',
            'txtUnitPrice.integer' => 'Đơn giá phải là số',
            'txtPromotionPrice.integer' => 'Giá khuyến mãi phải là số',
            'txtUnit.required' => 'Vui lòng nhập đơn vị',
            'fileImagePro.required' => 'Vui lòng chọn ảnh',
            'fileImagePro.image' => 'Vui lòng chọn đúng định dạng',
            'fileImagePro.mimes' => 'Vui lòng chọn các định dạng ảnh: png, jpg, jpeg, bmp'
        ];
    }
}
