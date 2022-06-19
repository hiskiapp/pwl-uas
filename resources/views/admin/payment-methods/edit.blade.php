@extends('layout.default')

@section('title', 'Edit Payment method: ' . $paymentMethod->name)

@section('content')
    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    Edit Payment method: {{ $paymentMethod->name }} <i class="mr-2"></i>
                    <small class="">fill the form below</small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ url()->previous() }}" class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>
                    Back
                </a>
                <div class="btn-group">
                    <button type="submit" form="kt_form" class="btn btn-primary font-weight-bolder">
                        <i class="ki ki-check icon-sm"></i>
                        Submit
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="my-5">
                        <h3 class=" text-dark font-weight-bold mb-10">Payment method Info:</h3>
                        <!--begin::Form-->
                        <form class="form" id="kt_form" method="POST" action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="form-group row">
                                <label class="col-3">Icon</label>
                                <div class="col-9">
                                    <img src="{{ asset(Storage::url($paymentMethod->icon)) }}" alt="{{ $paymentMethod->name }}" class="img-thumbnail mb-3" style="width: 100px; height: 100px;">
                                    <input class="form-control form-control-solid @error('icon') is-invalid @enderror"
                                           type="file" name="icon" value="{{ old('icon', $paymentMethod->icon) }}" required
                                           autocomplete="off" />
                                    @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                                           type="text" name="name" value="{{ old('name', $paymentMethod->name) }}" required
                                           autocomplete="off" />
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">Account Number</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid @error('account_number') is-invalid @enderror"
                                           type="text" name="account_number" value="{{ old('account_number', $paymentMethod->account_number) }}" required
                                           autocomplete="off" />
                                    @error('account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">Account Owner</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid @error('account_owner') is-invalid @enderror"
                                           type="text" name="account_owner" value="{{ old('account_owner', $paymentMethod->account_owner) }}" required
                                           autocomplete="off" />
                                    @error('account_owner')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                        <div class="separator separator-dashed my-10"></div>
                        <div class="my-52">
                            <h3 class=" text-dark font-weight-bold mb-10">Other:</h3>
                            <div class="form-group row">
                                <label class="col-3">Delete payment method</label>
                                <div class="col-9">
                                    <button type="button" class="btn btn-light-danger font-weight-bold btn-sm btn-destroy"
                                            data-id="{{ $paymentMethod->id }}">Delete this
                                        payment method
                                        ?</button>
                                    <div class="form-text text-muted mt-3">Perhatian: Anda tidak bisa mengembalikannya
                                        seperti semula.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection

@section('scripts')
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/admin/payment-methods/edit.js') }}" type="text/javascript"></script>
@endsection
