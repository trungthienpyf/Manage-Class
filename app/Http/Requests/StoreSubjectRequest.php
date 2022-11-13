<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'name' => 'required|min:5|unique:App\Models\Subject,name',
            'price' => 'required|min:6|numeric',
        ];
    }
    public function messages()
    {
        return [
            'price.required' => 'Giá không được để trống',
            'name.required' => 'Tên không được để trống',
            'price.min' => 'Giá không được ít hơn 100,000 vnđ',
            'name.min'=>'Tên không được quá ngắn',
            'price.numeric'=>'Vui lòng nhập giá là số tiền',
            'name.unique'=>'Tên chương trình đã tồn tại',
        ];
    }
}
