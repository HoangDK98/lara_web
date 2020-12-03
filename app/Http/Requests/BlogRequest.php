<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'category_name_en' => 'required|unique:post_category|max:255',
            'category_name_in' => 'required|unique:post_category|max:255'
        ];
    }

    public function messages(){
        return [
            'category_name_en.unique'=>'Blog category english name already exists!',
            'category_name_en.required'=>'Blog category english name field is required !',
            'category_name_en.max'=>'Blog category english name allow no more than 255 symbols',
            'category_name_in.unique'=>'Blog category hindi name already exists!',
            'category_name_in.required'=>'Blog category hindi name field is required !',
            'category_name_in.max'=>'Blog category english hindi allow no more than 255 symbols',
        ];
    }
}
