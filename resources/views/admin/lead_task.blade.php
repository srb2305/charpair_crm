@extends('layouts.admin')
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="col-lg-12">
                    <a href="{{ route('task_generate') }}" class="btn btn-primary" style="float: right; margin-top: 10px; margin-left: 10px;">Add Lead Task</a>
                </div>
                <table id="leadTaskTable" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <!-- <th>#</th> -->
                            <th>Task ID</th>
                            <th>Employee Name</th>
                            <th>Lead ID</th>
                            <th>Date</th>
                            <th>Assign By</th>
                            <th>Status</th>
                            <th>Assign Date</th>
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
            var dataTable = $('#leadTaskTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'searching': true, 
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                'url':'{{ route('lead_task_table') }}',
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
                    // { data: 'id' },
                    { data: 'taskid' },
                    { data: 'assign_to' },
                    { data: 'lead' },
                    { data: 'date' },
                    { data: 'assign_by' },
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

        });
    </script>
  
@endpush

