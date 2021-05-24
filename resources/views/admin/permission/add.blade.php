@extends('layouts.main')
@section('content')
<!-- Start Content-->

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{__('admin.label.add')}} {{__('admin.label.permission')}}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.label.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.label.add')}} {{__('admin.label.permission')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @include('common.flash')
    <form enctype="multipart/form-data" id="permission-add" action="{{route('permission.store')}}"  method="POST">
      @csrf
        @method('POST')
    <div class="row">

        <div class="col-lg-12">
            <div class="custom-bg-white">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="form-title">{{__('admin.label.add')}} {{__('admin.label.permission')}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="name">{{__('admin.label.name')}} <span class="error">*</span></label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Enter Permission Name">
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="status">{{__('admin.label.status')}} <span class="error">*</span></label>
                            <select name="status" class="form-control select2" id="permission_status">
                                @foreach($statusArr as $key=>$value)
                                    <option value="{{$key}}" @if (old('status') == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="status">{{__('admin.label.module')}} </label>
                            <select name="module_id" class="form-control select2" id="module_id" >
                                <option value="" @if (old('module_id') == '') selected @endif>{{__('admin.label.please_select',['field'=> __('admin.label.module')])}}</option>
                                @foreach($modules as $value)
                                    <option value="{{$value->id}}" @if (old('status') == $value->id) selected @endif>{{$value->name}}</option>
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
<script type="text/javascript">
    $(document).ready(function() {
        $("#permission-add").validate({
            rules: {
                name: "required"
            },
            messages:{
                name: "The name field is required.",
            }
        });
    });
</script>
@endpush
