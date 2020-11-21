<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
class BrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function brand(){
        $brand = Brand::all();
        return view('admin.category.brand',compact('brand'));
    }

    public function storeBrand(BrandRequest $request){
        $brand = new Brand();

        $image = $request->file('brand_logo');
        $brand->brand_name = $request->brand_name;
        if($image){
            $image_name = $request->brand_name .'_'. date('dmy_H_s_i').'.'.$image->getClientOriginalExtension();
            $upload_path ='media/brand/'; 
            $img_url = $upload_path.$image_name;
            $success = $image ->move($upload_path,$image_name); 
            //add logo  
            $brand->brand_logo = $img_url;
            $brand->save();
            $notification=array(
                'message'=>'Added Successfully !',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Brand logo not empty !',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
        }  
    }

    public function deleteBrand($id){
        $brand = Brand::where('id',$id)->first();
        $image = $brand->brand_logo;
        unlink($image);
        $brand->delete();
        $notification=array(
            'message'=>'Delete Successfully !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    public function editBrand($id){
        $brand = Brand::where('id',$id)->first();
        return view('admin.category.edit_brand',compact('brand'));
    }

    public function updateBrand(BrandRequest $request,$id){
        $old_logo = $request->old_logo;
        $brand = Brand::find($id);
        $image = $request->file('brand_logo');
        if($request->hasFile('brand_logo')){
            unlink($old_logo);
            $image_name = $request->brand_name .'_'. date('dmy_H_s_i').'.'.$image->getClientOriginalExtension();
            $upload_path ='media/brand/'; 
            $img_url = $upload_path.$image_name;
            $success = $image ->move($upload_path,$image_name); 
            //add data
            $brand->brand_name = $request->brand_name;
            $brand->brand_logo = $img_url;

            $brand->save();
            $notification=array(
                'message'=>'Update Successfully !',
                'alert-type'=>'success'
                );
            return Redirect()->route('brands')->with($notification);
        } else{
            $brand->brand_name = $request->brand_name;
            $brand->save();
            $notification=array(
                'message'=>'It is Ok!',
                'alert-type'=>'success'
                );
            return Redirect()->route('brands')->with($notification);
        }     

    }
}
