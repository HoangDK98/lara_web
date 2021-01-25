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
        return view('pages.products_detail',compact('product'));
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
        Cart::add($data);
         
        $notification=array(
            'message'=>'Product Added Successfully!',
            'alert-type'=>'success'
            );

        return Redirect()->back()->with($notification);
    }
    public function viewSubProduct($id){
        $product = DB::table('products')->where('subcategory_id',$id)->paginate(10);
        $all_product = DB::table('products')->where('subcategory_id',$id)->get();
        $category = DB::table('categories')->get();
        $brands = DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
        $subcategory = DB::table('subcategories')->where('id',$id)->first();
        $sub_name = $subcategory->subcategory_name;

        return view('pages.sub_products',compact('product','category','brands','all_product','sub_name'));
    }
    public function viewCateProduct($id){
        $product = DB::table('products')->where('products.category_id',$id)->paginate(10);
        $category = DB::table('categories')->where('id',$id)->first();
        $subcategory = DB::table('subcategories')->where('category_id',$id)->get();
        $brand_ids = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
        $cate_name = $category->category_name;
        $all_product = DB::table('products')->where('category_id',$id)->get();
        return view('pages.cate_products',compact('product','all_product','cate_name','subcategory','brand_ids'));
    }

    public function viewBrandProduct($id){
        $product = DB::table('products')->where('products.brand_id',$id)->paginate(10);
        $cate_id = DB::table('products')->where('brand_id',$id)->select('category_id')->groupBy('category_id')->get();  
        $subcate_id = DB::table('products')->where('brand_id',$id)->select('subcategory_id')->groupBy('subcategory_id')->get();  
        $all_product = DB::table('products')->where('brand_id',$id)->get();
        $brand_name = DB::table('brands')->where('id',$id)->first()->brand_name;
        return view('pages.brand_product',compact('product','all_product','subcate_id','cate_id','brand_name'));
    }
}
