@extends('layouts.main')
@section('content')
<!-- Start Content-->

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Profile</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.label.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.label.change')}} {{__('admin.label.password')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @include('common.flash')
    <form enctype="multipart/form-data" id="change-password" action="{{route('update.password')}}"  method="POST">
      @csrf
      @method('PUT')
    <div class="row">
        <div class="col-lg-12">
            <div class="custom-bg-white">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="form-title">{{__('admin.label.change')}} {{__('admin.label.password')}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="password">{{__('admin.label.password')}} <span class="error">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            @if($errors->has('password'))
                                <div class="error">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="new-Password">{{__('admin.label.new_password')}} <span class="error">*</span></label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password">
                            @if($errors->has('new_password'))
                                <div class="error">{{ $errors->first('new_password') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="new-Confirm-Password">{{__('admin.label.confirm_password')}} <span class="error">*</span></label>
                            <input type="password" name="new_confirm_password" id="new_confirm_password" class="form-control" placeholder="Enter Confirm Password">
                        </div>
                    </div>

                </div>
                <hr/>
                <div class="row">
                    <div class="col-12">
                        <div class="text-right button-list">
                            <button type="submit" class="btn w-sm btn-blue waves-effect waves-light">{{__('admin.button.save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </form>
</div> <!-- container -->
@endsection
@push('css')
    <style media="screen">
        .error{
            color:red !important;
        }
    </style>
@endpush

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#change-password").validate({
            rules: {
                password: "required",
                new_password: "required",
                new_confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                },
            }
        });
    });
</script>
@endpush
