<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name'=>'required|unique:categories,name,'.$this->id
        ];
    }
    public function messages():array{
        return [
            'name.required'=>'Vui lòng điền tên danh mục',
            'name.unique'=>"$this->name đã tồn tại",
        ];
    }
}
