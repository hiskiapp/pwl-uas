@extends('layout.default')
@section('title', 'Transaction List')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-delivery-package text-primary"></i>
            </span>
                <h3 class="card-label">Transaction List</h3>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body mt-0">
            <!--begin: Search Form-->
            <form class="mb-5">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Code:</label>
                        <input type="text" class="form-control datatable-input" placeholder="INV00001" data-col-index="0" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>User:</label>
                        <input type="text" class="form-control datatable-input" placeholder="E.g: Hiskia"
                               data-col-index="1" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Payment:</label>
                        <select class="form-control datatable-input" data-col-index="4">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Status:</label>
                        <select class="form-control datatable-input" data-col-index="5">
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-8 align-items-end">
                    <div class="col-lg-6">
                        <button class="btn btn-primary btn-primary--icon" id="kt_search">
                        <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                        </span>
                        </button>&#160;&#160;
                        <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                        <span>
                            <i class="la la-close"></i>
                            <span>Reset</span>
                        </span>
                        </button></div>
                </div>
            </form>
            <!--begin: Datatable-->
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>User</th>
                    <th>Total Price</th>
                    <th>Total Item</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Code</th>
                    <th>User</th>
                    <th>Total Price</th>
                    <th>Total Item</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/admin/transactions/index.js') }}"></script>
@endsection
