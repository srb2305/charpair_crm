<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Role;
use App\User;
use App\lead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LeadTaskController extends Controller
{
    
	public function taskIndex(){
    
        return view('admin/task_generate');
    }


    public function generateTask(Request $request){
    
        $empid=$request['emp_id'];
   		$start_date=$request['start_date'];
   		$end_date=$request['end_date'];
   		$lead_idfrom=$request['lead_idfrom'];
   		$lead_idto=$request['lead_idto'];
        // dd($lead_idto);
   		// $start_date=date('d/m/Y',strtotime($start_date));
   		// $end_date=date('d/m/Y',strtotime($end_date));
   		$adminid = Auth::id();

   		$check=User::where('id',$empid)->first();

   		if (!empty($check)) {
   			$insert=[
    			'user_id' => $empid,
    			'date_from' => $start_date,
    			'date_to' => $end_date,
    			'lead_from' => $lead_idfrom,
    			'lead_to' => $lead_idto,
    			'assign_by' => $adminid
    		  ];
    		DB::table('lead_task')->insert($insert);
    		return redirect()->back()->with('message', 'Task Generate Successfully');
   		} else {
   			return redirect()->back()->with('error', 'Employee Not Found');
   		}
   		
    }
}
