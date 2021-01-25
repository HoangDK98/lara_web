<?php

namespace App\Http\Controllers;
use App\Model\Admin\Contact;
use Response;

use Illuminate\Http\Request;
class ContactController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function contact(){
        return view('pages.contact');
    }

    public function contactForm(Request $request){
        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        $notification=array(
            'message'=>'Send message Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }

    public function allMessage(){
        $message = Contact::get();
        return view('admin.contact.all_message',compact('message'));
    }

    public function newMessage(){
        $message = Contact::where('status',0)->get();
        return view('admin.contact.all_message',compact('message'));
    }

    public function processedMessage(){
        $message = Contact::where('status',1)->get();
        return view('admin.contact.all_message',compact('message'));
    }

    public function process($id){
        $message = Contact::where('id',$id)->first();
        $message->status =1;
        $message->save();
        $notification=array(
            'message'=>'Đã xử lý',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }


    public function viewMessage($id){
        $message = Contact::where('id',$id)->first();
        return response::json(array(
            'message' => $message,
        ));
    }
}
