{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Checkout')

@section('styles')
    <link href="{{asset('css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css"/>
@endsection

{{-- Content --}}
@section('content')
    <div class="d-flex flex-row">
        <!--begin::Layout-->
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Section-->
            <div class="card card-custom card-transparent">
                <div class="card-header bg-white">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-delivery-package text-primary"></i>
                        </span>
                        <h3 class="card-label">Checkout</h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body p-0">
                    <!--begin: Wizard-->
                    <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="false">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav">
                            <div class="wizard-steps" data-total-steps="3">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-number">1</div>
                                        <div class="wizard-label">
                                            <div class="wizard-title">Delivery Address</div>
                                            <div class="wizard-desc">Setup Your Address</div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-number">2</div>
                                        <div class="wizard-label">
                                            <div class="wizard-title">Payment</div>
                                            <div class="wizard-desc">Payment Options</div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-number">3</div>
                                        <div class="wizard-label">
                                            <div class="wizard-title">Purchase</div>
                                            <div class="wizard-desc">Review and Submit</div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                            </div>
                        </div>
                        <!--end: Wizard Nav-->
                        <!--begin: Wizard Body-->
                        <div class="card card-custom card-shadowless rounded-top-0">
                            <div class="card-body p-0">
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
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-7">
                                        <!--begin: Wizard Form-->
                                        <form class="form mt-0 mt-lg-10 fv-plugins-bootstrap fv-plugins-framework"
                                              id="kt_form" method="POST" action="{{route('user.checkout.store')}}">
                                            @csrf
                                            <!--begin: Wizard Step 1-->
                                            <div class="pb-5" data-wizard-type="step-content"
                                                 data-wizard-state="current">
                                                <h4 class="mb-10 font-weight-bold text-dark">Enter Your Address</h4>
                                                <!--begin::Input-->
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Address Line 1</label>
                                                    <input type="text"
                                                           class="form-control form-control-solid form-control-lg"
                                                           name="address1" placeholder="Address Line 1"
                                                           value="{{old('address1', optional($transactionExisting)->address1)}}">
                                                    <span class="form-text text-muted">Please enter your Address.</span>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Address Line 2</label>
                                                    <input type="text"
                                                           class="form-control form-control-solid form-control-lg"
                                                           name="address2" placeholder="Address Line 2"
                                                           value="{{old('address2', optional($transactionExisting)->address2)}}">
                                                    <span class="form-text text-muted">Please enter your Address.</span>
                                                </div>
                                                <!--end::Input-->
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Postcode</label>
                                                            <input type="text"
                                                                   class="form-control form-control-solid form-control-lg"
                                                                   name="postcode" placeholder="Postcode" value="{{old('postcode', optional($transactionExisting)->postcode)}}">
                                                            <span class="form-text text-muted">Please enter your Postcode.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>City</label>
                                                            <input type="text"
                                                                   class="form-control form-control-solid form-control-lg"
                                                                   name="city" placeholder="City" value="{{old('city', optional($transactionExisting)->city)}}">
                                                            <span
                                                                class="form-text text-muted">Please enter your City.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>State</label>
                                                            <input type="text"
                                                                   class="form-control form-control-solid form-control-lg"
                                                                   name="state" placeholder="State" value="{{old('state', optional($transactionExisting)->state)}}">
                                                            <span
                                                                class="form-text text-muted">Please enter your State.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <!--begin::Select-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Country</label>
                                                            <select name="country"
                                                                    class="form-control form-control-solid form-control-lg">
                                                                <option value="">Select</option>
                                                                <option value="ID" @if(old('country', optional($transactionExisting)->country) == 'ID') selected @endif>Indonesia</option>
                                                                <option value="SG" @if(old('country', optional($transactionExisting)->country) == 'SG') selected @endif>Singapore</option>
                                                            </select>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Select-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end: Wizard Step 1-->
                                            <!--begin: Wizard Step 2-->
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <h4 class="mb-10 font-weight-bold text-dark">Select Payment Method</h4>
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <!--begin::Select-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Payment Method</label>
                                                            <select name="payment_method_id"
                                                                    class="form-control form-control-solid form-control-lg">
                                                                <option value="">Select</option>
                                                                @foreach($paymentMethods as $paymentMethod)
                                                                    <option value="{{$paymentMethod->id}}" @if(old('payment_method_id', optional($transactionExisting)->payment_method_id) == $paymentMethod->id) selected @endif>{{$paymentMethod->name}} ({{$paymentMethod->account_number}} a/n {{$paymentMethod->account_owner}})</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Select-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end: Wizard Step 2-->
                                            <!--begin: Wizard Step 3-->
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <!--begin::Section-->
                                                <h4 class="mb-10 font-weight-bold text-dark">Review your Order and
                                                    Submit</h4>
                                                <div class="separator separator-dashed my-5"></div>
                                                <!--end::Section-->
                                                <!--begin::Section-->
                                                <h6 class="font-weight-bolder mb-3">Order Details:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th class="pl-0 font-weight-bold text-muted text-uppercase">
                                                                    Ordered Items
                                                                </th>
                                                                <th class="text-right font-weight-bold text-muted text-uppercase">
                                                                    Qty
                                                                </th>
                                                                <th class="text-right font-weight-bold text-muted text-uppercase">
                                                                    Unit Price
                                                                </th>
                                                                <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">
                                                                    Amount
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($cartItems as $cartItem)
                                                            <tr class="font-weight-boldest">
                                                                <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                                    <!--begin::Symbol-->
                                                                    <div
                                                                        class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                                        <div class="symbol-label"
                                                                             style="background-image: url('{{ asset(Storage::url($cartItem->product->photo)) }}')"></div>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    {{$cartItem->product->name}}
                                                                </td>
                                                                <td class="text-right pt-7 align-middle">{{$cartItem->total_order}}</td>
                                                                <td class="text-right pt-7 align-middle">Rp{{number_format($cartItem->product->price)}}</td>
                                                                <td class="text-primary pr-0 pt-7 text-right align-middle">
                                                                    Rp{{number_format($cartItem->total_order * $cartItem->product->price)}}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="2" class="border-0 pt-0"></td>
                                                                <td class="border-0 pt-0 font-weight-bolder font-size-h5 text-right">
                                                                    Grand Total
                                                                </td>
                                                                <td class="border-0 pt-0 font-weight-bolder font-size-h5 text-success text-right pr-0">
                                                                    Rp{{number_format($cartSubtotal)}}
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="separator separator-dashed my-5"></div>
                                                <!--end::Section-->
                                                <!--begin::Section-->
                                                <h6 class="font-weight-bolder mb-3">Delivery Service Type:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div>Overnight Delivery with Regular Packaging</div>
                                                    <div>Preferred Morning (8:00AM - 11:00AM) Delivery</div>
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end: Wizard Step 3-->
                                            <!--begin: Wizard Actions-->
                                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                                <div class="mr-2">
                                                    <button type="button"
                                                            class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4"
                                                            data-wizard-type="action-prev">Previous
                                                    </button>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                            class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                                            data-wizard-type="action-submit">Submit
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"
                                                            data-wizard-type="action-next">Next
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end: Wizard Actions-->
                                            <div></div>
                                            <div></div>
                                        </form>
                                        <!--end: Wizard Form-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Wizard Bpdy-->
                    </div>
                    <!--end: Wizard-->
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Layout-->
    </div>
@endsection
@section('scripts')
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/user/checkout/index.js') }}" type="text/javascript"></script>
@endsection
