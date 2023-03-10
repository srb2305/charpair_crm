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
                                </label>Filters
                        <div class="collapse col-lg-12" id="demo">
                            <div class="col-lg-4" style="float: left;">
                                <select name="status" id="searchByStatus" class="form-control">
                                    <option value="">Please select status</option>
                                    <option value="0">Not Started</option>
                                    <option value="1">In Process</option>
                                    <option value="2">Completed</option>
                                    <option value="3">Hold</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12">
                    <a href="{{ route('add_task') }}" class="btn btn-primary" style="float: right; margin-top: 10px; margin-left: 10px;">Add Tasks</a>
                </div>
                <table id="TaskTable" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task'Id</th>
                            <th>Assign To</th>
                            <th>Assign By</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Task Date</th>
                            <th>Action</th>
                           
                            <!-- <th>Sending Date</th>
                            <th>Sending Date</th> -->
                            
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
        var dataTable = '';
       // $(document).ready(function(){
             dataTable = $('#TaskTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'searching': true, 
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                'url':'{{ route('taskTableData') }}',
                'data': function(data){
          
                        // Read values
                        var date = $('#searchByDate').val();
                        var review_category = $('#searchByCategory').val();
                        var rating = $('#searchByRating').val();
                        var status = $('#searchByStatus').val();

                        // Append to data
                        data.searchByDate = date;
                        data.searchByCategory = review_category;
                        data.searchByRating = rating;
                        data.searchByStatus = status;
                    }
                },
                'columns': [
                    { data: 'id' },
                    { data: 'taskid' },
                    { data: 'assign_to' },
                    { data: 'assign_by' },
                    { data: 'title' },
                    { data: 'category' },
                    { data: 'status' },
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
            $('#searchByStatus').change(function(){
                dataTable.draw();
            });

       // });
        function getData(val) {
            var id = val;
            var url = "{{ route('leadDetail') }}";
            url = url.replace(':id', id);
            var token = "{{ csrf_token() }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: {'_token': token, 'id': id},
                success: function (data) {
                    $('#exampleModalCenter').modal('show');
                    $('#modalData').html(data);
                    suggestionRefresh();
                }
            });
        }


        function deleteThis(val) {

            var id = val;
            var url = "{{ route('leadDelete',':id') }}";
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
                     //   $('#vehicleTable').ajax.reload();
                    }
                }
            });
        }
    

       
    </script>
    
@endpush

 