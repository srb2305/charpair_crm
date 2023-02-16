@extends('layouts.admin')
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget widget-one">
                <div class="widget-heading">
                    <h5 class="" style="margin-bottom: 40px;">Task Detail 
                        <a href="{{ route('task_edit',[$id]) }}" class="btn btn-primary" style="float: right; margin-top: -2px;">Edit Task</a>
                        <a href="javascript:void(0)" onclick="destroy({{$id}})" class="btn btn-danger" style="float: right; margin-top: -2px;margin-right: 10px;">Delete</a>
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
                                   <h4 class="" style="font-weight: 600; margin-left: 15px;">{{ ucfirst($val->title) }}</h4> 
                                </div>
                                <!-- <div class="col-lg-8">
                                    <p class="p-detail"></p>
                                </div> -->
                                <div class="col-lg-12">
                                   <span class="p-detail1">{!! ucfirst($val->description) !!}</span> 
                                <hr>
                                </div>
                                <!-- <div class="col-lg-8">
                                    <p class="p-detail"></p>
                                </div> -->
                                <div class="col-lg-2">
                                   <p class="p-head">Category: </p> 
                                </div>
                                <div class="col-lg-10">
                                    <p class="p-detail">{{ $val->category }}</p>
                                </div>
                                <div class="col-lg-2">
                                   <p class="p-head">Assign To: </p> 
                                </div>
                                <div class="col-lg-10">
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
                                
                                <div class="col-lg-2">
                                   <p class="p-head">Assign By: </p> 
                                </div>
                                <div class="col-lg-10">
                                    <p class="p-detail">{{ $val->assign_by }}</p>
                                </div>
                                <div class="col-lg-2">
                                   <p class="p-head">Task Start Date: </p> 
                                </div>
                                <div class="col-lg-10">
                                    <p class="p-detail">{{ $val->task_start_date }}</p>
                                </div>
                                <div class="col-lg-2">
                                   <p class="p-head">Task End Date: </p> 
                                </div>
                                <div class="col-lg-10">
                                    <p class="p-detail">{{ $val->task_end_date }}</p>
                                </div>
                                <div class="col-lg-2">
                                   <p class="p-head">Status: </p> 
                                </div>
                                <div class="col-lg-10">
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
                                </div>
                                <div class="col-lg-2">
                                   <p class="p-head">Task Priority: </p> 
                                </div>
                                <div class="col-lg-10">
                                    <p class="p-detail">
                                        @if($val->task_priority==1) High 
                                        @elseif($val->task_priority==2) Medium 
                                        @elseif($val->task_priority==3) Low 
                                        @else --  
                                        @endif</p>
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
                    <h5 class="" style="margin-bottom: 30px;">Task Comments</h5>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-chart-section">
                            @if(!empty($data1))
                            <div class="row" id="commentDiv" style="margin-left: 15px;">
                                @foreach($data1 as $k=>$v)
                                <div class="col-lg-6">
                                   <p>{!! $v->comment !!}</p> 
                                   <hr>
                                </div>
                                <div class="col-lg-4">
                                    <p class="p-head">By {{ $v->name }} - {{ Carbon\Carbon::parse($v->created_at)->format('d M Y') }} </p>
                                </div>
                                <div class="col-lg-2">
                                    <?php $cId=$v->id; ?>
                                    <a href="{{ route('comment_delete',[$cId]) }}" style="color: red;">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data" action="{{ route('add_taskcomment') }}">
                                     @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                @foreach($data as $key=>$val)
                                                <input type="hidden" name="taskid" value="{{ $val->id }}">
                                                @endforeach
                                                <textarea name="comment" class="form-control" placeholder="Please Enter New Comment" id="editor" rows="4"></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
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

            <div class="widget widget-one" style="margin-top: 15px;">
                <div class="widget-heading">
                    <h5 class="" style="margin-bottom: 30px;">Task Logs</h5>
                <span class="spanview">View logs</span><label class="switch s-primary  mb-4 mr-2" data-toggle="collapse" data-target="#demo" style="float: right; margin-top: -50px;">
                         <input type="checkbox">
                        <span class="slider round"></span>
                </label>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w-chart-section">
                           <table class="table" style="width:100%;" id="demo">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Old Value</th>
                                        <th>New Value</th>
                                        <th style="width: 15%;">Added By</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($data2))
                                    @foreach($data2 as $key=>$val)
                                    
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{ $val->title }}</td>
                                        <td>{!! $val->old_value !!}</td>
                                        <td>{!! $val->new_value !!}</td>
                                        <?php  $dt = (strtotime($val->created_at));
                                            $date = date('d-M-y', $dt);
                                            $time = date('g:i A', $dt);
                                            $datetime= $date." ".$time ;?>
                                        <td>{{ $val->name }}<br>{{ $datetime }}</td>
                                        
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table> 
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
    ClassicEditor.create(document.querySelector("#editor"));
</script>
@endpush