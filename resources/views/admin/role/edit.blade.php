@extends('layouts.main')
@section('content')
<!-- Start Content-->

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{__('admin.label.edit')}} {{__('admin.label.role')}}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.label.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.label.edit')}} {{__('admin.label.role')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @include('common.flash')
    <form enctype="multipart/form-data" id="role-edit" action="{{route('role.update', $role->id)}}"  method="POST">
      @csrf
        @method('PUT')
    <div class="row">

        <div class="col-lg-12">
            <div class="custom-bg-white">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="form-title">{{__('admin.label.edit')}} {{__('admin.label.role')}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="name">{{__('admin.label.name')}} <span class="error">*</span></label>
                            <input type="text" name="name" id="name" value="{{$role->name}}" class="form-control" placeholder="Enter Role Name">
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="status">{{__('admin.label.status')}} <span class="error">*</span></label>
                            <select name="status" class="form-control select2" id="role_status">
                                @foreach($statusArr as $key=>$value)
                                    <option value="{{$key}}" @if ($role->status == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="panel-body">
                        <label for="permission">Permissions</label><br/>
                        <a href="#" class="permission-select-all">Select All</a> |
                        <a href="#" class="permission-deselect-all">Deselect All</a>
                        <div class="form-group mb2">
                            <ul class="checkbox permissions">

                                    @forelse($modules as $key=>$value)
                                    <li>
                                            <input class="form-check-input permission-group" type="checkbox" id="{{$value->name}}">
                                            <label class="form-check-label" for="{{$value->name}}">
                                                {{$value->name}}
                                            </label>

                                        <ul>
                                        @foreach($value->permissions as $permission)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input the-permission"
                                                       name="permissions[{{$permission->id}}]"
                                                       type="checkbox" value="{{$permission->id}}"
                                                       id="permission-{{$permission->id}}"
                                                       @if(in_array($permission->id,$permissions)) checked="checked" @endif>
                                                <label class="form-check-label" for="{{$permission->id}}">
                                                    {{$permission->name}}
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                        </ul>
                                    </li>
                                    @empty
                                            <!-- Write else part -->
                                    @endforelse

                            </ul>
                        </div>
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

  .permissions ul, ul>li {
      list-style-type: none;
  }

</style>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#role-edit").validate({
            rules: {
                name: "required",
            },
            messages:{
                name: "The name field is required.",
            }
        });
    });
</script>
<script>
    $('document').ready(function () {

        //$('.toggleswitch').bootstrapToggle('toggle');

        $('.permission-group').on('click', function(){
            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        });

        $('.permission-select-all').on('click', function(){
            $('ul.permissions').find("input[type='checkbox']").prop('checked', true);
            return false;
        });

        $('.permission-deselect-all').on('click', function(){
            $('ul.permissions').find("input[type='checkbox']").prop('checked', false);
            return false;
        });

        function parentChecked(){
            $('.permission-group').each(function(){
                var allChecked = true;
                $(this).siblings('ul').find("input[type='checkbox']").each(function(){
                    if(!this.checked) allChecked = false;
                });
                $(this).prop('checked', allChecked);
            });
        }

        parentChecked();

        $('.the-permission').on('change', function(){
            parentChecked();
        });
    });
</script>

@endpush
