<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
class ProductController extends Controller
{
    //
    public function productDetail($id,$product_name){

        $product = DB::table('products')
                ->join('subcategories','subcategories.id','products.subcategory_id')
                ->join('categories','categories.id','products.category_id')
                ->join('brands','brands.id','products.brand_id')
                ->select('products.*','brands.brand_name','categories.category_name','subcategories.subcategory_name')
                ->where('products.id',$id)
                ->first();
        $color = $product->product_color;
        // add array color
        $product_color = explode(',',$color);
        return view('pages.products_detail',compact('product','product_color'));
    }

    public function addCart($id,Request $request){
        $product = DB::table('products')->where('id',$id)->first();
        $data = array();
        if($product->discount_price == NULL){
            $data['price'] = $product->selling_price;   
        }else{
            $data['price'] = $product->discount_price;
        }
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = $request->qty;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        $data['options']['color'] = $request->color;
        Cart::add($data);
         
        $notification=array(
            'messege'=>'Product Added Successfully!',
            'alert-type'=>'success'
            );

        return Redirect()->back()->with($notification);
    }
}
