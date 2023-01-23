<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
         return view('admin/change-password');
    }

    
    public function store(Request $request)
    {
         $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect('change_password')->with('message', 'Password Updated Successfully');
    }




    public function indexProfile()
    {
        $id = Auth::user()->id;
         $data = User::where('id', $id)
                    ->first();

            return view('admin/profile', compact('data'));
    }
	

	public function updateProfile(Request $request, $id)
	{
		$name = $request->input('name');
        $username = $request->input('username');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $gender = $request->input('gender');
        $image = $request->input('image');
        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $chk = $request->file('image')->move(public_path('img'), $fileNameToStore);
          
        }  else {
            $fileNameToStore = $request->input('old_image');
        }

	
       $update= User::where('id', $id)
                ->update(['name'=>$name, 'username'=>$username,'email' =>$email, 'mobile' =>$mobile,'gender' =>$gender, 'image' =>$fileNameToStore], 'updated_at' => Carbon::now()
);

       return redirect('profile')->with('message','Your Profile has been Updated Successfully');

	}

    










    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
