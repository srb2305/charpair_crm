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
        
        $data=User::get();
        return view('admin/task_generate', compact('data'));
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

    public function Index(){
        
        return view('admin/status');
    }
    public function create(){
        
        return view('admin/status_add');
    }
    public function statusAdd(Request $request){
        
        $date=$request['date'];
        $title=$request['title'];
        $description=$request['description'];
        $status=$request['status'];
        // $comment=$request['comment'];
      
        $date=Carbon::parse($date)->format('Y-m-d');
        
        $userid = Auth::id();
        $insert=[
          'user_id' => $userid,
          'date' => $date,
          'title' => $title,
          'description' => $description,
          'status' => $status
          ];
        DB::table('status_update')->insert($insert);
        return redirect('status_update')->with('message', 'Status Update Successfully');
    }

    public function statusTableData(Request $request){
       ## Read value

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';
        
        $user= Auth::User();
        $role=$user->role_id;
        if ($role==1) {
          $check= DB::table('status_update')->leftJoin('users', function($join) {
         $join->on('status_update.user_id', '=', 'users.id');});
        } else {
           $userid = Auth::id();
            $check= DB::table('status_update')->leftJoin('users', function($join) {
             $join->on('status_update.user_id', '=', 'users.id');})->where('user_id',$userid);
        }
        
       

         // $check = DB::table('status_update')->where('id','!=',0);
        if (!empty($check)) {

        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('status_update.id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('status_update.title', 'like', '%'.$searchQuery.'%')
                  ->orWhere('status_update.status', 'like', '%'.$searchQuery.'%');
            });
                }
        

## Total number of records with filtering

        $totalRecords = $check->count();
        $totalRecordwithFilter = $check->count();

## Fetch records
        $check->skip($row);
        $check->take($rowperpage);
        $record =  $check->get([
                    'status_update.id',
                    'status_update.date',
                    'status_update.title',
                    'status_update.description',
                    'users.name as username',
                    'status_update.status'
                ]);
        $data = array();

        foreach ($record as $key=>$row ) {
    
            $id = $row->id;
            $userid = $row->username;
            $title = $row->title;
            $description = $row->description;
            $date = $row->date;
            if ($row->status==0) {
                $status = '<a href="'.route('dailystatus',[$id]).'"class="btn btn-info">Pending</a>';
                } else {
                    $status = '<a href="'.route('dailystatus',[$id]).'"class="btn btn-success">Complete</a>';
                }

            
            $data[] = array(
                'id'=>$key+1,
                'date'=>Carbon::parse($date)->format('d-M-Y'),
                'user'=>$userid,
                'title'=>$title,
                'description'=>$description,
                'status'=>$status,
                'action'=> "<a style='float: left; color: red;' data-role-id=\"".$id."\" href=\"javascript:;\" onclick=\"deleteThis(".$id.");\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Delete\">
                    <div class=\"icon-container\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-trash-2\">
                            <polyline points=\"3 6 5 6 21 6\"></polyline>
                            <path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path>
                            <line x1=\"10\" y1=\"11\" x2=\"10\" y2=\"17\"></line>
                            <line x1=\"14\" y1=\"11\" x2=\"14\" y2=\"17\"></line>
                        </svg>
                    </div> 
                </a>",
                );
            
        }
## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return json_encode($response);
       }else{
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => []
        );

        return json_encode($response);
       }
       
    }

    public function dailystatus($id){
        $data=DB::table('status_update')->where('id',$id)->first();
        if($data->status==0){

            DB::table('status_update')->where('id',$id)->update(['status' => '1']);
        }else{
            DB::table('status_update')->where('id',$id)->update(['status' => '0']);
        }
        return redirect()->back();
    }
}
