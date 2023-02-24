@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add Task to Employee
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
                    @if (count($errors) > 0)
					<div class="alert alert-danger">
					    <strong>Error!</strong> something went wrong <br><br>
					    <ul>
					      @foreach ($errors->all() as $error)
					          <li>{{ $error }}</li>
					      @endforeach
					    </ul>
					</div>
					@endif
                    <form method="post" action="{{ route('task_add') }}" enctype="multipart/form-data">
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
						    <div class="form-group col-md-6">
						      <select class="form-control" name="category">
						    		<option value="">Please Select Category</option>
						    		@foreach($data1 as $k=>$v)
						    		<option value="{{ $v->id }}">{{ $v->title }}</option>
						    		@endforeach
						    	</select>
						    </div>
						    <div class="form-group col-md-6">
						      <input type="text" class="form-control" name="title" placeholder="Please Enter Title">
						    </div> 
						</div>
						<div class="form-row">
                        	<div class="form-group col-md-12">
						    	<textarea class="form-control" name="description" placeholder="Please Enter Description" id="editor"></textarea>
						    </div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label style="color: black;"><b>Start Date :</b></label>
							</div>
						    <div class="form-group col-md-2">
						      <input type="date" class="form-control" name="start_date" style="margin-left: -20px;">
						    </div>
						    <div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label style="color: black;"><b>End Date :</b></label>
							</div>
						    <div class="form-group col-md-2">
						      <input type="date" class="form-control" name="end_date" style="margin-left: -30px;">
						    </div>
						    <div class="form-group col-md-4" >
						      <select class="form-control" name="task_priority">
						      	<option>Please Select Task Priority</option>
						      	<option value="1">High</option>
						      	<option value="2">Medium</option>
						      	<option value="3">Low</option>
						      </select>
						    </div>
						</div>
						<div class="input-group control-group increment" >
					        <input type="file" name="filename[]" class="form-control">
					        <div class="input-group-btn" style="margin-left: 15px;"> 
					           <button class="btn btn-success" id="addimg" type="button"><i class="glyphicon glyphicon-plus"></i>Add More Images</button>
					        </div>
					    </div>
					    <div class="clone hide">
					        <div class="control-group input-group" style="margin-top:10px">
					            <input type="file" name="filename[]" class="form-control">
					        	<div class="input-group-btn" style="margin-left: 15px;"> 
					            	<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
					        	</div>
					       </div>
					    </div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style >
	.ck-editor__editable {
      min-height: 100px;
    }
</style>
@endsection
@section('footer-script')
@push('footer-script')
    <script>
       ClassicEditor.create(document.querySelector("#editor"));



	    $(document).ready(function() {
	    	$(".clone").hide();
	      $("#addimg").click(function(){ 
	          var html = $(".clone").html();
	          $(".increment").after(html);
	      });

	      $("body").on("click",".btn-danger",function(){ 
	          $(this).parents(".control-group").remove();
	      });

	    });


       
    </script>
@endpush
