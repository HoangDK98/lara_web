<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Admin\Newsletter;
use DB;
class FrontController extends Controller
{
    //
    public function storeNewsletter(Request $request){
        $news = new Newsletter();
        $news->email = $request->email;
        $news->save();
        $notification=array(
            'message'=>'Thank for subcribing !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
    public function deleteNewsletter(){
        Newsletter::where('id',request()->id)->delete();
        $notification=array(
            'messege'=>'Delete Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }
     public function orderTracking(){
         $code = request()->code;
         $tracking = DB::table('orders')->where('status_code',$code)->first();
         if($tracking){
            return view('pages.tracking',compact('tracking'));   
         }else{
            $notification = array(
                'messege'=>'Status code invalid !',
                'alert-type'=>'error'
            ); 
            return Redirect()->back()->with($notification);
         }
     }

}
