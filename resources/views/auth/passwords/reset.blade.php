@extends('layout.blank')

@section('title', 'Forgot Password')

@section('content')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside Header-->
                <a href="#" class="login-logo text-center pt-lg-25 pb-10">
                    <img src="{{ asset('media/logos/logo-1.png') }}" class="max-h-70px" alt="" />
                </a>
                <!--end::Aside Header-->
                <!--begin::Aside Title-->
                <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">Whatsapp API Gateway
                    <br /> Terbaik &amp; Terpercaya</h3>
                <!--end::Aside Title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center"
                style="background-position-y: calc(100% + 5rem); background-image: url({{ asset('media/svg/illustrations/login-visual-5.svg') }})">
            </div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-column-fluid d-flex flex-column p-10">
            <!--begin::Top-->
            <div class="text-right d-flex justify-content-center">
                <div class="top-forgot text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                    <span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
                    <a href="javascript:;" class="font-weight-bold text-primary font-size-h4 ml-2"
                        id="kt_login_signup">Get Help</a>
                </div>
            </div>
            <!--end::Top-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center">
                <!--begin::Forgot-->
                <div class="login-form">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('password.update') }}" class="form" id="kt_reset_form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <!--begin::Title-->
                        <div class="pb-5 pb-lg-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Reset Password
                            </h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your email & new password.
                            </p>
                        </div>
                        <!--end::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Your Email</label>
                            <input
                                class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('email') is-invalid @enderror"
                                type="email" name="email" value="{{ old('email', $email) }}" placeholder="Your Email"
                                autocomplete="off" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark pt-5">New Password</label>
                            <input
                                class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('password') is-invalid @enderror"
                                type="password" name="password" placeholder="New assword" autocomplete="off" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password Confirmation</label>
                            <input
                                class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('password_confirmation') is-invalid @enderror"
                                type="password" name="password_confirmation" placeholder="Password Confirmation"
                                autocomplete="off" />
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap">
                            <button type="submit" id="kt_reset_form_submit_button"
                                class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Forgot-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
@endsection

@section('styles')
<link href="{{ asset('css/pages/login/login-3.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('js/pages/user/auth.js') }}"></script>
@endsection
