<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Facade\FlareClient\Http\Response;

class WishlistController extends Controller
{
    //
    public function addWishlist($id){
        $user_id = Auth::id();
        $data = array(
            'user_id' => $user_id,
            'product_id' => $id,
        );
        $check = DB::table('wishlists')->where('user_id',$user_id)->where('product_id',$id)->first();
        if(Auth::Check()){
            if($check){
				
                return \Response::json(['error'=>'Already product has on your wishlist']);
            }else{
                DB::table('wishlists')->insert($data);
                return \Response::json(['success'=>'Add to wislist successfully']);
            }
        }else{
            return \Response::json(['error'=>'At first time login account']);
        }
    }

    public function removeWishlist($id){
        $wishlist = DB::table('wishlists')->where('product_id',$id)->delete();
        $notification=array(
            'message'=>'Delete Successfully !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
}
