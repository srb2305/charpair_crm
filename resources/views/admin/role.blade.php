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
                    </label>Add Role
                    <div class="collapse col-lg-12" id="demo">
                        <form method="post" enctype="multipart/form-data" action="{{ route('add_role') }}">
                    @csrf
						<div class="form-row">
						    <div class="form-group col-md-4">
						    	<input type="text" name="name" class="form-control" placeholder="Please Enter New Role" autocomplete="off">
						    </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="description" class="form-control" placeholder="Please Enter Role Description">
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
                <table id="roleTable" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Role Description</th>
                            <th>Date</th>
                            <th>Action</th>                          
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('footer-script')
    <script>

        $(document).ready(function(){
            var dataTable = $('#roleTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'searching': true, 
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                'url':'{{ route('roleTableData') }}',
                'data': function(data){
          
                        // Read values
                        var date = $('#searchByDate').val();
                        var review_category = $('#searchByCategory').val();
                        var rating = $('#searchByRating').val();

                        // Append to data
                        data.searchByDate = date;
                        data.searchByCategory = review_category;
                        data.searchByRating = rating;
                    }
                },
                'columns': [
                    { data: 'id' },
                    { data: 'roleid' },
                    { data: 'name' },
                    { data: 'description' },
                    { data: 'created_at' },
                    { data: 'action' },
                    
                    ]
            });

            $('#searchByDate').change(function(){
                dataTable.draw();
            });

            $('#searchByCategory').change(function(){
                dataTable.draw();
            });

            $('#searchByRating').change(function(){
                dataTable.draw();
            });

        });
    </script>
    <script>
         function deleteThis(val) {

            var id = val;
            var url = "{{ route('roleDelete',':id') }}";
            url = url.replace(':id', id);

            var token = "{{ csrf_token() }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: {'_token': token, '_method': 'DELETE'},
                success: function (response) {
                    if (response.status == "success") {
                       alert('Deleted Successfully');
                        location.reload();
                     
                    }
                }
            });
        }
    </script>
@endpush

