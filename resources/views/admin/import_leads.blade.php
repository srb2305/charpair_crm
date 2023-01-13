@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h3 style="margin-top: 5px;">Import Lead</h3>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                     @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="post" action="{{ route('uploads_leads') }}"  enctype="multipart/form-data">
                    @csrf
                    <span>* Click For View <a href="/images/Sample_File.xlsx" download>Sample File</a><br></span><br>
                        <div class="form-group">
                                
                            <input type="file" name="file" class="form-control" required="true" placeholder="Please Choose File" >
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
