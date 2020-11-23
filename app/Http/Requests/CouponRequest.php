<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon' => 'required|unique:coupons|max:255'
        ];
    }

    public function messages(){
        return [
            'coupon.unique'=>'Coupon name already exists!',
            'coupon.required'=>'Coupon name field is required !',
            'coupon.max'=>'Coupon name allow no more than 255 symbols',
        ];
    }
}
