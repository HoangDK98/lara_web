<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Admin\Newsletter;

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
            'message'=>'Delete Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }

}
