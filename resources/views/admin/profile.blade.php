@extends('layouts.admin')

@push('header-script')
 <link href="" rel="stylesheet" type="text/css">
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify/dropify.min.css') }}">
    <link href="{{ asset('css/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
@endpush

@section('content')

<div class="layout-px-spacing">                
    <div class="account-settings-container layout-top-spacing">
        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        <form action="{{ route('updateProfile', [$data->id]) }}" method="POST" enctype="multipart/form-data" id="general-info" class="section general-info">
                            {{ method_field('PATCH') }}
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            <div class="info">
                        <h6 class="">Edit Profile Details</h6>
                            <div class="row">
                                 @if(\session()->has('message'))
                                    <div class="alert alert-info">
                                    {{ \session('message') }}
                                    </div>
                                @endif
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                            <div class="upload mt-4 pr-md-4">
                                            <input type="hidden" name="old_image" value="{{$data->image}}">
                                            <input type="file" id="input-file-max-fs" class="dropify" data-default-file="{{ url('/img/'.$data->image) }}" name="image" data-max-file-size="2M" />
                                            <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                            </div>
                                            
                                        </div>
                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                        <div class="form">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control mb-4" id="fullName" placeholder="Full Name" name="name" value="{{$data->name}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="userName">User Name</label>
                                            <input type="text" class="form-control mb-4" id="userName" placeholder="User Name" name="username" value="{{$data->username}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="emailAddress">Email Address</label>
                                            <input type="email" class="form-control mb-4" id="emailAddress" placeholder="Email Address" name="email" value="{{$data->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="mobileNo">Mobile Number</label>
                                    <input type="text" class="form-control mb-4" id="mobileNo" placeholder="Mobile Number" name="mobile" value="{{$data->mobile}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="{{$data->gender}}">Please select status</option>
                                        <?php if($data->gender == 'Male'){ ?>
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
                                        <?php }else{ ?>
                                        <option value="Male">Male</option>
                                        <option value="Female" selected>Female</option><?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-info btn-lg btn-block" style="margin-top: 30px;">Update Profile</button>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection
@push('footer-script')
        <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="{{ asset('plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('plugins/blockui/jquery.blockUI.min.js') }}"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{ asset('js/users/account-settings.js') }}"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
@endpush