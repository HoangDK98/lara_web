<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Response;
use Auth;
use Session;
use Mail;
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
        $product = DB::table('products')->where('product_name','like',"%$result%")->paginate(1);
        return view('pages.search',compact('product','result'));

    }

    //return coupon
    public function returnCoupon(){
        
    }

    public function Order(Request $request){
        $data = array();
        $data['user_id'] = Auth::id();
        // $data['payment_id'] = $charge->payment_method;
        // $data['paying_amount'] =$charge->amount;
        // $data['balance_transaction'] =$charge->balance_transaction;
        // $data['stripe_order_id'] =$charge->metadata->order_id;
        // $data['payment_type'] =$request->payment;
        // $data['status_code'] =mt_rand(100000,999999);
        $data['total'] =Cart::subtotal();
        $data['shipping'] =$request->shipping_fee;
        
        $data['subtotal'] = Cart::subtotal();
        
        $data['status'] =0;
        $data['date'] =date('d-m-y');
        $data['month'] =date('F');
        $data['year'] =date('Y');  
        $order_id = DB::table('orders')->insertGetId($data);

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
            $detail['color'] = $item->options->color;
            $detail['quantity'] = $item->qty;
            $detail['single_price'] = $item->price;
            $detail['total_price'] = $item->price*$item->qty;
            DB::table('orders_details')->insert($detail);
        }

        //send mail


        $data['info'] = $request->all();
        // dd($data['info']);
        $email = $request->email;
        $data['carts'] = Cart::content();
        $data['total'] = Cart::total();

        Mail::send('pages.email', $data, function ($message) use ($email) {
            $message->from('doanhoang4598@gmail.com', 'Onehit');
            $message->to($email, $email);
            // $message->cc('hoang93861@nuce.edu.vn', 'Hoang93861');
            $message->subject('Xác nhân mua hàng shop OneHit');
        });
        Cart::destroy();
        
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $notification = array(
            'message' => 'Order process successfully done !',
            'alert-type' => 'success',
        );
        return Redirect()->to('/')->with($notification);
    }
}
