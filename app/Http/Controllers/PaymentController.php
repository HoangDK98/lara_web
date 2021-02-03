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

    public function stripeCharge(Request $request,$id){
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51I06KaGbDXsGpiFj0FLO1jjZrP0sJNuiDixFbQ4cjxDDEkN7XHe4g6JVthHkwJ9YqN6s4WpGVz2NTcGYjef0WMkx00H3g1LYq9');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        
        $total = DB::table('payments')->where('id',$id)->first()->total;
        $charge = \Stripe\Charge::create([
        'amount' => $total,
        'currency' => 'vnd',
        'description' => 'Example charge',
        'source' => $token,
        'statement_descriptor' => 'Custom descriptor',
        // 'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);
        DB::table('payments')->where('id',$id)->update(['type'=>1]);
        DB::table('payments')->where('id',$id)->update(['status'=>1]);
        
        $notification = array(
            'message' => 'Payment Successfully done !',
            'alert-type' => 'success',
        );
        return Redirect()->to('/')->with($notification);
    }


}
