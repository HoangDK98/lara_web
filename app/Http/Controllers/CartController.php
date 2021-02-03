<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Response;
use Auth;
use Session;
use Mail;
use App\Model\Admin\Order;
use phpDocumentor\Reflection\Types\Null_;

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
            'message'=>'Remove Item Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }

    public function deleteCart(){
        Cart::destroy();
        $notification=array(
            'message'=>'Remove Cart Successfully !',
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

        return response::json(array(
            'product' => $product,
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
        Cart::add($data);
        $notification=array(
            'message'=>'Product add to Cart Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }
    public function checkout(){
        if(Auth::check()){
            $cart = Cart::content();
            return view('pages.checkout',compact('cart'));
        }else {
            $notification = array(
                'message' =>'At first Login Your Account ',
                'alert-type' => 'warning'
            );
            return Redirect()->route('login')->with($notification);
        }
    }
    public function wishlist(){
        $id = Auth::id();
        $wishlist = DB::table('wishlists')
                    ->join('products','products.id','wishlists.product_id')
                    ->select('products.*','wishlists.user_id')
                    ->where('user_id',$id)
                    ->get();
        // return Response()->json($wishlist);
        return view('pages.wishlist',compact('wishlist'));
    }
    public function applyCoupon(){
        $coupon = request()->coupon;
        $check = DB::table('coupons')->where('coupon',$coupon)->first();

        if($check){
            Session::put('coupon',[
                'name' => $check->coupon ,
                'discount' => $check->discount,
                // 'binance' => Cart::subtotal() - $check->discount/100*Cart::subtotal()
            ]);
            $notification = array(
                'message' =>'Applied successfully coupon ',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' =>'Invalid coupon ',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function cancleCoupon(){
        Session::forget('coupon');
    }

    public function payment(){
        $cart = Cart::content();
        return view('pages.payment',compact('cart'));
    }

    public function searchProduct(Request $request){
        $result = $request->search;
        $product = DB::table('products')->where('product_name','like',"%$result%")->get();
        return view('pages.search',compact('product','result'));
    }

    //return coupon
    public function returnCoupon(){
        
    }

    public function Order(Request $request){
        $coupon_id =$request->coupon_id;
        $fee_service = DB::table('services')->where('id',$request->service_id)->first()->shipping_charge;
        $order = new Order();
        $order->user_id = Auth::id();
        $order->subtotal = Cart::subtotal();
        $order->service_id =$request->service_id;
        if($coupon_id != 0){
            $order->coupon_id = $coupon_id;
            $discount = DB::table('coupons')->where('id',$coupon_id)->first()->discount;
            $order->total = Cart::subtotal() + $fee_service - $discount*Cart::subtotal()/100;
        } else{
            $order->total = Cart::subtotal() + $fee_service;
        }
        
        $order->status =0;
        $order->date =date('d-m-y');
        $order->month =date('F');
        $order->year =date('Y');  
        $order->save();
        // subtract quantity in product table
        $order_id = $order->id;
        //insert shipping table 
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->name;
        $shipping['ship_phone'] = $request->phone;
        $shipping['ship_email'] = $request->email;
        $shipping['ship_address'] = $request->address;
        $shipping['ship_city'] = $request->city;
        DB::table('shipping')->insert($shipping);  

        //insert order detail table

        $content = Cart::content();
        $detail = array();
        foreach($content as $item){
            $detail['order_id'] = $order_id;
            $detail['product_id'] = $item->id;
            $detail['product_name'] = $item->name;
            $detail['quantity'] = $item->qty;
            $detail['single_price'] = $item->price;
            $detail['total_price'] = $item->price*$item->qty;
            DB::table('orders_details')->insert($detail);

            DB::table('products')->where('id',$item->id)->decrement('product_quantity', $item->qty);
            $product = DB::table('products')->where('id',$item->id)->first();
            if($product->product_quantity == 0){
                DB::table('products')->where('id',$item->id)->update(['status'=>0]);
            }
        }

        //send mail

        $data=array();
        $data['info'] = $request->all();
        // dd($data['info']);
        $email = $request->email;
        $data['carts'] = Cart::content();
        $data['service'] = $fee_service;
        if($order->coupon_id == NULL){
            $data['coupon'] = 0;
        }else{
            $data['coupon'] = DB::table('coupons')->where('id',$order->coupon_id)->first()->discount;
        }
        $data['total'] = $order->total;

        Mail::send('pages.email', $data, function ($message) use ($email) {
            $message->from('doanhoang4598@gmail.com', 'Onehit');
            $message->to($email, $email);
            // $message->cc('hoang93861@nuce.edu.vn', 'Hoang93861');
            $message->subject('Xác nhân mua hàng shop OneHit');
        });
        Cart::destroy();
        
        $notification = array(
            'message' => 'Order process successfully done !',
            'alert-type' => 'success',
        );

        $payment =array();
        $payment['order_id'] = $order_id;
        $payment['type'] = 0;
        $payment['status'] = 0;
        $payment['total'] = $order->total;

        $payment_id = DB::table('payments')->insertGetId($payment);
        

        if($request->payment == 0 || $request->payment == null){
            return Redirect()->to('/')->with($notification);
        }else{
            return view('pages.payment.stripe',compact('payment_id'));
        }
    }
}
