<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:products,name,'.$this->id,
            'price'=>'required|unique:products,name,'.$this->id

        ];
    }
    public function messages():array{
        return [
            'name.required'=>'Vui lòng điền tên sản phẩm',
            'name.unique'=>"$this->name đã tồn tại",

          
        ];
    }
}
