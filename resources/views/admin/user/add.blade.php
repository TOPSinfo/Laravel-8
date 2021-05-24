@extends('layouts.main')
@section('content')
    <!-- Start Content-->

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{__('admin.label.add')}} {{__('admin.label.user')}}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.label.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.label.add')}} {{__('admin.label.user')}} </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        @include('common.flash')
        <form enctype="multipart/form-data" id="user-add" action="{{route('user.store')}}"  method="POST">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-lg-3">
                    <div class="custom-bg-white">
                        <div class="py-3">
                            <input type="hidden" name="old_profile" id="old_profile" value="stored">
                                <input type="file" name="file" data-plugins="dropify" data-default-file="{{asset('assets/images/default-user.png')}}">
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
                                <h3 class="form-title">{{__('admin.label.add')}} {{__('admin.label.user')}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="first-name">{{__('admin.label.name')}} <span class="error">*</span></label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Enter First Name">
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="e-Mail">{{__('admin.label.email')}} <span class="error">*</span></label>
                                    <input type="text" name="email" value="{{old('email')}}" id="e-Mail*" class="form-control" placeholder="Enter Email Address">
                                    @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="gender">{{__('admin.label.gender')}} <span class="error">*</span></label>
                                    <select name="gender" class="form-control select2" id="gender">
                                        <option value="">{{__('admin.label.please_select',['field'=> __('admin.label.gender')])}}</option>
                                        @foreach($genders as $key=>$value)
                                            <option value="{{$key}}" @if(strtolower(old('gender')) == $key) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('gender'))
                                        <div class="error">{{ $errors->first('gender') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="status">{{__('admin.label.status')}} <span class="error">*</span></label>
                                    <select name="status" class="form-control select2" id="user_status">
                                        @foreach($statusArr as $key=>$value)
                                            <option value="{{$key}}" @if (old('status') == $key) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="role">{{__('admin.label.role')}} <span class="error">*</span></label>
                                    <select name="user_role" class="form-control select2" id="user_role">
                                        <option value="">{{__('admin.label.please_select',['field'=> __('admin.label.role')])}}</option>
                                        @foreach($roles as $key=>$value)
                                            <option value="{{$value->id}}" @if (old('user_role') == $value->id) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('user_role'))
                                        <div class="error">{{ $errors->first('user_role') }}</div>
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
            $("#user-add").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    gender: "required",
                    user_role: "required",
                },
                messages:{
                    name: "The name field is required.",
                    email:{
                        required: "The email field is required.",
                        email: "The email must be a valid email address.",
                        maxlength: "Email should not be greater than 50 characters"
                    },
                    gender: "The gender field is required.",
                    user_role: "The user role field is required."
                }
            });
        });
    </script>
@endpush
