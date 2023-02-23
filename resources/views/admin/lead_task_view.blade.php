@extends('layouts.admin')
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget widget-one">
                <div class="widget-heading">
                    <h5 class="" style="margin-bottom: 40px;">Lead Task Detail 
                        <!-- <a href="{{ route('task_edit',[$id]) }}" class="btn btn-primary" style="float: right; margin-top: -2px;">Edit Task</a>
                        <a href="javascript:void(0)" onclick="destroy({{$id}})" class="btn btn-danger" style="float: right; margin-top: -2px;margin-right: 10px;">Delete</a> -->
                        <a href="{{ url()->previous() }}" class="btn btn-info" style="float: right; margin-top: -2px;margin-right: 10px;">Back</a>
                    </h5>

                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-chart-section">
                            <div class="row">
                                @foreach($data as $key=>$val)
                                <?php $id = $val->id; ?>
                                
                                <div class="col-lg-3">
                                   <p class="p-head">Employee Name: </p> 
                                </div>
                                <div class="col-lg-9">
                                    <p class="p-detail">{{ ucfirst($val->user_id) }}</p>
                                </div>
                                <div class="col-lg-3">
                                   <p class="p-head">Assign By: </p> 
                                </div>
                                <div class="col-lg-9">
                                    <p class="p-detail">{{ ucfirst($val->assign_by) }}</p>
                                </div>
                                <div class="col-lg-3">
                                   <p class="p-head">Leads Assign: </p> 
                                </div>
                                <div class="col-lg-9">
                                    <p class="p-detail"> From {{$val->lead_from}} To {{$val->lead_to}}</p>
                                </div>
                                <div class="col-lg-3">
                                   <p class="p-head">Date From : </p> 
                                </div>
                                <div class="col-lg-9">
                                    <p class="p-detail">{{ Carbon\Carbon::parse($val->date_from)->format('d M Y') }}</p>
                                </div>
                                <div class="col-lg-3">
                                   <p class="p-head">Date To : </p> 
                                </div>
                                <div class="col-lg-9">
                                    <p class="p-detail">{{ Carbon\Carbon::parse($val->date_to)->format('d M Y') }}</p>
                                </div>
                                <div class="col-lg-3">
                                   <p class="p-head"> Status : </p> 
                                </div>
                                <div class="col-lg-9">
                                	<p class="p-detail"> 
                                		@if($val->status == 0) Pending 
                                        @elseif($val->status == 1) In Process 
                                        @elseif($val->status == 2) Complete 
                                        @else Hold  
                                        @endif
                                    </p>
                                </div>
                                <div class="col-lg-3">
                                   <p class="p-head">Assign Date : </p> 
                                </div>
                                <div class="col-lg-9">
                                    <p class="p-detail">{{ Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</p>
                                </div>                               
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .heading{
        font-weight: bold;
        text-align: center;
        margin-bottom: 25px;
    }
    .p-head{
        font-size: 15px;
        font-weight: 500;
        margin-left: 15px;
    }
    .p-detail{
        font-size: 15px;
        font-weight: 700;
       /* margin-left: 15px;*/
    }
    .p-detail1{
        font-size: 15px;
        font-weight: 700;
        margin-left: 16px;
        margin-top: 7px;
        margin-bottom: 20px;
    }
    .logbuttton{
        margin-left: 30px;
        float: right;
        margin-top: -22px;
    }
    #commentDiv{
        width: auto;
        max-height: 140px;
        overflow-y: auto; 
        overflow-x: hidden;
    }
    .spanview{
        float: right; 
        margin-top: -52px; 
        margin-right: 55px;
    }
    .ck-editor__editable {
      min-height: 100px;
    }
        
</style>
@endsection
@push('footer-script')
<!-- <script type="text/javascript">
    

    $(document).on('change','#assign_to',function(){
            var assign_to = $(this).val();
            // console.log($(this).val());
            var taksID = "{{$id}}";
            var token = "{{ csrf_token() }}";

            $.ajax({
                type: 'POST',
                url: "{{ route('taskAssignTo') }}",
                data: {'_token':token,'assign_to': assign_to, 'id': taksID},
                success: function (response) {
                    if (response.status == "success") {
                       alert('Task Assign Successfully');
                        location.reload();
                    }
                }
            });
    } );

    $(document).on('change','#status',function(){
            var status = $(this).val();
            // console.log($(this).val());
            var taksID = "{{$id}}";
            var token = "{{ csrf_token() }}";

            $.ajax({
                type: 'POST',
                url: "{{ route('taskStatus') }}",
                data: {'_token':token,'status': status, 'id': taksID},
                success: function (response) {
                    if (response.status == "success") {
                       alert('Status Update Successfully');
                        location.reload();
                    }
                }
            });
    } );

     function destroy(val){
        if (confirm('Do you realy want to delete this Task')) {
            
            var id = val;
            var token = "{{ csrf_token() }}";
            var url = "{{ route('task_delete',':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url:"{{ route('task_delete',':id')  }}",
                type:'delete',
                url: url,
                data: {'_token': token, '_method': 'DELETE'},
                success: function (response) {
                    if (response.status == "success") {
                       alert('Deleted Successfully');
                        location.replace('/tasks')
                     //   $('#vehicleTable').ajax.reload();
                    }
                }
            });
        }
    }
</script> -->
@endpush