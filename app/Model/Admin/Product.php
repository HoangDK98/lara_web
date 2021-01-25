<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'brand_id',
        'product_name',
        'product_code',
        'product_quantity',
        'product_details',
        'selling_price',
        'discount_price',
        'main_slider',
        'hot_deal',
        'mid_slider',
        'image_one',
        'image_two',
        'image_three',
        'status',
    ];
}
