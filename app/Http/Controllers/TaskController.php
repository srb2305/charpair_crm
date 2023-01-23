<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Role;
use App\User;
use App\lead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(){
    
    	return view('admin/tasks');
    }

    public function addIndex()
    {
        $data=User::get();
        $data1=DB::table('task_category')->get();
        return view('admin/task_add', compact('data','data1'));
    }
    public function taskCreate(Request $request){

    	$empid=$request['emp_id'];
    	$title=$request['title'];
    	$category=$request['category'];
    	$description=$request['description'];
   		$start_date=$request['start_date'];
   		$end_date=$request['end_date'];

        // dd($lead_idto);
   		// $start_date=date('d/m/Y',strtotime($start_date));
   		// $end_date=date('d/m/Y',strtotime($end_date));
   		$adminid = Auth::id();

   			$insert=[
    			'assign_to' => $empid,
    			'assign_by' => $adminid,
    			'title' => $title,
    			'description' => $description,
    			'category_id' => $category,
    			'task_start_date' => $start_date,
    			'task_end_date' => $end_date,
    			'status'=> 0,
    			'created_at'=> Carbon::now(),
    			'updated_at'=> null
    		  ];
    		DB::table('tasks')->insert($insert);
    		return redirect()->back()->with('message', 'Task Added Successfully');
    }

    public function taskTableData(Request $request){
       ## Read value

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';

        // $userid=Auth::id();
        // $roleId=User::where('id',$userid)->value('role_id');

        // if ($roleId==1) {
        //     # code...
        // } else {
        //     # code...
        // }
        
        // dd($roleId);
        $check = DB::table('tasks')->leftJoin('users as u1', function($join) {
                    $join->on('tasks.assign_by', '=', 'u1.id');})->leftJoin('users as u2', function($join) {
                    $join->on('tasks.assign_to', '=', 'u2.id');})->leftJoin('task_category', function($join) {
                    $join->on('tasks.category_id', '=', 'task_category.id');});
        
         // $check = Lead::where('id','!=',0);
        if (!empty($check)) {

        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('tasks.id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('u2.name', 'like', '%'.$searchQuery.'%')
                  ->orWhere('u1.name', 'like', '%'.$searchQuery.'%');
            });
                }
        

## Total number of records with filtering
      


        $totalRecords = $check->count();
        $totalRecordwithFilter = $check->count();

## Fetch records
        $check->skip($row);
        $check->take($rowperpage);
        $record =  $check->get([
                    'tasks.id',
                    'u2.name as assign_to',
                    'u1.name as assign_by',
                    'tasks.title',
                    'task_category.title as category',
                    'tasks.status',
                    'tasks.created_at'
                ]);
        

        $data = array();

        foreach ($record as $key=>$row ) {
    
            $id = $row->id;
            $assign_to = $row->assign_to;
            $assign_by = $row->assign_by;
            $title = $row->title;
            $category = $row->category;
            $status = $row->status;
            $created_at = $row->created_at;

            // if (!empty($created_at)) {
            //         $created_at = (strtotime($created_at));
            //         $created_date = date('d-M', $created_at);
            //         $created_time = date('g:i A', $created_at);
            //         $created_at= $created_date." ".$created_time ;
            // } else {
            //     $created_at='-';
            // }
            // // dd($created_at);

            // if ($row->status==1) {
            //     $status = '<a href="'.route('leadsstatus',[$id]).'" class="btn btn-primary">Active</a>';
            //     } else {
            //         $status = '<a href="'.route('leadsstatus',[$id]).'" class="btn btn-danger">Inactive</a>';
            //     }

            // $checkuser=Auth::user()->role_id; 
            // if ($checkuser == 1) {
            $data[] = array(
                'id'=>$key+1,
                'taskid'=>$id,
                'assign_to'=>$assign_to,
                'assign_by'=>$assign_by,
                'title'=>$title,
                'category'=>$category,
                'status'=>$status,
                'created_at'=>Carbon::parse($created_at)->format('d-M-Y'),
                'action'=> '<a href="'.route('task_view',[$id]).'"class="btn btn-info">View</a>',
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

    public function viewTask($id){
       $data= DB::table('tasks')->where('tasks.id',$id)->leftJoin('users as u1', function($join) {
                    $join->on('tasks.assign_by', '=', 'u1.id');})->leftJoin('users as u2', function($join) {
                    $join->on('tasks.assign_to', '=', 'u2.id');})->leftJoin('task_category', function($join) {
                    $join->on('tasks.category_id', '=', 'task_category.id');})->get([
                    'tasks.id',
                    'tasks.assign_to',
                    'u1.name as assign_by',
                    'tasks.title',
                    'tasks.description',
                    'task_category.title as category',
                    'tasks.status',
                    'tasks.task_start_date',
                    'tasks.task_end_date'
                ]);

        $users=User::get();

        // dd($users);

        $data1=DB::table('task_comments')->where('task_comments.task_id', $id)->leftJoin('users', function($join) {
                    $join->on('task_comments.comment_by', '=', 'users.id');})->get([
                        'task_comments.comment',
                        'users.name',
                        'task_comments.created_at'
                    ]);

        if (!empty($data1)) {
           return view('admin/view_task', compact('data', 'data1','users'));
        } else {
            return view('admin/view_task', compact('data'));
        }

    }

    public function commentAdd(Request $request){

        $comment=$request['comment'];
        $taskid=$request['taskid'];
        $adminid = Auth::id();

        $insert=[
          'comment' => ucwords($comment),
          'task_id' => $taskid,
          'comment_by' => $adminid,
          'created_at' =>Carbon::now(),
          'updated_at' =>null

          ];
        DB::table('task_comments')->insert($insert);
        return redirect()->back();
    }

    public function taskAssignUpdate(Request $request){
        
        $message = array();
        $taskid=$request['id'];
        $assign_to=$request['assign_to'];

        $adminid = Auth::id();

        $update=[
            'assign_to' => $assign_to,
            'assign_by' => $adminid,
            'updated_at' => Carbon::now()
        ];
       DB::table('tasks')->where('id', $taskid)->update($update);
       $message['status'] = 'success';
       
       return $message;
    }
}
