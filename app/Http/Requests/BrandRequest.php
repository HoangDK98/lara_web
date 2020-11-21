<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'brand_name' => 'required|unique:brands|max:255'
        ];
    }

    public function messages(){
        return [
            'brand_name.unique'=>'Brand name already exists!',
            'brand_name.required'=>'Brand name field is required !',
            'brand_name.max'=>'Brand name allow no more than 255 symbols',
        ];
    }
}
