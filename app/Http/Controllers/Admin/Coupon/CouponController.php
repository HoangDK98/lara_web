<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Coupon;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Coupon(){
        $coupon = Coupon::all();
        return view('admin.coupon.coupon',compact('coupon'));
    }

    public function storeCoupon(CouponRequest $request){
        $coupon = new Coupon();
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();
        $notification=array(
            'message'=>'Added Successfully !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
    public function deleteCoupon(){
        Coupon::where('id',request()->id)->delete();
        $notification=array(
            'message'=>'Delete Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }

    public function editCoupon(){
        $coupon = Coupon::where('id',request()->id)->first();
        return view('admin.coupon.edit_coupon',compact('coupon'));
        
    }
    public function updateCoupon(CouponRequest $request,$id){
        $coupon = Coupon::where('id',$request->id)->first();
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->update();
        $notification=array(
            'message'=>'Update Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->route('coupons')->with($notification);
    }
}

