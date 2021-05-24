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
    <form enctype="multipart/form-data" id="user-edit" action="{{route('profile.update', $user->id)}}"  method="POST">
      @csrf
      @method('PUT')

    <div class="row">
        <div class="col-lg-3">
            <div class="custom-bg-white">
                <div class="py-3">
                    <input type="hidden" name="old_profile" id="old_profile" value="stored">
                    @if($user['avatar'])
                    <input type="file" name="file" data-plugins="dropify" data-default-file="{{asset('storage/uploads').'/'.$user['avatar']}}">
                    @else
                    <input type="file" name="file" data-plugins="dropify" data-default-file="{{asset('assets/images/default-user.png')}}">
                    @endif
                </div>
            </div>
            @if($errors->has('file'))
                <div class="error">{{ $errors->first('file') }}</div>
            @endif
        </div>
        <div class="col-lg-9">
            <div class="custom-bg-white">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="form-title">{{__('admin.label.edit')}} {{__('admin.label.profile')}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="first-name">{{__('admin.label.name')}} <span class="error">*</span></label>
                            <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" placeholder="Enter First Name">
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="e-Mail">{{__('admin.label.email')}} <span class="error">*</span></label>
                            <input type="text" name="email" value="{{$user->email}}" id="e-Mail*" class="form-control" placeholder="Enter Email Address">
                            @if($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="gender">{{__('admin.label.gender')}} <span class="error">*</span></label>
                            <select name="gender" class="form-control select2" id="gender">
                                <option value="">Select Gender</option>
                                <option value="male" @if(strtolower($user->gender) == 'male') selected @endif>Male</option>
                                <option value="female" @if(strtolower($user->gender) == 'female') selected @endif>Female</option>
                            </select>
                            <br/>
                            @if($errors->has('gender'))
                                <div class="error">{{ $errors->first('gender') }}</div>
                            @endif
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
<link href="{{asset('assets/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

<style media="screen">
  .error{
    color:red !important;
  }
</style>
@endpush
@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="{{asset('assets/js/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/dropify.min.js')}}"></script>

<!-- Init js-->
<script src="{{asset('assets/js/form-fileuploads.init.js')}}"></script>

<script type="text/javascript">
  $(".dropify-clear").click(function(){
    $("#old_profile").val('deleted');
  })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#user-edit").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                gender: "required",
            },
            messages:{
                name: "Name is required.",
                email:{
                    required: "Email is required.",
                    email: "Email is invalid.",
                    maxlength: "Email should not be greater than 50 characters."
                },
                gender: "Gender is required."
            }
        });
    });
</script>
@endpush
