<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Lead;
use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function index(){
    
    	return view('admin/leads');
    }

    public function leadadd()
    {
        return view('admin/leads_add');
    }
	
	public function importview()
	    {
	        return view('admin/import_leads');
	    }

    public function export() 
    {   
        return Excel::download(new LeadsExport, 'leads.xlsx');
    }

    public function import(Request $request) 
    {   
        if (!empty($request['file'])) {
            
            Excel::import(new LeadsImport, $request['file']);
            return redirect()->back()->with('success', 'File Import Successfully');
        } else {
            return redirect()->back()->with('error', 'Something is Wrong');
        }
        
    }

    public function create(Request $request){

    	$name=$request['name'];
    	$contact=$request['contact'];
    	$email=$request['email'];
        $dob=$request['dob'];
        $address=$request['address'];
        $state=$request['state'];
        $city=$request['city'];
        $pincode=$request['pincode'];
        $company=$request['company'];
        $department=$request['department'];
        $designation=$request['designation'];
        $others=$request['others'];

    	$adminid = Auth::id();
    	
    	$insert=[
    			'name' => $name,
    			'contact' => $contact,
    			'email' => $email,
                'dob' => $dob,
                'address' => $address,
                'state' => $state,
                'city' => $city,
                'pincode' => $pincode,
                'company' => $company,
                'department' => $department,
                'designation' => $designation,
                'others' => $others,
    			'added_by' => $adminid,
                'created_at' => Carbon::now(),
                'updated_at' => null
    		  ];

    	Lead::insert($insert);
    	return redirect('leads')->with('message', 'Added Successfully');
    }

    public function leadsTableData(Request $request){
       ## Read value

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';

         $check = DB::table('leads')->leftJoin('users', function($join) {
                    $join->on('leads.added_by', '=', 'users.id');})->orderBy('leads.id','DESC');
         // $check = Lead::where('id','!=',0);
        if (!empty($check)) {

        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('leads.id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('leads.contact', 'like', '%'.$searchQuery.'%')
                  ->orWhere('leads.name', 'like', '%'.$searchQuery.'%');
            });
                }
        

## Total number of records with filtering
      


        $totalRecords = $check->count();
        $totalRecordwithFilter = $check->count();

