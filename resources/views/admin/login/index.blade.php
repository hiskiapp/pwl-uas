@extends('layout.blank')
@section('title', 'Admin Login')
@section('content')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Content-->
        <div
            class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
            <!--begin::Wrapper-->
            <div class="login-content d-flex flex-column pt-lg-0 pt-12">
                <!--begin::Logo-->
                <a href="#" class="login-logo pb-xl-20 pb-15">
                    <img src="{{ asset('media/logos/logo-4.png') }}" class="max-h-70px" alt="" />
                </a>
                <!--end::Logo-->
                <!--begin::Signin-->
                <div class="login-form">
                    <!--begin::Form-->
                    <form class="form" id="kt_login_singin_form" action="{{ route('admin.login') }}" method="POST">
                        @csrf

                        <!--begin::Title-->
                        <div class="pb-5 pb-lg-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h3>
                        </div>
                        <!--begin::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Email Address</label>
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                type="email" name="email" placeholder="Your Email" autocomplete="off" value="{{ old('email', 'hi@hiskia.app') }}" />
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                            </div>
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                type="password" name="password" value="{{ old('password') ? '' : '123456' }}" placeholder="Your Password" autocomplete="off" />
                        </div>
                        <!--end::Form group-->
                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">
                            <button type="submit" id="kt_login_singin_form_submit_button"
                                class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign
                                In</button>
                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--begin::Content-->
        <!--begin::Aside-->
        <div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
            <div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom"
                style="background-image: url({{ asset('media/svg/illustrations/login-visual-4.svg') }});">
                <!--begin::Aside title-->
                <h3
                    class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 d-flex justify-content-lg-start font-weight-boldest display5 display1-lg text-white">
                    UAS
                    <br />Pemrograman
                    <br />Web Lanjut</h3>
                <!--end::Aside title-->
            </div>
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
@endsection

@section('styles')
<link href="{{ asset('css/pages/login/login-4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('js/pages/admin/login.js') }}"></script>
@endsection
