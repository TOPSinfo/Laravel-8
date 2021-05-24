@extends('layouts.main')
@section('content')
<!-- Start Content-->

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{__('admin.label.edit')}} {{__('admin.label.cms')}}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.label.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.label.edit')}} {{__('admin.label.cms')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @include('common.flash')
    <form enctype="multipart/form-data" id="cms-edit" action="{{route('cms.update', $cmsPage->id)}}"  method="POST">
      @csrf
      @method('PUT')

    <div class="row">

        <div class="col-lg-12">
            <div class="custom-bg-white">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="form-title">{{__('admin.label.add')}} {{__('admin.label.cms')}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="title">{{__('admin.label.title')}} <span class="error">*</span></label>
                            <input type="text" name="title" id="title" value="{{$cmsPage->title}}" class="form-control" placeholder="Enter Title">
                            @if($errors->has('title'))
                                <div class="error">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="description">{{__('admin.label.description')}} <span class="error">*</span></label>

                            <textarea class="ckeditor form-control" name="description" id="description" placeholder="Enter Description">{{$cmsPage->description}}</textarea>

                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="status">{{__('admin.label.status')}} <span class="error">*</span></label>
                            <select name="status" class="form-control select2" id="user_status">
                                @foreach($statusArr as $key=>$value)
                                    <option value="{{$key}}" @if ($cmsPage->status == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
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

    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript">

        $(window).on('load', function (){
            CKEDITOR.replace('description', {
                uiColor: '#CCEAEE'
            });
        });

        $(document).ready(function() {

            $("#cms-edit").validate({
                rules: {
                    title: "required",
                    description: "required"
                },
                messages:{
                    title: "The title field is required.",
                    description: "The description field is required.",
                }
            });
        });
    </script>
@endpush