## Fetch records
        $check->skip($row);
        $check->take($rowperpage);
        $record =  $check->get([
                    'leads.id',
                    'leads.name',
                    'leads.contact',
                    'leads.email',
                    'users.name as added_byname',
                    'leads.status',
                    'leads.last_call'
                ]);
        

        $data = array();

        foreach ($record as $key=>$row ) {
    
            $id = $row->id;
            $name = $row->name;
            $contact = $row->contact;
            $email = $row->email;
            $added_by = $row->added_byname;
            $created_at = $row->last_call;
            if (!empty($created_at)) {
                    $created_at = (strtotime($created_at));
                    $created_date = date('d-M', $created_at);
                    $created_time = date('g:i A', $created_at);
                    $created_at= $created_date." ".$created_time ;
            } else {
                $created_at='-';
            }
            // dd($created_at);

            if ($row->status==1) {
                $status = '<a href="'.route('leadsstatus',[$id]).'" class="btn btn-primary">Active</a>';
                } else {
                    $status = '<a href="'.route('leadsstatus',[$id]).'" class="btn btn-danger">Inactive</a>';
                }

            $checkuser=Auth::user()->role_id; 
            if ($checkuser == 1) {
            $data[] = array(
                'id'=>$key+1,
                'leadid'=>$id,
                'name'=>$name,
                'contact'=>$contact,
                'email'=>$email,
                'added_by'=>$added_by,
                'created_at'=>$created_at,
                'status'=>$status,
                'action'=> "<a style='float: left; color: blue;' href=\"javascript:;\" onclick=\"getData(".$id.");\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"View\">
                        <div class=\"icon-container\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-eye\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"></path><circle cx=\"12\" cy=\"12\" r=\"3\"></circle>
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
            }else{
                 $data[] = array(
                'id'=>$key+1,
                'leadid'=>$id,
                'name'=>$name,
                'contact'=>$contact,
                'email'=>$email,
                'added_by'=>$added_by,
                'created_at'=>Carbon::parse($created_at)->format('d-M-Y'),
                'status'=>$status,
                'action'=> "<a style='float: left; color: blue;' href=\"javascript:;\" onclick=\"getData(".$id.");\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"View\">
                        <div class=\"icon-container\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-eye\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"></path><circle cx=\"12\" cy=\"12\" r=\"3\"></circle>
                            </svg>
                        </div>
                    </a>",
                    );
            }
                
            
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

    public function leadDetail(Request $request){
    	
        $leads = Lead::where('id',$request->id)->first();
        $precomment=DB::table('predefine_comments')->select('comment')->get();
         // dd($precomment);
        $lead_comment=DB::table('lead_comments')->where('lead_id',$request->id)->leftJoin('users', 'lead_comments.added_by', '=', 'users.id')->orderBy('lead_comments.id','ASC');
        $leadcomment=$lead_comment->get([
                                    'lead_comments.comment',
                                    'users.name',
                                    'lead_comments.created_at'
                                    ]);

       
        $html = '<div class="row">
            <div class="col-lg-12">
                <div class="col-lg-2" style="float: left;"><b>Name :</b></div>
                <div class="col-lg-4" style="float: left;">'.$leads->name.'</div>
                <div class="col-lg-3" style="float: left;"><b>Contact No. :</b></div>
                <div class="col-lg-3" style="float: left;">'.$leads->contact.'</div>
            </div>
            
            <div class="col-lg-12">
                <div class="col-lg-2" style="float: left;"><b>Email Id :</b></div>
                <div class="col-lg-4" style="float: left;">'.$leads->email.'</div>
                <div class="col-lg-3" style="float: left;"><b>Added By :</b></div>
                <div class="col-lg-3" style="float: left;">'.$leads->added_by.'</div>
            </div>';
            if(isset($leadcomment)){
            	$html .='<div class="col-lg-12" style="max-height : 250px; overflow-y: auto; overflow-x: hidden;">
                        <table class="sortable table" style="width: 100%; margin-left:15px; ">
                            <thead>
                                <tr>
                                    <th>Comments</th>
                                    
                                    </tr>
                            </thead>
                            <tbody>';
                            foreach ($leadcomment as $k=>$v){

                            	$html .='<tr>
                            		<td style="width:80%;overflow-wrap: break-word; padding-top:15px;">'.$v->comment.'<span style=" float: right; margin-right:15px;"><b>By '.$v->name.'</b>'.' '.$a=Carbon::parse($v->created_at)->format('d-M-Y').'</span></td>
                                    
                                    </tr>';
                            }
                             $html .='</tbody>
                        </table>
                        </div>';
                }


           ;
           $html1 =  '<div class="col-lg-12" style="height : auto;>
          
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id" required="true" value="'.$leads->id.'" id="user_id"></input>   
                </div>
                <div  class="col-lg-2" style="padding: 10px;">
                     <label><b>Next Date</b></label>
                </div>
                   
                <div class="form-group col-lg-3">
                    <input type="date" class="form-control" name="next_call">   
                </div>
                <div  class="col-lg-2" style="padding: 10px;">
                     <label><b>Comments</b></label>
                </div>
                <div class="form-group col-lg-5 ">
                    
                    <select class="form-control" id="pre_comment">
                        <option value="">Select Predefine Comment</option>';
                         foreach ($precomment as $key => $value) {
                       $html1 .='<option value="'.$value->comment.'">'.$value->comment.'</option>';
                        }
                    $html1 .='</select>   
                </div>
                <div class="form-group col-lg-12">
                    <textarea class="form-control" name="comment" required="true" placeholder="Please Add Comment" id="comment_textarea"></textarea>   
                </div>
                

            
            </div>
            </div>';

            $html=$html.'<hr>' .$html1;

    return $html ;

    }

    public function leadDelete(Request $request, $id)
    { 

    	// dd($id);
         $message = array();
         $data['leads'] = Lead::get();
         $project = Lead::where('id',$id)->delete();
 
         $message['status'] = 'success';

         return $message;
    }

     public function addcomment(Request $request)
    { 
        $comment =$request['comment'];
    	$id =$request['id'];
        $next_call =$request['next_call'];
    	$adminid = Auth::id();

        
        $date=Carbon::now()->toDateTimeString();
        
        Lead::where('id',$id)->update(['last_call'=>$date]); 

    	$insert=[
    			'lead_id' => $id,
    			'comment' => $comment,
                'next_call' =>Carbon::parse($next_call)->format('Y-m-d'),
    			'added_by' => $adminid,
                'created_at' => Carbon::now(),
                'updated_at' => null
    		  ];
    		$data=DB::table('lead_comments')->insert($insert);
            
        	return true;
    }

    public function leadsstatus($id){
        $data=Lead::where('id',$id)->first();
        if($data->status==0){

            Lead::where('id',$id)->update(['status' => '1']);
        }else{
            Lead::where('id',$id)->update(['status' => '0']);
        }
        return redirect()->back();
    }
}

