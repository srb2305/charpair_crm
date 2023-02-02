<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function tIndex(){
    
    	return view('admin/employee/telecaller');
    }

    public function telecallerAdd(){
    
    	return view('admin/employee/addtelecaller');
    }
     

     public function sIndex(){
    
    	return view('admin/employee/salesperson');
    }


   public function addEmployee(Request $request){

   		$name=$request['name'];
   		$mobile=$request['mobile'];
   		$username=$request['username'];
   		$password=bcrypt($request['password']);
    	$email=$request['email'];
    	$sos=$request['sos'];
    	$gender=$request['gender'];
    	$designation=$request['designation'];
    	$department=$request['department'];
    	$dob=$request['dob'];
    	$company='Char Pair';
   		
   		$image = $request->file('image');
   		if (!empty($image)) {
   			$imagename = time().'.'.$image->getClientOriginalExtension();
        	$destinationPath = base_path('/images');
        	$image->move($destinationPath, $imagename);
   		}else{
   			$imagename = null;
   		}
        

        $role=Role::where('name',$designation)->first();
   		$roleid= $role->id;

   		$check=User::where('email',$email)->first();

   		if (empty($check)) {
   			$insert=[
    			'name' => $name,
    			'username' => $username,
    			'mobile' => $mobile,
    			'sos' => $sos,
    			'email' => $email,
    			'password' => $password,
    			'gender' => $gender,
    			'role_id' => $roleid,
    			'image' => $imagename,
    			'designation' => $designation,
    			'department' => $department,
    			'company' => $company,
    			'dob' => $dob,
                'created_at' => Carbon::now(),
                'updated_at' => null
    		  ];

    		User::insert($insert);
    		return redirect()->back()->with('message', 'Added Successfully');

   		}else{

   			return redirect()->back()->with('error', 'Email has Already Registered');
   		}
   		// dd($roleid);
   }

   public function telecallerTableData(Request $request){
       ## Read value

         $draw = $_POST['draw']; 
         $row = $_POST['start'];
         $rowperpage = $_POST['length']; // Rows display per page

## Search
        $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';


         $check = User::where('role_id','=',2)->orWhere('role_id','=',3)->orderBy('id','DESC');

        if (!empty($check)) {
                   
        if (!empty($searchQuery)) {
            $check->where(function ( $q ) use ( $searchQuery ){
                $q->orWhere('id', 'like', '%'.$searchQuery.'%')
                  ->orWhere('mobile', 'like', '%'.$searchQuery.'%')
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
            $mobile = $row->mobile;
            $email = $row->email;
            $designation = $row->designation;
  			 if ($row->status==1) {
  				$status = '<a href="'.route('employeestatus',[$id]).'" class="btn btn-primary">Active</a>';
                } else {
                    $status = '<a href="'.route('employeestatus',[$id]).'" class="btn btn-danger">Inactive</a>';
                }
            $created_at = $row->created_at;

            $data[] = array(
                'id'=>$key+1,
                'name'=>$name,
                'mobile'=>$mobile,
                'email'=>$email,
                'designation'=>ucfirst($designation),
                'status'=>$status,
                'created_at'=>Carbon::parse($created_at)->format('d-M-Y'),
                'action'=> "<a style='float: left; color: blue;' href=\"javascript:;\" onclick=\"getData(".$id.");\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"View\">
                        <div class=\"icon-container\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-eye\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"></path><circle cx=\"12\" cy=\"12\" r=\"3\"></circle>
                            </svg>
                        </div>
                    </a>

                <a href=\"".route('employee_edit',[$id])."\" style='float: left; color: blue;' data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Edit\">
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
    public function telecallerDelete(Request $request, $id)
    { 
         $message = array();
         $project = User::where('id',$id)->delete();
 
         $message['status'] = 'success';

         return $message;
    }

    public function employeeEdit($id)
    {
        $data = User::where('id',$id)->first();
        // dd($data->name);
        return view('admin/employee/employee_edit',compact('data'));
    }

     public function updateEmployee(Request $request){

   		$id=$request['id'];
   		$name=$request['name'];
   		$mobile=$request['mobile'];
   		$username=$request['username'];
   		$password=($request['password']);
    	$email=$request['email'];
    	$sos=$request['sos'];
    	$gender=$request['gender'];
    	$designation=$request['designation'];
    	$department=$request['department'];
    	$dob=$request['dob'];
    	$company=$request['company'];

    	$check1=User::where('id',$id)->first();

   		$image = $request->file('image');
        if (!empty($image)) {
   			$imagename = time().'.'.$image->getClientOriginalExtension();
        	$destinationPath = base_path('/images');
        	$image->move($destinationPath, $imagename);
   		}else{
   			$imagename = $check1->image;
   		}

        $role=Role::where('name',$designation)->first();
   		$roleid= $role->id;

   		
   		$this->validate($request,[

   			'email'=>'unique:users,email,' .$id,

   		]);

   		// $check=User::where('email',$email)->first();

   		// if ($check == null || $check->id==$id ) {
   		// 	$email=$request['email'];
   		// }else{

   		// 	return redirect()->back()->with('error', 'Email has Already Registered');
   		// }


   		if (empty($password)) {
   			$password=$check1->password;
 
   		}else{
   			$password=bcrypt($request['password']);
   		}
   		
   		$update=[
    			'name' => $name,
    			'username' => $username,
    			'mobile' => $mobile,
    			'sos' => $sos,
    			'email' => $email,
    			'password' => $password,
    			'gender' => $gender,
    			'role_id' => $roleid,
    			'image' => $imagename,
    			'designation' => $designation,
    			'department' => $department,
    			'company' => $company,
    			'dob' => $dob,
                'updated_at' => Carbon::now()

    		  ];
    		
    		User::where('id',$id)->update($update);

    		if ($roleid == 2) {
    			return redirect()->route('telecaller');
    		}else{
    			return redirect()->route('salesperson');
    		}
   }

   public function telecallerDetail(Request $request){

    	
        $data = User::where('id',$request->id)->first();
       
        $html = '<div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Name :</b></div>
                <div class="col-lg-6" style="float: left;">'.ucfirst($data->name).'</div>
            </div>
             <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Contact No. :</b></div>
                <div class="col-lg-6" style="float: left;">'.$data->mobile.'</div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Email ID :</b></div>
                <div class="col-lg-6" style="float: left;">'.($data->email).'</div>
            </div>
             <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Gender :</b></div>
                <div class="col-lg-6" style="float: left;">'.ucfirst($data->gender).'</div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Designation :</b></div>
                <div class="col-lg-6" style="float: left;">'.ucfirst($data->designation).'</div>
            </div>
             <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Department :</b></div>
                <div class="col-lg-6" style="float: left;">'.ucfirst($data->department).'</div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Date of Birth :</b></div>
                <div class="col-lg-6" style="float: left;">'.$data->dob.'</div>
            </div>
             <div class="col-lg-12">
                <div class="col-lg-6" style="float: left;"><b>Joining Date :</b></div>
                <div class="col-lg-6" style="float: left;">'.$a=Carbon::parse($data->created_at)->format('d-M-Y').'</div>
            </div>';
 

    return $html ;

    }

//     public function salespersonTableData(Request $request){
//        ## Read value

//          $draw = $_POST['draw']; 
//          $row = $_POST['start'];
//          $rowperpage = $_POST['length']; // Rows display per page

// ## Search
//         $searchQuery    = isset( $request['search']['value'] ) ? $request['search']['value'] : '';


//          $check = User::where('role_id','=',3);
//         if (!empty($check)) {
              
//         if (!empty($searchQuery)) {
//             $check->where(function ( $q ) use ( $searchQuery ){
//                 $q->orWhere('id', 'like', '%'.$searchQuery.'%')
//                   ->orWhere('mobile', 'like', '%'.$searchQuery.'%')
//                   ->orWhere('name', 'like', '%'.$searchQuery.'%');
//             });
//                 }
        
// ## Total number of records with filtering

//         $totalRecords = $check->count();
//         $totalRecordwithFilter = $check->count();

// ## Fetch records
//         $check->skip($row);
//         $check->take($rowperpage);
//         $record =  $check->get();

//         $data = array();

//         foreach ($record as $key=>$row ) {
    
//             $id = $row->id;
//             $name = $row->name;
//             $mobile = $row->mobile;
//             $email = $row->email;
//             if ($row->status==1) {
//   				$status = '<a href="'.route('employeestatus',[$id]).'" class="btn btn-primary">Active</a>';
//                 } else {
//                     $status = '<a href="'.route('employeestatus',[$id]).'" class="btn btn-danger">Inactive</a>';
//                 }
//             $created_at = $row->created_at;

//             $data[] = array(
//                 'id'=>$key+1,
//                 'name'=>$name,
//                 'mobile'=>$mobile,
//                 'email'=>$email,
//                 'status'=>$status,
//                 'created_at'=>Carbon::parse($created_at)->format('d-M-Y'),
//                 'action'=> "<a style='float: left; color: blue;' href=\"javascript:;\" onclick=\"getData(".$id.");\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"View\">
//                         <div class=\"icon-container\">
//                             <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-eye\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"></path><circle cx=\"12\" cy=\"12\" r=\"3\"></circle>
//                             </svg>
//                         </div>
//                     </a>

//                 <a href=\"".route('employee_edit',[$id])."\" style='float: left; color: blue;' data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Edit\">
//                     <div class=\"icon-container\">
//                         <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-edit-2\">
//                             <path d=\"M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z\"></path>
//                         </svg>
//                     </div>
//                 </a>

//                 <a style='float: left; color: red;' data-role-id=\"".$id."\" href=\"javascript:;\" onclick=\"deleteThis(".$id.");\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Delete\">
//                     <div class=\"icon-container\">
//                         <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-trash-2\">
//                             <polyline points=\"3 6 5 6 21 6\"></polyline>
//                             <path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path>
//                             <line x1=\"10\" y1=\"11\" x2=\"10\" y2=\"17\"></line>
//                             <line x1=\"14\" y1=\"11\" x2=\"14\" y2=\"17\"></line>
//                         </svg>
//                     </div> 
//                 </a>",
//             );
//         }

// ## Response
//         $response = array(
//             "draw" => intval($draw),
//             "iTotalRecords" => $totalRecords,
//             "iTotalDisplayRecords" => $totalRecordwithFilter,
//             "aaData" => $data
//         );

//         return json_encode($response);
//         }else{
//         $response = array(
//             "draw" => intval($draw),
//             "iTotalRecords" => 0,
//             "iTotalDisplayRecords" => 0,
//             "aaData" => []
//         );

//         return json_encode($response);
//        }
       
//     }

    //  public function salespersonDelete(Request $request, $id)
    // { 
    //      $message = array();
    //      $project = User::where('id',$id)->delete();
 
    //      $message['status'] = 'success';

    //      return $message;
    // }

    // public function salespersonDetail(Request $request){

    	
    //     $data = User::where('id',$request->id)->first();
       
    //     $html = '<div class="row">
    //         <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Name :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.ucfirst($data->name).'</div>
    //         </div>
    //          <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Contact No. :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.$data->mobile.'</div>
    //         </div>
    //         <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Email ID :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.($data->email).'</div>
    //         </div>
    //          <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Gender :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.ucfirst($data->gender).'</div>
    //         </div>
    //         <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Designation :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.ucfirst($data->designation).'</div>
    //         </div>
    //          <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Department :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.ucfirst($data->department).'</div>
    //         </div>
    //         <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Date of Birth :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.$data->dob.'</div>
    //         </div>
    //          <div class="col-lg-12">
    //             <div class="col-lg-6" style="float: left;"><b>Joining Date :</b></div>
    //             <div class="col-lg-6" style="float: left;">'.$a=Carbon::parse($data->created_at)->format('d-M-Y').'</div>
    //         </div>';
 

    // return $html ;

    // }

    public function employeestatus($id){
    	$data=User::where('id',$id)->first();
    	if($data->status==0){

    		User::where('id',$id)->update(['status' => '1']);
    	}else{
    		User::where('id',$id)->update(['status' => '0']);
    	}
    	return redirect()->back();
    }

}

