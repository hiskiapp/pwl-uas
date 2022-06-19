{{-- Extends layout --}}
@extends('layout.default')

{{-- Title --}}
@section('title', 'User List')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-supermarket text-primary"></i>
            </span>
            <h3 class="card-label">User List</h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    {{ Metronic::getSvg('media/svg/icons/Design/Flatten.svg') }}
                </span>New User</a>
            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">
        @if(session('message'))
        <div class="alert alert-custom alert-notice alert-light-{{ session('status') }} fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-interface-10"></i></div>
            <div class="alert-text">{{ session('message') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>
        @endif
        <!--begin: Datatable-->
        <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
            style="margin-top: 13px !important">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>

@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/admin/users/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
