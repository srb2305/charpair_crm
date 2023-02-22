@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Task
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
                    <form method="post" action="{{ route('task_update') }}">
                    @csrf
                    	<input type="hidden" name="id" value="{{ $taskDetail->id }}">
                        <!-- <div class="form-row">
                        	<div class="form-group col-md-12">
						    	<select class="form-control" required="true" name="emp_id">
						    		<option value="">{{ $taskDetail->assign_to }}</option>
						    		@foreach($data as $key=>$val)
						    		<option value="{{ $val->id }}">{{ $val->name }}</option>
						    		@endforeach
						    	</select>
						    </div>
						</div> -->
						<div class="form-row">
							
						    <div class="form-group col-md-6">
						      <input type="text" class="form-control" name="title" value="{{ $taskDetail->title }}">
						    </div>
						    <div class="form-group col-md-6">
						      <select class="form-control" name="category">
						    		<option value="">Please Select Category</option>
						    		@foreach($data1 as $k=>$v)
						    		<option value="{{ $v->id }}" 
						    			 @if($taskDetail->category_id == $v->id)
                                            selected=""
                                            @endif
                                            >{{ $v->title }}</option>
						    		@endforeach
						    	</select>
						    </div>
						</div>
						<div class="form-row">
                        	<div class="form-group col-md-12">
						    	<textarea class="form-control" name="description" placeholder="Please Enter Description" id="editor">{{ $taskDetail->description }}</textarea>
						    </div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label style="color: black;"><b>Start Date :</b></label>
							</div>
						    <div class="form-group col-md-2">
						      <input type="date" class="form-control" name="start_date" value="{{ $taskDetail->task_start_date }}" style="margin-left: -20px;">
						    </div>
						    <div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label style="color: black;"><b>End Date :</b></label>
							</div>
						    <div class="form-group col-md-2">
						      <input type="date" class="form-control" name="end_date" value="{{ $taskDetail->task_end_date }}" style="margin-left: -30px;">
						    </div>
						    <div class="form-group col-md-4">
						      <select class="form-control" name="task_priority">
						    		<option value="">Please Select Task Priority</option>
						    		<option value="1"
						    			 @if($taskDetail->task_priority == 1)
                                            selected=""
                                            @endif>High</option>
							      	<option value="2"
							      		@if($taskDetail->task_priority == 2)
                                            selected=""
                                            @endif>Medium</option>
							      	<option value="3"
							      		@if($taskDetail->task_priority == 3)
                                            selected=""
                                            @endif>Low</option>
						    	</select>
						    </div>
						</div>
                        <input type="submit" name="submit" value="Update" class="btn btn-primary mt-3">
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

       
    </script>
@endpush
