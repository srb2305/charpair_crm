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
}
