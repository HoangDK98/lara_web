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
    public function viewSubProduct($id){
        $product = DB::table('products')->where('subcategory_id',$id)->paginate(5);
        $all_product = DB::table('products')->where('subcategory_id',$id)->get();
        $category = DB::table('categories')->get();
        $brands = DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
        $subcategory = DB::table('subcategories')->where('id',$id)->first();
        $sub_name = $subcategory->subcategory_name;

        return view('pages.sub_products',compact('product','category','brands','all_product','sub_name'));
    }
    public function viewCateProduct($id){
        $product = DB::table('products')->where('products.category_id',$id)->paginate(5);
        $category = DB::table('categories')->where('id',$id)->first();
        $cate_name = $category->category_name;
        $all_product = DB::table('products')->where('category_id',$id)->get();
        return view('pages.cate_products',compact('product','all_product','cate_name'));
    }
}
