<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Response;
class CartController extends Controller
{
    //
    public function addCart($id){
        $product = DB::table('products')->where('id',$id)->first();
        $data = array();
        if($product->discount_price == NULL){
            $data['price'] = $product->selling_price;   
        }else{
            $data['price'] = $product->discount_price;
        }
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = 1;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        $data['options']['color'] = '';
        Cart::add($data);
        return \Response::json(['success' => 'Product added cart sucessfully']);
    }

    public function check(){
        $content = Cart::content();
        return response()->json($content);
    }
    public function showCart(){
        $cart = Cart::content();
        return view('pages.cart',compact('cart'));
    }
    public function removeCart($rowId){
        Cart::remove($rowId);
        $notification=array(
            'messege'=>'Product remove Cart Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }
    public function updateCart(Request $request){
        Cart::update($request->rowId, $request->qty);
    }
    public function viewProduct(Request $request,$id){
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
        return response::json(array(
            'product' => $product,
            'color' => $product_color
        ));
    }

    public function insertCart(Request $request){
        $id = $request->product_id;
    
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
            'messege'=>'Product add to Cart Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }
}
