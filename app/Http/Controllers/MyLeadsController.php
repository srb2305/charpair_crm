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

class MyLeadsController extends Controller
{
     public function index(){
    
    	return view('admin/myleads');
    }

    public function myLeadsTableData(Request $request){
       ## Read value

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';

        $userid=Auth::id();
        $mydata=DB::table('lead_task')->where('user_id',$userid)->first();

        $from=$mydata->lead_from;
        $to=$mydata->lead_to;

        $mylead=Lead::whereBetween('id', [$from, $to]);
        // dd($abc);
         $check = $mylead->where('id','!=',0);
                   
        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('contact', 'like', '%'.$searchQuery.'%')
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
            $contact = $row->contact;
            $email = $row->email;
            $added_by = $row->added_by;
            $created_at = $row->created_at;
            if ($row->status==1) {
                $status = '<a href="'.route('leadsstatus',[$id]).'" class="btn btn-primary">Active</a>';
                } else {
                    $status = '<a href="'.route('leadsstatus',[$id]).'" class="btn btn-danger">Inactive</a>';
                }

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
## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return json_encode($response);
       
    }
}
