<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class DashboardController extends Controller
{
    public function index(){

    	$total_users = User::count();


    	// $paid_lifter = User::where('role_id','=','5')->count();

    	// $free_lifter = User::where('role_id','=','6')->count();

    	// $total_lifter = $paid_lifter + $free_lifter;

    	// $total_liftee = User::where('role_id','=','4')->count();

    	// $total_vehicle = Vehicle::count();

    	// $total_upcoming_lift = Lift::count();

     //    $today_total_upcoming_lift = Lift::where('created_at', date('Y-m-d'))->count();

     //    $vehicle_users = DB::table('vehicles')
     //             ->select('added_by', DB::raw('count(*) as total'))
     //             ->groupBy('added_by')
     //             ->get();

        
       	
     //    $vehicle_user = count($vehicle_users);

     //    $novehicle_user = $total_users-$vehicle_user;
     //    // $users_ver = DB::table('users')
     //    //     ->join('vehicles', 'users.id', '<>', 'vehicles.added_by')
     //    //     ->groupBy('vehicles.added_by')
     //    //     ->get();
     //    //     echo "<pre>";print_r($users_ver);die;
     //    // $vehicle_user = DB::table('vehicles')
     //    //     ->join('users', 'vehicles.added_by', '=', 'users.id')
     //    //     //->groupby('users.id')
     //    //     ->count();

     //    // print_r($total_users);die;

     //    // $novehicle_user = DB::table('users')
     //    //     ->join('vehicles', 'users.id', '!=', 'vehicles.added_by')
     //    //     ->count();


     //    $all = Vehicle::all();
     //   	//echo "<pre>";print_r($all);die;
    	// $rating = Review::avg('rating');
    	// $review = number_format($rating,1);
    	// $total_review = Review::count();
    	

    	// return view('admin.dashboard',compact('total_lifter','total_liftee','total_vehicle','total_upcoming_lift','total_review','review','today_total_upcoming_lift','vehicle_user','novehicle_user','total_users'));
        return view('dashboard',compact('total_users'));
    }
    
    public function todayLeadsTableData(Request $request){

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';

        $todaydate=Carbon::now()->format('Y-m-d');
        $check=DB::table('lead_comments')->where('next_call',$todaydate)->leftJoin('leads', function($join) {
                    $join->on('lead_comments.lead_id', '=', 'leads.id');})->leftJoin('users', function($join) {
                    $join->on('lead_comments.added_by', '=', 'users.id');});

     // dd($dataondate);
    // $check = Lead::where('id','!=',0);
        if (!empty($check)) {

        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('lead_comments.lead_id', 'like', '%'.$searchQuery.'%')
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
                    'leads.id as leadid',
                    'leads.name',
                    'leads.contact',
                    'users.name as added_by',
                    'leads.last_call'
                ]);
        

        $data = array();

        foreach ($record as $key=>$row ) {
    
            $leadid = $row->leadid;
            $name = $row->name;
            $contact = $row->contact;
            $added_by = $row->added_by;
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
            
            $data[] = array(
                'id'=>$key+1,
                'leadid'=>$leadid,
                'name'=>$name,
                'contact'=>$contact,
                'added_by'=>$added_by,
                'created_at'=>$created_at,
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
}
