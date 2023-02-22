@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add Status
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
                    <form method="post" enctype="multipart/form-data" action="{{ route('status_add') }}">
                    @csrf
                    	<div class="form-row">
                        	<div class="form-group col-md-12">
						    	<input type="text" class="form-control" name="date" id="datepicker" required="true" value="<?php echo date("d-m-Y");?>" autocomplete="off" >
						    </div>
						</div>
                        <div class="form-row">
                        	<div class="form-group col-md-12">
						    	<input type="text" class="form-control" name="title" placeholder="Please Enter Title">
						    </div>
						</div>
						<div class="form-row">
                        	<div class="form-group col-md-12">
						    	<textarea class="form-control" name="description" placeholder="Please Enter Description" id="editor"></textarea>					    	
						    </div>
						</div>
						<div class="form-row">
                        	<div class="form-group col-md-12">
						    	<select class="form-control" name="status" required="true">
						    		<option value="">Please Select Status</option>
						    		<option value="0">Pending</option>
						    		<option value="1">Complete</option>
						    	</select>
						    					    	
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
@push('footer-script')
    <script>

    	$(function(){
    	$('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        endDate: '+0d',
        autoclose: true
    	});
	});
     ClassicEditor.create(document.querySelector("#editor"));
    </script>
@endpush

