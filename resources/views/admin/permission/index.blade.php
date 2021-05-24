@extends('layouts.main')
@section('content')
    <!-- Start Content-->

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mt-2">
            <div class="col-8">
                <div class="page-title-box">
                    <h4 class="page-title">{{__('admin.label.permission')}} {{__('admin.label.management')}}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.label.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.label.permission')}} {{__('admin.label.management')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-4">
                @can('create-permission')
                <a href="{{route('permission.create')}}" class="btn btn-success btn-add-new float-right">
                    <i class="voyager-plus"></i> <span>{{__('admin.label.add')}} {{__('admin.label.permission')}}</span>
                </a>
                @endcan
            </div>
        </div>
        <!-- end page title -->
        @include('common.flash')
        @include('alerts.delete_model')
        <div class="row">
            <div class="col-12">
                <div class="card-box mb-0">
                    <div class="table-responsive inbound-table">
                        <table id="listing-permission" class="custom-table dataTable data-table-btn" style="width:100%">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>{{__('admin.label.name')}}</th>
                                <th>{{__('admin.label.module')}}</th>
                                <th>{{__('admin.label.status')}}</th>
                                <th>{{__('admin.label.created_at')}}</th>
                                <th>{{__('admin.label.action')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->
@endsection
@push('css')
    <link href="{{asset('assets/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{asset('assets/css/custom-datatable.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <style media="screen">
        .error{
            color:red !important;
        }
    </style>
@endpush
@push('js')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#listing-permission').DataTable( {
                processing: true,
                serverSide: true,
                ajax: "{{route('permission.index')}}",
                deferRender: true,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'module_name', name: 'module_name'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            } );
        } );

    </script>
@endpush
