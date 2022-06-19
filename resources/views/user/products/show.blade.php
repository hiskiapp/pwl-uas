{{-- Extends layout --}}
@extends('layout.default')

@section('title', $product->name)

{{-- Content --}}
@section('content')
    <div class="d-flex flex-row">
        <!--begin::Layout-->
        <div class="flex-row-fluid">
            <!--begin::Section-->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xxl-12">
                    <!--begin::Engage Widget 14-->
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body p-15 pb-20">
                            <div class="row mb-17">
                                <div class="col-xxl-5 mb-11 mb-xxl-0">
                                    <!--begin::Image-->
                                    <div class="card card-custom card-stretch">
                                        <div
                                            class="card-body p-0 rounded px-10 py-15 d-flex align-items-center justify-content-center"
                                            style="background-color: #FFCC69;">
                                            <img src="{{ asset(Storage::url($product->photo)) }}" class="mw-100 w-200px"
                                                 style="transform: scale(1.6);">
                                        </div>
                                    </div>
                                    <!--end::Image-->
                                </div>
                                <div class="col-xxl-7 pl-xxl-11">
                                    <h2 class="font-weight-bolder text-dark mb-7"
                                        style="font-size: 32px;">{{$product->name}}</h2>
                                    <div class="font-size-h2 mb-7 text-dark-50">From
                                        <span
                                            class="text-info font-weight-boldest ml-2">Rp{{number_format($product->price)}}</span>
                                    </div>
                                    <div class="line-height-xl">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <!--begin::Info-->
                                <div class="col-6 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <span class="text-dark font-weight-bold mb-4">Category</span>
                                        <span
                                            class="text-muted font-weight-bolder font-size-lg">{{$product->category->name}}</span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <span class="text-dark font-weight-bold mb-4">Price</span>
                                        <span
                                            class="text-muted font-weight-bolder font-size-lg">Rp{{number_format($product->price)}}</span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="mb-8 d-flex flex-column">
                                        <span class="text-dark font-weight-bold mb-4">Stock</span>
                                        <span
                                            class="text-muted font-weight-bolder font-size-lg">{{number_format($product->stock)}}</span>
                                    </div>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--begin::Buttons-->
                            <form action="{{route('user.cart.store')}}" method="POST" class="d-inline">
                                @csrf

                                <div class="d-flex">
                                    <div class="font-weight-bolder pr-8 font-size-sm">
                                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}"/>
                                        <input id="touchpin_total_order" type="text" class="form-control" value="1" name="total_order"
                                               placeholder="input total order"/>
                                        <input type="hidden" name="stock" id="stock" value="{{$product->stock}}"/>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-light-primary font-weight-bolder px-8 font-size-sm">
															<span class="svg-icon"><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z"
                                                fill="#000000" opacity="0.3"/>
                                            <path
                                                d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>Add to Cart
                                    </button>
                                </div>
                            </form>
                            <!--end::Buttons-->
                        </div>
                    </div>
                    <!--end::Engage Widget 14-->
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Layout-->
    </div>
@endsection
@section('scripts')
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/user/products/show.js') }}" type="text/javascript"></script>
@endsection
