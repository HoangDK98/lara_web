<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Directory;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function newOrder(){
        $order = DB::table('orders')->where('status',0)->get();
        return view('admin.order.pending',compact('order'));
    }

    public function viewOrder($id){
        $order = DB::table('orders')
                ->join('users','orders.user_id','users.id')
                ->select('orders.*','users.name','users.phone')
                ->where('orders.id',$id)    
                ->first();
        $shipping = DB::table('shipping')->where('order_id',$id)->first();
        $details = DB::table('orders_details')
                ->join('products','products.id','orders_details.product_id')
                ->select('orders_details.*','products.product_code','products.image_one')
                ->where('orders_details.order_id',$id)
                ->get();
        return view('admin.order.view_order',compact('order','shipping','details'));
    }
    public function paymentAccept($id){
        DB::table('orders')->where('id',$id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Payment Accept',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.neworder')->with($notification);
    }
    public function paymentCancle($id){
        DB::table('orders')->where('id',$id)->update(['status'=> 4]);   
        $notification = array(
            'message' => 'Payment Cancle',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.neworder')->with($notification);
    }
    public function orderAccept(){
        $order = DB::table('orders')->where('status',1)->get();   
        return view('admin.order.pending',compact('order'));
    }
    public function orderCancle(){
        $order = DB::table('orders')->where('status',4)->get();   
        return view('admin.order.pending',compact('order'));
    }
    public function orderProcess(){
        $order = DB::table('orders')->where('status',2)->get();   
        return view('admin.order.pending',compact('order'));
    } public function orderDelivered(){
        $order = DB::table('orders')->where('status',3)->get();   
        return view('admin.order.pending',compact('order'));
    }
    public function acceptProcessDelevery($id){
        DB::table('orders')->where('id',$id)->update(['status'=> 2]);   
        $notification = array(
            'message' => 'Send to Delevery',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.order.accept')->with($notification);
    }
    public function acceptDeleveryDone($id){
        DB::table('orders')->where('id',$id)->update(['status'=> 3]);   
        $notification = array(
            'message' => 'Delevery Done',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.order.process')->with($notification);
    }
}
