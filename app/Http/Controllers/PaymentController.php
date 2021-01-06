<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cart;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
class PaymentController extends Controller
{
    //
    public function payment(Request $request){
        $data =array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;

        if($data['payment'] == 'stripe'){
            return view('pages.payment.stripe',compact('data'));
        }else if($data['payment'] == 'paypal'){
            return view('pages.payment.paypal');
        }else{
            Echo "Cash on delivery";
        }
    }

    public function stripeCharge(Request $request){
        $total = $request->total;
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51I06KaGbDXsGpiFj0FLO1jjZrP0sJNuiDixFbQ4cjxDDEkN7XHe4g6JVthHkwJ9YqN6s4WpGVz2NTcGYjef0WMkx00H3g1LYq9');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total,
        'currency' => 'vnd',
        'description' => 'Example charge',
        'source' => $token,
        'statement_descriptor' => 'Custom descriptor',
        'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);
        //insert orders table
        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] =$charge->amount;
        $data['balance_transaction'] =$charge->balance_transaction;
        $data['stripe_order_id'] =$charge->metadata->order_id;
        $data['total'] =$request->total;
        $data['shipping'] =$request->shipping_fee;
        $data['payment_type'] =$request->payment;
        $data['status_code'] =mt_rand(100000,999999);
        if(Session::has('coupon')){
            $data['subtotal'] = Cart::subtotal() - Session::get('coupon')['discount']/100*Cart::subtotal();
        }else{
            $data['subtotal'] = Cart::subtotal();
        }
        $data['status'] =0;
        $data['date'] =date('y-m-d');
        $data['month'] =date('F');
        $data['year'] =date('Y');  
        $order_id = DB::table('orders')->insertGetId($data);
        
        //insert shipping table 
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
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

        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $notification = array(
            'messege' => 'Order process successfully done !',
            'alert-type' => 'success',
        );
        return Redirect()->to('/')->with($notification);
    }

    public function successList(){
        $order = DB::table('orders')->where('user_id',Auth::id())
            ->where('status',3)->orderBy('id','DESC')->limit(5)->get();
        return view('pages.return_order',compact('order'));
    }
}
