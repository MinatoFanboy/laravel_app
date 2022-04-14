<?php

namespace App\Http\Requests\Menu;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('menus')->where(function ($query) {
                    return $query->where('active', 1);
                })
            ],
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục đã được sử dụng',
        ];
    }
}
