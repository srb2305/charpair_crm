@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add New Lead</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                    @endif
                    <form method="post" action="{{ route('add_lead') }}">
                    @csrf
                        <div class="form-group">
                                
                            <input type="text" name="name" class="form-control" required="true" placeholder="Please Enter Name" >
                        </div>
                        <div class="form-group">
                            <input type="number" name="contact" class="form-control" required="true" placeholder="Please Enter Contact Number" >
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" required="true" placeholder="Please Enter Email Address" >
                        </div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
