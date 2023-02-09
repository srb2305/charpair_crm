@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Update Role</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if(\session()->has('message'))
                    <div class="alert alert-info">
                        {{ \session('message') }}
                    </div>
                    @endif
                     @if(\session()->has('error'))
                    <div class="alert alert-danger">
                        {{ \session('error') }}
                    </div>
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('update_role') }}">
                    @csrf

						<div class="form-row">
						    <div class="form-group col-md-10" style="margin-left: 28px;">
                            <input type="hidden" name="id" value="{{ $data->id }}">
						      <input type="text" name="name" class="form-control" value="{{ $data->name }}">
						    </div>

                            <div class="form-group col-md-10" style="margin-left: 28px;">
                              <input type="text" name="description" class="form-control" value="{{ $data->description }}">
                            </div>
						</div>
                        <input type="submit" name="submit" value="Update" class="btn btn-primary mt-3" style="margin-left: 26px;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
