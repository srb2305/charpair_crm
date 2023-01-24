@extends('layouts.admin')
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget widget-one">
                <div class="widget-heading">
                    <h5 class="" style="margin-bottom: 40px;">Task Detail 
                        <a href="{{ route('task_edit',[$id]) }}" class="btn btn-primary" style="float: right; margin-top: -2px;">Edit Task</a>
                    </h5>

                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-chart-section">
                            <div class="row">
                                @foreach($data as $key=>$val)
                                <?php $taskid = $val->id; ?>
                                <div class="col-lg-12">
                                   <h5 class="" style="font-weight: 600; margin-left: 15px;">{{ $val->title }}</h5> 
                                </div>
                                <!-- <div class="col-lg-8">
                                    <p class="p-detail"></p>
                                </div> -->
                                <div class="col-lg-4">
                                   <p class="p-head">Description: </p> 
                                </div>
                                <div class="col-lg-8">
                                    <p class="p-detail">{{ $val->description }}</p>
                                </div>
                                <div class="col-lg-4">
                                   <p class="p-head">Category: </p> 
                                </div>
                                <div class="col-lg-8">
                                    <p class="p-detail">{{ $val->category }}</p>
                                </div>
                                <div class="col-lg-4">
                                   <p class="p-head">Assign To: </p> 
                                </div>
                                <div class="col-lg-4">
                                    <!-- <p class="p-detail">{{ $val->assign_to }}</p> -->
                                    <select class="p-detail" id="assign_to">
                                        <option>Assign User</option>
                                        @foreach($users as $keyy)
                                        <option value="{{ $keyy->id }}" 
                                            @if($val->assign_to == $keyy->id)
                                            selected=""
                                            @endif
                                        >{{ $keyy->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="col-lg-4"></div> 
                                
                                <div class="col-lg-4">
                                   <p class="p-head">Assign By: </p> 
                                </div>
                                <div class="col-lg-8">
                                    <p class="p-detail">{{ $val->assign_by }}</p>
                                </div>
                                <div class="col-lg-4">
                                   <p class="p-head">Task Start Date: </p> 
                                </div>
                                <div class="col-lg-8">
                                    <p class="p-detail">{{ $val->task_start_date }}</p>
                                </div>
                                <div class="col-lg-4">
                                   <p class="p-head">Task End Date: </p> 
                                </div>
                                <div class="col-lg-8">
                                    <p class="p-detail">{{ $val->task_end_date }}</p>
                                </div>
                                <div class="col-lg-4">
                                   <p class="p-head">Status: </p> 
                                </div>
                                <div class="col-lg-8">
                                    <select class="p-detail" id="status">
                                        <option>Select Status</option>
                                        <option  value="0" 
                                            @if($val->status == 0)
                                            selected=""
                                            @endif
                                        >Not Started</option>
                                        <option  value="1" 
                                            @if($val->status == 1)
                                            selected=""
                                            @endif
                                        >In Process</option>
                                        <option  value="2" 
                                            @if($val->status == 2)
                                            selected=""
                                            @endif
                                        >Completed</option>
                                        <option  value="3" 
                                            @if($val->status == 3)
                                            selected=""
                                            @endif
                                        >Hold</option>
                                    </select>
                                    <!-- @if($val->status==0)
                                    <p class="p-detail" id="status">Not Started </p>
                                    @elseif($val->status==1)
                                    <p class="p-detail" id="status">In Process </p>
                                    @elseif($val->status==3)
                                    <p class="p-detail" id="status">Completed </p>
                                    @else
                                    <p class="p-detail" id="status">Hold </p>
                                    @endif -->
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
            <div class="widget widget-one">
                <div class="widget-heading">
                    <h5 class="" style="margin-bottom: 40px;">Task Comments</h5>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-chart-section">
                            <div class="row" style="margin-left: 15px;">
                                @foreach($data1 as $k=>$v)
                                <div class="col-lg-6">
                                   <p class="p-detail">{{ $v->comment }}</p> 
                                   <hr>
                                </div>
                                <div class="col-lg-4">
                                    <p class="p-head">By {{ $v->name }} - {{ Carbon\Carbon::parse($v->created_at)->format('d M Y') }} </p>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data" action="{{ route('add_taskcomment') }}">
                                     @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                @foreach($data as $key=>$val)
                                                <input type="hidden" name="taskid" value="{{ $val->id }}">
                                                @endforeach
                                                <textarea name="comment" class="form-control" placeholder="Please Enter New Comment"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3" >
                                            </div>
                                        </div>
                                    </form>
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
</style>
@endsection
@push('footer-script')
<script type="text/javascript">
    $(document).on('change','#assign_to',function(){
            var assign_to = $(this).val();
            // console.log($(this).val());
            var taksID = "{{$taskid}}";
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
            var taksID = "{{$taskid}}";
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
</script>
@endpush