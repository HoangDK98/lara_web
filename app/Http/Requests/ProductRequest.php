<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'product_name' => 'required|unique:products|max:255',
            'product_code' => 'required|unique:products|max:255',
            'product_quantity' => 'required:products|max:255',
            'category_id' => 'required:products|max:255',
            'subcategory_id' => 'required:products|max:255',
            'brand_id' => 'required:products|max:255',
            'product_details' => 'required:products',
            'selling_price' => 'required:products|max:255',
            'image_one' => 'required:products',
            'image_two' => 'required:products',
            'image_three' => 'required:products',
        ];
    }

    public function messages(){
        return [
            'product_name.unique'=>'Product name already exists!',
            'product_name.required'=>'Product name field is required !',
            'product_name.max'=>'Product name allow no more than 255 symbols',

            'product_code.unique'=>'Product code already exists!',
            'product_code.required'=>'Product code field is required !',
            'product_code.max'=>'Product code allow no more than 255 symbols',

            'product_quantity.required'=>'Product quantity field is required !',
            'product_quantity.max'=>'Product quantity allow no more than 255 symbols',

            'category_id.required'=>'Category field is required !',
            'category_id.max'=>'Category allow no more than 255 symbols',

            'subcategory_id.required'=>'Subcategory field is required !',
            'subcategory_id.max'=>'Subcategory allow no more than 255 symbols',

            'brand_id.required'=>'Brand field is required !',
            'brand_id.max'=>'Brand allow no more than 255 symbols',

            'product_details.required'=>'Product details field is required !',

            'selling_price.required'=>'Selling price field is required !',
            'selling_price.max'=>'Selling price allow no more than 255 symbols',

            'image_one.required'=>'Image one field is required !',
            'image_one.max'=>'Image one allow no more than 255 symbols',

            'image_two.required'=>'Image two field is required !',

            'image_three.required'=>'Image three field is required !',
        ];
    }
}
