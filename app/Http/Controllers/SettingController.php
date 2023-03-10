<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use DB;
use Carbon\Carbon;

class SettingController extends Controller
{
    public function index(){
        
    	return view('admin/comments');
    }

    public function categoryIndex(){
        
        $data=DB::table('task_category')->get();
        return view('admin/category', compact('data'));
    }

    public function predefinecomment(){
        
    	return view('admin/predefine_comment');
    }

    public function commentEdit($commentid){
        
        $data=DB::table('predefine_comments')->where('id',$commentid)->first();
    	return view('admin/comment_edit',compact('data'));
    }

    public function addComment(Request $request){

    	$comment=$request['comment'];
		$adminid = Auth::id();

    	$insert=[
          'comment' => ucwords($comment),
          'added_by' => $adminid,
          'created_at' =>Carbon::now(),
          'updated_at' =>null
          ];
        DB::table('predefine_comments')->insert($insert);
        return redirect('comments');
    }

    public function commentUpdate(Request $request){

    	$id=$request['id'];
    	$comment=$request['comment'];
		$adminid = Auth::id();

    	$update=[
          'comment' => ucwords($comment),
          'added_by' => $adminid,
          'updated_at' =>Carbon::now()

          ];
        DB::table('predefine_comments')->where('id',$id)->update($update);
        return redirect('comments');
    }

    public function commentTableData(Request $request){

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';

        
        $check=DB::table('predefine_comments')->leftJoin('users', function($join) {
             $join->on('predefine_comments.added_by', '=', 'users.id');});

     // dd($check);
    // $check = Lead::where('id','!=',0);
        if (!empty($check)) {

        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('predefine_comments.id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('predefine_comments.comment', 'like', '%'.$searchQuery.'%');
            });
                }
        

## Total number of records with filtering

        $totalRecords = $check->count();
        $totalRecordwithFilter = $check->count();

## Fetch records
        $check->skip($row);
        $check->take($rowperpage);
        $record =  $check->get([
                    'predefine_comments.id',
                    'predefine_comments.comment',
                    'users.name as added_by',
                    'predefine_comments.created_at'
                ]);
        

        $data = array();

        foreach ($record as $key=>$row ) {
    
            $commentid = $row->id;
            $comment = $row->comment;
            $added_by = $row->added_by;
            $created_at = $row->created_at;
            // dd($created_at);
            
            $data[] = array(
                'id'=>$key+1,
                'commentid'=>$commentid,
                'comment'=>$comment,
                'added_by'=>$added_by,
                'created_at'=>Carbon::parse($created_at)->format('d-M-Y'),
                'action'=> "<a href=\"".route('comment_edit',[$commentid])."\" style='float: left; color: blue;' data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Edit\">
                    <div class=\"icon-container\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-edit-2\">
                            <path d=\"M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z\"></path>
                        </svg>
                    </div>
                </a>
                   
                <a style='float: left; color: red;' data-role-id=\"".$commentid."\" href=\"javascript:;\" onclick=\"deleteThis(".$commentid.");\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Delete\">
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

    public function commentDelete(Request $request, $id)
    { 
         $message = array();
         $project = DB::table('predefine_comments')->where('id',$id)->delete();
 
         $message['status'] = 'success';

         return $message;
    }

    public function categoryCreate(Request $request){

        $category=$request['category'];
        // $adminid = Auth::id();

        $insert=[
          'title' => ucwords($category),
          'created_at' => Carbon::now(),
          'updated_at' => null
          ];
        DB::table('task_category')->insert($insert);
        return redirect('category');
    }

    public function categoryDestroy($id){

        DB::table('task_category')->where('id',$id)->delete();
        
        return redirect('category');
    }

    public function roleIndex(){
        
        return view('admin/role');
    }

    public function roleTableData(Request $request){

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';

        
        $check = Role::where('id','!=',0);

    
        if (!empty($check)) {

        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('name', 'like', '%'.$searchQuery.'%');
            });
                }
        

## Total number of records with filtering

        $totalRecords = $check->count();
        $totalRecordwithFilter = $check->count();

## Fetch records
        $check->skip($row);
        $check->take($rowperpage);
        $record =  $check->get();
        

        $data = array();

        foreach ($record as $key=>$row ) {
    
            $id = $row->id;
            $name = $row->name;
            $description = $row->description;
            $created_at = $row->created_at;
            
            $data[] = array(
                'id'=>$key+1,
                'roleid'=>$id,
                'name'=>ucfirst($name),
                'description'=>$description,
                'created_at'=>Carbon::parse($created_at)->format('d-M-Y'),
                'action'=> "<a href=\"".route('role_edit',[$id])."\" style='float: left; color: blue;' data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Edit\">
                    <div class=\"icon-container\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-edit-2\">
                            <path d=\"M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z\"></path>
                        </svg>
                    </div>
                </a>
                   
                <a style='float: left; color: red;' data-role-id=\"".$id."\" href=\"javascript:;\" onclick=\"deleteThis(".$id.");\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Delete\">
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

    public function addRole(Request $request){

        $name=$request['name'];
        $description=$request['description'];

        $insert=[
          'name' => $name,
          'display_name' => ucfirst($name),
          'description' => ucwords($description),
          'created_at' => Carbon::now(),
          'updated_at' => null
          ];
        Role::insert($insert);
        return redirect('role');
    }

    public function roleEdit($id){
        
        $data=Role::where('id',$id)->first();
        return view('admin/role_edit',compact('data'));
    }

    public function updateRole(Request $request){

        $id=$request['id'];
        $name=$request['name'];
        $description=$request['description'];


        $update=[
          'name' => $name,
          'display_name' => ucfirst($name),
          'description' => ucwords($description),
          'updated_at' => Carbon::now()

          ];
        Role::where('id',$id)->update($update);
        return redirect('role');
    }

     public function roleDelete(Request $request, $id)
    { 
         $message = array();
         $project = Role::where('id',$id)->delete();
 
         $message['status'] = 'success';

         return $message;
    }

}
