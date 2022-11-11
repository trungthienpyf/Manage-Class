<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'phone' => 'required|unique:App\Models\Teacher,phone|min:10',
            'name' => 'required|min:5',
            'password' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => 'Số điện thoại không được để trống',
            'name.required' => 'Tên không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'name.min'=>'Tên không được quá ngắn',
            'phone.min'=>'Vui lòng nhập đúng số điện thoại',
            'password.min'=>'Mật khẩu không được quá ngắn',
            'phone.unique'=>'Số điện thoại đã tồn tại',
        ];
    }
}
