<?php

namespace App\Http\Requests;

use App\Models\RegisterTeach;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use function PHPUnit\Framework\at;

class StoreRegisterTeachRequest extends FormRequest
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
            'shift'=>Rule::unique(RegisterTeach::class)->where(
                function ($query)  {
                    return $query->where(
                        [
                            ["weekdays", "=", $this->weekdays],
                            ["shift", "=", $this->shift],
                            ["teacher_id", "=", auth()->user()->id],
                        ]
                    );
                })
        ];
    }
    public function messages()
    {
        return [
            'shift.unique' => 'Ca và ngày dạy đã được đăng ký',
        ];
    }
}
