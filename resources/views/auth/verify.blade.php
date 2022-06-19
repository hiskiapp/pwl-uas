@extends('layout.blank')

@section('title', 'Verifikasi Email')

@section('content')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Error-->
    <div class="error error-5 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ asset('media/error/bg5.jpg') }});">
        <!--begin::Content-->
        <div class="container d-flex flex-row-fluid flex-column justify-content-md-center p-12">
            <h1 class="error-title font-weight-boldest text-info mt-10 mt-md-0 mb-12">Oops!</h1>
            <p class="font-weight-boldest display-4">Email not verified</p>
            @if (session('resent'))
            <div class="alert alert-success" style="max-width: 500px;" role="alert">
                {{ __('A fresh verification link has been sent to your email address ('.auth()->user()->email.').') }}
            </div>
            @endif
            <p class="font-size-h3">
                {{ __('Before proceeding, please check your email for a verification link.') }}<br />
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf

                    <button type="submit" class="btn btn-link p-0 m-0 font-size-h3">{{ __('click here to request another') }}</button>.
                </form>
            </p>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Error-->
</div>
<!--end::Main-->
@endsection

@section('styles')
<link href="{{ asset('css/pages/error/error-5.css') }}" rel="stylesheet" type="text/css" />
@endsection
