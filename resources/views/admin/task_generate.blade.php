@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Task Generate to  Employee</h4>
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
                    <form method="post" enctype="multipart/form-data" action="{{ route('generate_task') }}">
                    @csrf
                        <div class="form-row">
                        	<div class="form-group col-md-12">
						    	<select class="form-control" required="true" name="emp_id">
						    		<option value="">Please Select Employee Name</option>
						    		@foreach($data as $key=>$val)
						    		<option value="{{ $val->id }}">{{ $val->name }}</option>
						    		@endforeach
						    	</select>
						    </div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label>Start Date :</label>
							</div>
						    <div class="form-group col-md-4">
						      <input type="date" class="form-control" name="start_date">
						    </div>
						    <div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label>End Date :</label>
							</div>
						    <div class="form-group col-md-4">
						      <input type="date" class="form-control" name="end_date">
						    </div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label>Lead From :</label>
							</div>
						    <div class="form-group col-md-4">
						      <input type="number" class="form-control" name="lead_idfrom" placeholder="Please Enter Lead ID">
						    </div>
						    <div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label>Lead To :</label>
							</div>
						    <div class="form-group col-md-4">
						      <input type="number" class="form-control" name="lead_idto" placeholder="Please Enter Lead ID">
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
