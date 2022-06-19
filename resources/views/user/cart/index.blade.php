{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'My Cart')

{{-- Content --}}
@section('content')
    <div class="d-flex flex-row">
        <!--begin::Layout-->
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Section-->
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder font-size-h3 text-dark">My Cart</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                            <a href="{{route('user.dashboard')}}" class="btn btn-primary font-weight-bolder font-size-sm">Continue Shopping</a>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
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
                    <!--begin::Shopping Cart-->
                    <div class="table-responsive">
                        <table class="table">
                            <!--begin::Cart Header-->
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <!--end::Cart Header-->
                            <tbody>
                            <!--begin::Cart Content-->
                            @foreach($cartItems as $item)
                            <tr>
                                <td class="d-flex align-items-center font-weight-bolder">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                        <div class="symbol-label" style="background-image: url('{{ asset(Storage::url($item->product->photo)) }}')"></div>
                                    </div>
                                    <!--end::Symbol-->
                                    <a href="#" class="text-dark text-hover-primary">{{$item->product->name}}</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="javascript:;" class="btn btn-xs btn-light-success btn-icon btn-minus mr-2" data-product-id="{{$item->product_id}}">
                                        <i class="ki ki-minus icon-xs"></i>
                                    </a>
                                    <span class="mr-2 font-weight-bolder text-total-order" data-product-id="{{$item->product_id}}">{{$item->total_order}}</span>
                                    <a href="javascript:;" class="btn btn-xs btn-light-success btn-icon btn-plus" data-product-id="{{$item->product_id}}" data-stock="{{$item->product->stock}}">
                                        <i class="ki ki-plus icon-xs"></i>
                                    </a>
                                </td>
                                <td class="text-right align-middle font-weight-bolder font-size-h5 text-total-price" data-product-id="{{$item->product_id}}">Rp{{number_format($item->product->price * $item->total_order)}}</td>
                                <td class="text-right align-middle">
                                    <form action="{{route('user.cart.destroy', $item->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                        <button type="submit" class="btn btn-danger font-weight-bolder font-size-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <!--end::Cart Content-->
                            <!--begin::Cart Footer-->
                            <tr>
                                <td colspan="2"></td>
                                <td class="font-weight-bolder font-size-h4 text-right">Subtotal</td>
                                <td class="font-weight-bolder font-size-h4 text-right text-subtotal">Rp{{number_format($cartSubtotal)}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="border-0 text-muted text-right pt-0">Excludes Delivery.</td>
                            </tr>
                            @if($cartItems->count() > 0)
                            <tr>
                                <td colspan="4" class="border-0 text-right pt-10">
                                    <a href="{{route('user.checkout.index')}}" class="btn btn-success font-weight-bolder px-8">Proceed to Checkout</a>
                                </td>
                            </tr>
                            @endif
                            <!--end::Cart Footer-->
                            </tbody>
                        </table>
                    </div>
                    <!--end::Shopping Cart-->
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Layout-->
    </div>
@endsection
@section('scripts')
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/user/cart/index.js') }}" type="text/javascript"></script>
@endsection
