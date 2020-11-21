<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_name' => 'required|unique:categories|max:255'
        ];
    }

    public function messages(){
        return [
            'category_name.unique'=>'Category name already exists!',
            'category_name.required'=>'Category name field is required !',
            'category_name.max'=>'Category name allow no more than 255 symbols',
        ];
    }
}
