@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Employee</h4>
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
                    @if($errors->any())
					    <div class="alert alert-danger">
					        <p><strong>Email has Already Registered</strong></p>
					    </div>
					@endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('update_employee') }}">
                    @csrf

                        <div class="form-row">
						    <div class="form-group col-md-4">
						    	<input type="hidden" name="id" value="{{ $data->id }}">

						      <input type="text" name="name" class="form-control" required="true" placeholder="Please Enter Name" value="{{ $data->name }}">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="number" class="form-control" name="mobile" required="true" placeholder="Please Enter Contact number" value="{{ $data->mobile }}">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="text" class="form-control" name="username" placeholder="Please Enter Username" value="{{ $data->username }}">
						    </div>
						</div>

						<div class="form-row">
						    <div class="form-group col-md-4">
						      <input type="email" name="email" class="form-control" required="true" placeholder="Please Email Address" value="{{ $data->email }}">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="password" class="form-control" name="password" placeholder="Please Enter password">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="number" class="form-control" name="sos" placeholder="Please Enter Alterate Number" value="{{ $data->sos }}">
						    </div>
						</div>

						<div class="form-row">
						    <div class="form-group col-md-4" style="    padding-left: 40px; padding-top: 8px;">
						       <label style="color: black; font-size: 16px;" ><b>Gender:&nbsp;&nbsp;</b></label>
						       	<div class="form-check form-check-inline" style="margin-top: 2px;">
								<input class="form-check-input" type="radio" name="gender" value="male"  {{ $data->gender == 'male' ? 'checked' : '' }} >
								<label class="form-check-label"><b>Male</b></label>
								</div>
							   <div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="gender" value="female" {{ $data->gender == 'female' ? 'checked' : '' }} >
								  <label class="form-check-label"><b>FeMale</b></label>
								</div>
						    </div>
						    <div class="form-group col-md-4">
						    	<select class="form-control" required="true" name="designation">
						    		<option>{{ $data->designation }}</option>
						    		<option value="telecaller">Telecaller</option>
						    		<option value="salesperson">Sales Person</option>
						    	</select>
						    </div>
						    <div class="form-group col-md-4">
						      	<select class="form-control" required="true" name="department">
						    		<option>{{ $data->designation }}</option>
						    		<option value="telecalling">Telecalling</option>
						    		<option value="marketing">Marketing</option>
						    	</select>
						    </div>
						</div>

						<div class="form-row">
						    <div class="form-group col-md-4">
						      <input type="date" class="form-control" name="dob" placeholder="Please Enter DOB">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="text" name="company" class="form-control" placeholder="Please Company Name" value="{{ $data->company }}">
						    </div>
						    <div class="form-group col-md-4">
						      <input type="file" class="form-control" name="image">
						    </div>
						</div>
                        <input type="submit" name="submit" value="Update" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
