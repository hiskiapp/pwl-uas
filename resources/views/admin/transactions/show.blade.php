@extends('layout.default')

@section('title', "Transaction Details: $transaction->code")

@section('content')
    <div class="d-flex flex-row">
        <!--begin::Layout-->
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">Transaction Details:
                                    {{$transaction->code}}</h1>
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <!--begin::Logo-->
                                    <a href="#" class="mb-5">
                                        <img src="{{asset('media/logos/logo-dark.png')}}" alt="">
                                    </a>
                                    <!--end::Logo-->
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">TRANSACTION DATE</span>
                                    <span class="opacity-70">{{$transaction->created_at->format('d M Y H:i')}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">TRANSACTION CODE.</span>
                                    <span class="opacity-70">{{$transaction->code}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">DELIVERED TO.</span>
                                    <span class="opacity-70">{{$transaction->address1}}
																<br>{{$transaction->city}}, {{$transaction->state}}, {{$transaction->country}} {{$transaction->postcode}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transaction->transactionItems as $item)
                                    <tr class="font-weight-boldest border-bottom-0">
                                        <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                <div class="symbol-label" style="background-image: url('{{ asset(Storage::url($item->product->photo)) }}')"></div>
                                            </div>
                                            <!--end::Symbol-->
                                            {{$item->product->name}}</td>
                                        <td class="border-top-0 text-right py-4 align-middle">{{number_format($item->quantity)}}</td>
                                        <td class="border-top-0 text-right py-4 align-middle">Rp{{number_format($item->product->price)}}</td>
                                        <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle">Rp{{number_format($item->total_price)}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">PAYMENT TYPE</th>
                                        <th class="font-weight-bold text-muted text-uppercase">STATUS</th>
                                        <th class="font-weight-bold text-muted text-uppercase">UPDATED DATE</th>
                                        <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{$transaction->paymentMethod->name}}<br>{{$transaction->paymentMethod->account_number}} <br> a/n {{$transaction->paymentMethod->account_owner}}</td>
                                        <td>{{$transaction->status}}</td>
                                        <td>{{$transaction->updated_at->format('d M Y H:i')}}</td>
                                        <td class="text-primary font-size-h3 font-weight-boldest text-right">Rp{{number_format($transaction->total_price)}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Order Details</button>
                                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Layout-->
    </div>
@endsection
