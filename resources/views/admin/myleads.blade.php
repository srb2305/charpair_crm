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
                            <select name="date" class="form-control" id="searchByDate" >
                                    <option value="">Please Select Date</option>
                                    @foreach($data as $key=>$val)
                                    <option value="{{ $val->id }}">{{ $val->date_from }} to {{ $val->date_to }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <!-- <div class="col-lg-4" style="float: left;">
                            <input id="searchByDate" class="form-control flatpickr flatpickr-input active" name="date" type="text" placeholder="Select Date..">
                        </div> -->
                        <!-- <div class="col-lg-4" style="float: left;">

                            <select name="review_category" id="searchByCategory" class="form-control">
                                <option value="">Please select Category</option>
                                 <option value="1">Start</option>
                                 <option value="2">Complete</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <a href="{{ route('leads_add') }}" class="btn btn-primary" style="float: right; margin-top: 10px; margin-left: 10px;">Add Leads</a>
                <?php $check=Auth::user()->role_id ?>
                @if ($check == 1)
                    <a href="{{ route('export') }}" class="btn btn-info" style="float: right; margin-top: 10px; margin-left: 10px;">Export</a>
                @endif
                    <a href="{{ route('import_leads') }}" class="btn btn-info" style="float: right; margin-top: 10px; margin-left: 10px;">Import</a>
                </div>
                <table id="myleadsTable" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lead Id</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Added By</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                           
                          </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
    
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form id="comment">

                <div class="modal-content">
                <div class="modal-header user-profile" style="padding-top: 5px !important; padding-bottom: 5px !important;">
                    <h3 class="">Lead Profile</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body" id="modalData" style="max-height : 450px; ">
                  
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                
            </div>
            </form>
        </div>
        
    </div>
@endsection
@push('footer-script')
    <script>
        var f3 = flatpickr(document.getElementById('searchByDate'), {
            mode: "range"
        });

 
        $(document).ready(function(){
            var dataTable = $('#myleadsTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'searching': true, 
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                'url':'{{ route('myleadsTableData') }}',
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
                    { data: 'leadid' },
                    { data: 'name' },
                    { data: 'contact' },
                    { data: 'email' },
                    { data: 'added_by' },
                    { data: 'created_at' },
                    { data: 'status' },
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
                }
            });
        }
    </script>
    <script>
        $(document).ready(function(){

            $('#comment').on('submit',function(e){
                e.preventDefault();

                $.ajax({
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('addcomment') }}",
                    data: $('#comment').serialize(),
                    success: function(response){
                        console.log(response)
                        var id = $('#user_id').val();
                        getData(id);
                        // $('#exampleModalCenter').modal('hide')
                     //   alert("Comment Saved");
                    },
                    error: function(error){
                        console.log(error)
                        alert("Comment not Saved");
                    }

                });
            });
        });
    </script>
@endpush

