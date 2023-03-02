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
                        <div class="row">
                            <!-- <div class="col-lg-4" style="float: left;">
                                <input id="searchByDate" class="form-control flatpickr flatpickr-input active" name="date" type="text" placeholder="Select Date..">
                            </div> -->
                            <div class="col-lg-4" style="float: left;">
                                <select name="comment" id="searchByResponse" class="form-control">
                                    <option value="">Please select Response</option>
                                    @foreach($dataComment as $key=>$value)
                                    <option value="{{$value->comment}}">{{ $value->comment }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4" style="float: left;">
                                <select name="leads" id="searchByLeads" class="form-control">
                                    <option value="">Please select Leads</option>
                                    @if(isset($dataLead))
                                    @foreach($dataLead as $key=>$val)
                                    <option value="{{ $val->id }}">{{ $val->lead_from }} to {{ $val->lead_to }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <dir class="clearfix"></dir>
                        
                    </div>    
                </div>
                <div class="col-lg-12">
                    <a href="{{ route('leads_add') }}" class="btn btn-primary" style="float: right; margin-top: 10px; margin-left: 10px;">Add Leads</a>
                <?php $check=Auth::user()->id ?>
                @if ($check == 7)
                    <a href="{{ route('export') }}" class="btn btn-info" style="float: right; margin-top: 10px; margin-left: 10px;">Export</a>
                @endif
                    <a href="{{ route('import_leads') }}" class="btn btn-info" style="float: right; margin-top: 10px; margin-left: 10px;">Import</a>
                </div>
                <table id="leadsTable" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lead'Id</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Added By</th>
                            <th>Last Call</th>
                            <th>Response</th>
                            <th>Status</th>
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
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12" ></i>Back</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </div>
                
            </div>
            </form>
        </div>
        
    </div>
@endsection
@push('footer-script')
    <script>
        var dataTable = '';
       // $(document).ready(function(){
             dataTable = $('#leadsTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'stateSave': true,
                'searching': true, 
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                'url':'{{ route('leadsTableData') }}',
                'data': function(data){
          
                        // Read values
                        var comment = $('#searchByResponse').val();
                        var leads = $('#searchByLeads').val();
                        var date = $('#searchByDate').val();
                        var review_category = $('#searchByCategory').val();
                        var rating = $('#searchByRating').val();

                        // Append to data
                        data.searchByResponse = comment;
                        data.searchByLeads = leads;
                        
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
                    { data: 'comment' },
                    { data: 'status' },
                    { data: 'action' },
                    ]
            });

            $('#searchByResponse').change(function(){
                dataTable.draw();
            });
            $('#searchByLeads').change(function(){
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
     
        function suggestionRefresh(){
            $('#pre_comment').on('change',function(e){ 
                $('#comment_textarea').val($(this).val());
            });
        }    
        
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
                        // console.log(response)
                        var id = $('#user_id').val();
                        getData(id);
                        // draw.location.reload();
                         //dataTable.draw.reload();
                        // dataTable.ajax.draw.reload();
                        dataTable.ajax.reload(null, false);
                    },
                    error: function(error){
                        console.log(error)
                        alert("Comment not Saved");
                    }

                });
            });
            
       
    </script>
@endpush

 