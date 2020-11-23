<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Newsletter;

class NewsletterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Coupon(){
        $newsletter = Newsletter::all();
        return view('admin.newsletter.newsletter',compact('newsletter'));
    }   
}
