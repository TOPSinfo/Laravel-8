@extends('layouts.main')
@section('content')
    <!-- Start Content-->

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mt-2">
            <div class="col-8">
                <div class="page-title-box">
                    <h4 class="page-title">{{__('admin.label.cms')}} {{__('admin.label.management')}}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.label.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.label.cms')}} {{__('admin.label.management')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-4">
                @can('create-cms')
                <a href="{{route('cms.create')}}" class="btn btn-success btn-add-new float-right">
                    <i class="voyager-plus"></i> <span>{{__('admin.label.add')}} {{__('admin.label.cms')}}</span>
                </a>
                @endcan
                @can('bulkdelete-cms')
                <a class="btn btn-danger btn-add-new float-right mr-2" id="bulk_delete_btn" style="color:#FFF">
                    <i class="voyager-trash"></i>  <span> {{__('admin.button.bulk_delete')}}</span>
                </a>
                @endcan
            </div>
        </div>
        <!-- end page title -->
        @include('common.flash')
        @include('alerts.delete_model')
        @include('alerts.multideletemodel',['redirectTo' => 'delete-multiple-cms','module' => 'Cms Pages'])
        <div class="row">
            <div class="col-12">
                <div class="card-box mb-0">
                    <div class="table-responsive inbound-table">
                        <table id="dataTable" class="custom-table dataTable data-table-btn" style="width:100%">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="select_all"></th>
                                <th>{{__('admin.label.title')}}</th>
                                <th>{{__('admin.label.slug')}}</th>
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
    <link href="{{asset('assets/css/model.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <style media="screen">
        .error{
            color:red !important;
        }
    </style>
@endpush
@push('js')
    <script>
        // This will help us to display the delete message in popup
        var single="Cms Page";
        var double="Cms Pages";
    </script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>
    <script src="{{asset('assets/js/datatable-multidelete.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $('#dataTable').DataTable( {
                processing: true,
                serverSide: true,
                ajax: "{{route('cms.index')}}",
                deferRender: true,
                columns: [
                    {data: 'check', name: 'check',orderable: false,searchable:false},
                    {data: 'title', name: 'title',orderable: true,searchable:true},
                    {data: 'slug', name: 'slug',orderable: true,searchable:true},
                    {data: 'status', name: 'status',orderable: true,searchable:true},
                    {data: 'created_at', name: 'created_at',orderable: true,searchable:true},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            } );
        } );
    </script>
@endpush
