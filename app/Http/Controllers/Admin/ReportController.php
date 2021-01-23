<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;

class ReportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allReport(){
        $report = DB::table('orders')
        ->join('orders_details','orders_details.order_id','orders.id')
        ->join('products','products.id','orders_details.product_id')
        ->select('orders.*','products.product_name','products.image_one')
        ->get();
        return view('admin.report.all_report',compact('report')); 
    }
    public function searchReport(){
        return view('admin.report.search');
    }
    public function getResultReport(Request $request){
        $date1 =$request->all()['date1'];
        $date2 =$request->all()['date2'];
        $date2 =$request->all()['date2'];
 	    $newdate1 = date('d-m-y',strtotime($date1));
 	    $newdate2 = date('d-m-y',strtotime($date2));

        $report = DB::table('orders_details')
        ->join('orders','orders_details.order_id','orders.id')
        ->join('products','products.id','orders_details.product_id')
        ->select('orders.*','products.product_name','products.image_one')
        ->whereBetween('date',[$newdate1,$newdate2])
        ->get();

        return response::json(array(
            'report' => $report,
        ));
    }
}
