<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required|min:5|regex:/^([^0-9]*)$/',
            'email' => 'required|min:5|email',
            'password' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.min'=>'Tên không được quá ngắn',
            'name.regex'=>'Tên không được chứa ký tự đặc biệt',
            'email.required' => 'Email không được để trống',
            'email.min' => 'Email không được quá ngắn',
            'email.email' => 'Email không đúng định dạng',

            'password.required' => 'Mật khẩu không được để trống',

            'password.min'=>'Mật khẩu không được quá ngắn',

        ];
    }
}
