@php
    $cartItems = cart_items();
    $cartSubtotal = cart_subtotal();
@endphp

@if (config('layout.extras.cart.dropdown.style') == 'light')
    {{-- Header --}}
    <div class="d-flex align-items-center p-10 rounded-top bg-light">
        <span class="btn btn-md btn-icon bg-light-success mr-4">
            <i class="flaticon2-shopping-cart-1 text-success"></i>
        </span>
        <h4 class="flex-grow-1 m-0 mr-3">My Cart</h4>
        <button type="button" class="btn btn-success btn-sm">{{$cartItems->count()}} Items</button>
    </div>
@else
    {{-- Header --}}
    <div class="d-flex align-items-center py-10 px-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
        <span class="btn btn-md btn-icon bg-white-o-15 mr-4">
            <i class="flaticon2-shopping-cart-1 text-success"></i>
        </span>
        <h4 class="text-white m-0 flex-grow-1 mr-3">My Cart</h4>
        <a href="{{route('user.cart.index')}}" class="btn btn-success btn-sm">{{$cartItems->count()}} Items</a>
    </div>
@endif

{{-- Scroll --}}
<div class="scroll scroll-push" data-scroll="true" data-height="250" data-mobile-height="200">
    @foreach($cartItems as $item)
    {{-- Item --}}
    <div class="d-flex align-items-center justify-content-between p-8">
        <div class="d-flex flex-column mr-2">
            <a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">
                {{$item->product->name}}
            </a>
            <div class="d-flex align-items-center mt-2">
                <span class="font-weight-bold mr-1 text-dark-75 font-size-lg text-total-price" data-product-id="{{$item->product_id}}">Rp{{number_format($item->product->price * $item->total_order)}}</span>
                <span class="text-muted mr-1">for</span>
                <span class="font-weight-bold mr-2 text-dark-75 font-size-lg text-total-order" data-product-id="{{$item->product_id}}">{{$item->total_order}}</span>
            </div>
        </div>
        <a href="{{route('user.products.show', $item->product->slug)}}" class="symbol symbol-70 flex-shrink-0">
            <img src="{{ asset(Storage::url($item->product->photo)) }}" title="{{$item->product->name}}" alt="{{$item->product->name}}"/>
        </a>
    </div>

    {{-- Separator --}}
    <div class="separator separator-solid"></div>
    @endforeach
</div>

{{-- Summary --}}
<div class="p-8">
    <div class="d-flex align-items-center justify-content-between mb-7">
        <span class="font-weight-bold text-muted font-size-sm mr-2">Sub total</span>
        <span class="font-weight-bolder text-primary text-right text-subtotal">Rp{{number_format($cartSubtotal)}}</span>
    </div>
    <div class="text-right">
        @if($cartItems->count() > 0)
        <a href="{{route('user.checkout.index')}}" class="btn btn-success text-weight-bold">Proceed to Checkout</a>
        @else
        <a href="{{route('user.dashboard')}}" class="btn btn-primary text-weight-bold">Continue Shopping</a>
        @endif
    </div>
</div>
