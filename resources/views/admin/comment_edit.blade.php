@extends('layouts.admin')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div id="" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Update Comment</h4>
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
                    <form method="post" enctype="multipart/form-data" action="{{ route('update_precomment') }}">
                    @csrf

						<div class="form-row">
							<div class="form-group col-md-2" style="padding-top: 12px; padding-left: 25px;">
								<label style="font-size: 20px;">Comment :</label>
							</div>
						    <div class="form-group col-md-8">
                            <input type="hidden" name="id" value="{{ $data->id }}">
						      <textarea class="form-control" name="comment" placeholder="Please Enter New Comment">{{ $data->comment }}</textarea>
						    </div>
						</div>
                        <input type="submit" name="submit" value="Update" class="btn btn-primary mt-3" style="margin-left: 25px;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
