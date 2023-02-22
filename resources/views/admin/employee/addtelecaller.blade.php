@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add New Employee
	                            <span style="float: right;">
	                                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
	                            </span>
	                        </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if(\session()->has('message'))
                    <div class="alert alert-info">
                        {{ \session('message') }}
                    </div>
                    @endif
                     @if(\session()->has('error'))
                    <div class="alert alert-danger">
                        {{ \session('error') }}
                    </div>
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('add_employee') }}">
                    @csrf
                        <div class="form-row">
						    <div class="form-group col-md-4">
						      <input type="text" name="name" class="form-control" required="true" placeholder="Please Enter Name">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="number" class="form-control" name="mobile" required="true" placeholder="Please Enter Contact number">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="text" class="form-control" name="username" placeholder="Please Enter Username">
						    </div>
						</div>

						<div class="form-row">
						    <div class="form-group col-md-4">
						      <input type="email" name="email" class="form-control" required="true" placeholder="Please Email Address">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="password" class="form-control" name="password" required="true" placeholder="Please Enter password">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="number" class="form-control" name="sos" placeholder="Please Enter Alterate Number">
						    </div>
						</div>

						<div class="form-row">
						    
						    <div class="form-group col-md-6">
						    	<select class="form-control" required="true" name="role_id">
						    		<option value="">Please Select Role</option>
						    		@foreach($data as $key=>$val)
						    		<option value="{{$val->id}}">{{$val->name}}</option>
						    		@endforeach
						    	</select>
						    </div>
						    <!-- <div class="form-group col-md-2">
						      <input type="text" name="company" class="form-control" placeholder="Please Company Name">
						    </div> Designation-->
						    <div class="form-group col-md-6">
						      	<input type="text" name="designation" class="form-control" placeholder="Please Enter Designation">
						    </div>
						</div>

						<div class="form-row">
						    <div class="form-group col-md-4" style="    padding-left: 40px; padding-top: 8px;">
						       <label style="color: black; font-size: 16px;" ><b>Gender:&nbsp;&nbsp;</b></label>
						       	<div class="form-check form-check-inline" style="margin-top: 2px;">
								<input class="form-check-input" type="radio" name="gender" value="male">
								<label class="form-check-label"><b>Male</b></label>
								</div>
							   <div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="gender" value="female">
								  <label class="form-check-label"><b>FeMale</b></label>
								</div>
						    </div>
						    <!-- <div class="form-group col-md-4">
						      <input type="date" class="form-control" name="dob" placeholder="Please Enter DOB">
						    </div> -->
						    <div class="form-group col-md-1" style=" padding-top: 10px;">
						    	<label style="color: black; font-size: 16px;" ><b>DOB:</b></label>
						    </div>
						    <div class="form-group col-md-3">
						      <input type="date" class="form-control" name="dob" placeholder="Please Enter DOB">
						    </div>

						    <div class="form-group col-md-4">
						      <input type="file" class="form-control" name="image">
						    </div>
						</div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
