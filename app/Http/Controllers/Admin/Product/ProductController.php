<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use DB;
use Image;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('brands','products.brand_id','brands.id')
                    ->select('products.*','categories.category_name','brands.brand_name')
                    ->get();
        return view('admin.product.index_product',compact('product'));
    }

    public function createProduct(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.create_product',compact('category','brand'));
    }

    public function getSubCate($category_id){
        $cate = DB::table('subcategories')->where('category_id',$category_id)->get();
        return json_encode($cate);
    }

    public function storeProduct(ProductRequest $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['discount_price'] = $request->discount_price;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['main_slider'] = $request->main_slider;
        $data['mid_slider'] = $request->mid_slider;

        $data['hot_deal'] = $request->hot_deal;  
        $data['status'] = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if($image_one && $image_two && $image_three){
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('media/product/'.$image_one_name);
            $data['image_one'] = 'media/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('media/product/'.$image_two_name);
            $data['image_two'] = 'media/product/'.$image_two_name;

            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('media/product/'.$image_three_name);
            $data['image_three'] = 'media/product/'.$image_three_name;
        }
        $product = DB::table('products')->insert($data);
        $notification=array(
            'message'=>'Added Successfully !',
            'alert-type'=>'success'
            );

        return Redirect()->back()->with($notification);

    }

    public function activeProduct ($id){
        $qty = DB::table('products')->where('id',$id)->first()->product_quantity;
        if($qty == 0){
            $notification=array(
                'message'=>'Vui lòng thêm sản phẩm trước khi Active',
                'alert-type'=>'error'
                );
    
            return Redirect()->back()->with($notification);
        }else{
            DB::table('products')->where('id',$id)->update(['status'=>1]);
            $notification=array(
                'message'=>'Product Successfully Active !',
                'alert-type'=>'success'
                );
    
            return Redirect()->back()->with($notification);
        }
    }

    public function inactiveProduct ($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        $notification=array(
            'message'=>'Product Successfully Inactive !',
            'alert-type'=>'success'
            );

        return Redirect()->back()->with($notification);
    }

    public function deleteProduct($id){
        $product = DB::table('products')->where('id',$id)->first();
        $image_one = $product->image_one;
        $image_two = $product->image_two;
        $image_three = $product->image_three;
        if($image_one != NULL){
            unlink($image_one);
        }
        if($image_two != NULL){
            unlink($image_two);
        }
        if($image_three != NULL){
            unlink($image_three);
        }

        DB::table('products')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Product Successfully Deleted !',
            'alert-type'=>'success'
            );

        return Redirect()->back()->with($notification);  
    }

    public function viewProduct($id){
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->join('brands','products.brand_id','brands.id')
                    ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name')
                    ->where('products.id',$id)
                    ->first();

        return view("admin.product.show_product",compact('product'));
    }

    public function editProduct($id){
        $product = DB::table('products')->where('id',$id)->first();
        return view('admin.product.edit_product',compact('product'));
    }
    public function updateWithoutImg(Request $request,$id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['main_slider'] = $request->main_slider;
        $data['mid_slider'] = $request->mid_slider;

        $data['hot_deal'] = $request->hot_deal; 
        $update = DB::table('products')->where('id',$id)->update($data);
        if($update){
            $notification=array(
                'message'=>'Product Successfully Updated !',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.all')->with($notification);
        } else{
            $notification=array(
                'message'=>'Nothing to update !',
                'alert-type'=>'error'
            );
            return Redirect()->route('product.all')->with($notification);
        }

    }
    public function updateImg(Request $request,$id){
        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;

        $data = array();
       
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if($image_one){
            // unlink($old_one);
            $image_name = $request->brand_name .'_'. date('dmy_H_s_i').'.'.$image_one->getClientOriginalExtension();
            $upload_path ='media/product/'; 
            $img_url = $upload_path.$image_name;
            $success = $image_one ->move($upload_path,$image_name); 
            //add data
            $data['image_one'] = $img_url;

            $product = DB::table('products')->where('id',$id)->update($data);
            
            $notification=array(
                'message'=>'Image One Update Successfully !',
                'alert-type'=>'success'
                );
            return Redirect()->route('product.all')->with($notification);
        }
        if($image_two){
            // unlink($old_two);
            $image_name = $request->brand_name .'_'. date('dmy_H_s_i').'.'.$image_two->getClientOriginalExtension();
            $upload_path ='media/product/'; 
            $img_url = $upload_path.$image_name;
            $success = $image_two ->move($upload_path,$image_name); 
            //add data
            $data['image_two'] = $img_url;

            $product = DB::table('products')->where('id',$id)->update($data);
            
            $notification=array(
                'message'=>'Image Two Update Successfully !',
                'alert-type'=>'success'
                );
            return Redirect()->route('product.all')->with($notification);
        }
        if($image_three){
            // unlink($old_three);
            $image_name = $request->brand_name .'_'. date('dmy_H_s_i').'.'.$image_three->getClientOriginalExtension();
            $upload_path ='media/product/'; 
            $img_url = $upload_path.$image_name;
            $success = $image_three ->move($upload_path,$image_name); 
            //add data
            $data['image_three'] = $img_url;

            $product = DB::table('products')->where('id',$id)->update($data);
            
            $notification=array(
                'message'=>'Image Three Update Successfully !',
                'alert-type'=>'success'
                );
            return Redirect()->route('product.all')->with($notification);
        }
    }
}
