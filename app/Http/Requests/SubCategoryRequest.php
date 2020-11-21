<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'subcategory_name' => 'required|unique:subcategories|max:255'
        ];
    }

    public function messages(){
        return [
            'subcategory_name.unique'=>' Sub category name already exists!',
            'subcategory_name.required'=>'Sub category name field is required !',
            'subcategory_name.max'=>'Sub category name allow no more than 255 symbols',
        ];
    }
}
