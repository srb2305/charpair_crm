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
        $task_priority=$request['task_priority'];

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
                'task_priority' => $task_priority,
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

         $searchByStatus = $_POST['searchByStatus'];
## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';

        $userid=Auth::id();
        $roleId=User::where('id',$userid)->value('role_id');

        if ($roleId==1) {

                $check = DB::table('tasks')->leftJoin('users as u1', function($join) {
                    $join->on('tasks.assign_by', '=', 'u1.id');})->leftJoin('users as u2', function($join) {
                    $join->on('tasks.assign_to', '=', 'u2.id');})->leftJoin('task_category', function($join) {
                    $join->on('tasks.category_id', '=', 'task_category.id');})->orderBy('tasks.id','DESC');
        
        } else {
                $check = DB::table('tasks')->where('tasks.assign_to', $userid)->leftJoin('users as u1', function($join) {
                    $join->on('tasks.assign_by', '=', 'u1.id');})->leftJoin('users as u2', function($join) {
                    $join->on('tasks.assign_to', '=', 'u2.id');})->leftJoin('task_category', function($join) {
                    $join->on('tasks.category_id', '=', 'task_category.id');})->orderBy('tasks.id','DESC')->orderBy('tasks.id','DESC');;
        }
        
        // dd($check);
         // $check = Lead::where('id','!=',0);
        if (!empty($check)) {

        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('tasks.id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('u2.name', 'like', '%'.$searchQuery.'%')
                  ->orWhere('u1.name', 'like', '%'.$searchQuery.'%');
            });
                }
        if($searchByStatus != ''){
            $check = $check->where('tasks.status', $searchByStatus);
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
                    'tasks.task_priority',
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
            $created_at = $row->created_at;

            if ($row->task_priority==1) {
                $task_priority="High";
                $task_priority='<span class="badge badge-danger">'.$task_priority.'</span>';
            } elseif ($row->task_priority==2) {
                $task_priority="Medium";
                $task_priority='<span class="badge badge-warning">'.$task_priority.'</span>';
            } elseif ($row->task_priority==3) {
                $task_priority="Low";
                $task_priority='<span class="badge badge-info">'.$task_priority.'</span>';
            } else {
                $task_priority="--";
            }
            

            if ($row->status==0) {
                $status='Not Started';
                $status='<span class="badge badge-secondary" style="background-color: #858289;">'.$status.'</span>';
            } elseif ($row->status==1) {
                $status='In Process';
                $status='<span class="badge badge-warning">'.$status.'</span>';
            } elseif ($row->status==2) {
                $status='Completed';
                $status='<span class="badge badge-success">'.$status.'</span>';
            } else {
                $status='Hold';
                $status='<span class="badge badge-danger">'.$status.'</span>';
            }
            

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
                'task_priority'=>$task_priority,
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
                    'tasks.task_priority',
                    'tasks.task_start_date',
                    'tasks.task_end_date'
                ]);

        $users=User::get();

        $data2=DB::table('task_logs')->where('task_logs.task_id', $id)->leftJoin('users', function($join) {
                    $join->on('task_logs.added_by', '=', 'users.id');})->get([
                        'task_logs.title',
                        'task_logs.old_value',
                        'task_logs.new_value',
                        'users.name',
                        'task_logs.created_at'
                    ]);
        // dd($data2);
        $data1=DB::table('task_comments')->where('task_comments.task_id', $id)->leftJoin('users', function($join) {
                    $join->on('task_comments.comment_by', '=', 'users.id');})->orderBy('task_comments.id','DESC')->get([
                        'task_comments.id',
                        'task_comments.comment',
                        'users.name',
                        'task_comments.created_at'
                    ]);
            

        
        return view('admin/view_task', compact('data', 'data1','users','id','data2'));
        
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

        $olduser=DB::table('tasks')->where('id', $taskid)->value('assign_to');
        $oldValue= User::where('id',$olduser)->value('name');
        $newValue= User::where('id',$assign_to)->value('name');

        $insert=[
            'task_id' => $taskid,
            'title' => 'Change In Task Assing',
            'new_value' => $newValue,
            'old_value' => $oldValue,
            'added_by' => $adminid,
            'created_at' => Carbon::now()
        ];
        DB::table('task_logs')->insert($insert);

        $update=[
            'assign_to' => $assign_to,
            'assign_by' => $adminid,
            'updated_at' => Carbon::now()
        ];
       DB::table('tasks')->where('id', $taskid)->update($update);
       $message['status'] = 'success';
       
       return $message;
    }

    public function editTask($id){

        $taskDetail=DB::table('tasks')->where('id', $id)->first();
        $data=User::get();
        $data1=DB::table('task_category')->get();
        return view('admin/task_edit', compact('taskDetail','data','data1'));
    }

    public function taskUpdate(Request $request){
        
        $id=$request['id'];
        $title=$request['title'];
        $description=$request['description'];
        $category=$request['category'];
        $start_date=$request['start_date'];
        $end_date=$request['end_date'];
        $end_date=$request['end_date'];
        $task_priority=$request['task_priority'];
        
        
        $adminid = Auth::id();

        $data=DB::table('tasks')->where('id', $id)->first();
        $oldValueAry=[];
        $newValueAry=[];
        if ($data->title != $title) {
            $oldtitle=$data->title;
            $newtitle=$title;
            array_push($oldValueAry, $oldtitle);
            array_push($newValueAry, $newtitle);
        }
        if ($data->description != $description) {
            $olddescription=$data->description;
            $newdescription=$description;
            array_push($oldValueAry, $olddescription);
            array_push($newValueAry, $newdescription);
        }
        // dd($newValueAry);
        if ($data->category_id != $category) {
            $oldcategory=$data->category_id.' (Category)';
            $newcategory=$category.' (Category)';
            array_push($oldValueAry, $oldcategory);
            array_push($newValueAry, $newcategory);
        }
        if ($data->task_start_date != $start_date) {
            $oldstart_date=$data->task_start_date;
            $newstart_date=$start_date;
            array_push($oldValueAry, $oldstart_date);
            array_push($newValueAry, $newstart_date);
        }
        if ($data->task_end_date != $end_date) {
            $oldend_date=$data->task_end_date;
            $newend_date=$end_date;
            array_push($oldValueAry, $oldend_date);
            array_push($newValueAry, $newend_date);
        }
        if ($data->task_priority != $task_priority) {
            
            $old_priority=$data->task_priority;

            if($old_priority==1){
                $old_priority='High';
            } elseif ($old_priority==2) {
                $old_priority='Medium';
            } elseif ($old_priority==3) {
                $old_priority='Low';
            } else {
                $old_priority='--';
            }
            
            $new_priority=$task_priority;

            if($new_priority==1){
                $new_priority='High';
            } elseif ($new_priority==2) {
                $old_priority='Medium';
            } elseif ($new_priority==3) {
                $new_priority='Low';
            } else {
                $new_priority='--';
            }

            array_push($oldValueAry, $old_priority);
            array_push($newValueAry, $new_priority);
        }
        if (!empty($newValueAry)) {
            $insert=[
            'task_id' => $id,
            'title' => 'Changes In Task',
            'new_value' => implode(" , ", $newValueAry),
            'old_value' => implode(" , ", $oldValueAry),
            'added_by' => $adminid,
            'created_at' => Carbon::now()
            ];
            DB::table('task_logs')->insert($insert);
        }
        
        $update=[
            'title' => $title,
            'description' => $description,
            'category_id' => $category,
            'task_start_date' => $start_date,
            'task_end_date' => $end_date,
            'task_priority' => $task_priority,
            'assign_by' => $adminid,
            'updated_at' => Carbon::now()
        ];
       DB::table('tasks')->where('id', $id)->update($update);
       
       return redirect('tasks');
    }

    public function taskStatusUpdate(Request $request){
        
        $message = array();
        $taskid=$request['id'];
        $status=$request['status'];

        $adminid = Auth::id();

        $oldstatus=DB::table('tasks')->where('id', $taskid)->value('status');
        
        if ($oldstatus==0) {
                $oldValue='Not Started';
            } elseif ($oldstatus==1) {
                $oldValue='In Process';
            } elseif ($oldstatus==2) {
                $oldValue='Completed';
            } else {
                $oldValue='Hold';
            }
        if ($status==0) {
                $newValue='Not Started';
            } elseif ($status==1) {
                $newValue='In Process';
            } elseif ($status==2) {
                $newValue='Completed';
            } else {
                $newValue='Hold';
            }

        $insert=[
            'task_id' => $taskid,
            'title' => 'Change In Status',
            'new_value' => $newValue,
            'old_value' => $oldValue,
            'added_by' => $adminid,
            'created_at' => Carbon::now()
        ];
        DB::table('task_logs')->insert($insert);

        $update=[
            'status' => $status,
            'updated_at' => Carbon::now()
        ];
       DB::table('tasks')->where('id', $taskid)->update($update);
       $message['status'] = 'success';
       
       return $message;
    }

    public function destroy($id){
        
        // dd($id);
        $message = array();
        $data['tasks'] = DB::table('tasks')->get();
        DB::table('tasks')->where('id', $id)->delete();

        $data['task_comments'] = DB::table('task_comments')->get();
        DB::table('task_comments')->where('task_id', $id)->delete();

        $data['task_logs'] = DB::table('task_logs')->get();
        DB::table('task_logs')->where('task_id', $id)->delete();

        $message['status'] = 'success';

        return $message;

    }
    public function commentDestroy($cId){
            
       DB::table('task_comments')->where('id',$cId)->delete(); 
       return redirect()->back();
    }

}
