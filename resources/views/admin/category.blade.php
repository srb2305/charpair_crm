@extends('layouts.admin')
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
            	<div class="row container">
                    <label class="switch s-primary  mb-4 mr-2" data-toggle="collapse" data-target="#demo">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>Add Category
                    <div class="collapse col-lg-12" id="demo">
                        <form method="post" enctype="multipart/form-data" action="{{ route('add_category') }}">
                    @csrf
						<div class="form-row">
						    <div class="form-group col-md-4">
						    	<input type="text" name="category" class="form-control" placeholder="Please Enter New Category">
						    </div>
						    <div class="form-group col-md-3" style="margin-top: -13px; ">
						    	 <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3" style="margin-left: 25px;">
						    </div>
						</div>
                       
                    </form>
                    </div>
                </div>
                <div class="col-lg-12">
                   
                </div>
                <table id="categoryTable" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Add Date</th>                        
                            <th>Action</th>                        
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($data as $key=>$val)
                    	<tr>
                    		<td>#</td>
                    		<td>{{ $val->title }}</td>
                    		<td>{{ Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</td>
                            <td><a href="{{ route('delete_category',['id' => $val->id]) }}" class="btn btn-danger">Delete</a></td>
                    	</tr>
                    	@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('footer-script')