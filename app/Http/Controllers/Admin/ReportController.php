<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
// use Facade\FlareClient\Http\Response;
use Response;

class ReportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function todayReport(){
        $today = date('d-m-y');
        $r_today = DB::table('orders')->where('status',0)->where('date',$today)->get();
        return view('admin.report.today_report',compact('r_today')); 
    }
    public function deliveryToday(){
        $today = date('d-m-y');
        $deli_today = DB::table('orders')->where('status',3)->where('date',$today)->get();
        return view('admin.report.delivery_today',compact('deli_today')); 
    }
    public function monthReport(){
        $month = date('F');
        $r_month = DB::table('orders')->where('status',3)->where('month',$month)->get();
        return view('admin.report.this_month',compact('r_month')); 
    }
    public function viewReport(){
        return view('admin.report.search');
    }
    public function searchReport(Request $request){
        $date1 =$request->all()['date1'];
        // $d1=substr($date1,2);
        $date2 =$request->all()['date2'];
        // $d2=substr($date2,2);
        $date2 =$request->all()['date2'];
 	    $newdate1 = date('d-m-y',strtotime($date1));
 	    $newdate2 = date('d-m-y',strtotime($date2));

        $report = DB::table('orders')->whereBetween('date',[$newdate1,$newdate2])->get();
        return response::json(array(
            'report' => $report,
        ));
    }
}
