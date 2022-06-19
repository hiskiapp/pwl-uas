@extends('layout.default')
@section('title', 'Change Password')
@section('content')
<!--begin::Card-->
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
        </div>
        <div class="card-toolbar">
            <button type="submit" form="passwordForm" class="btn btn-success mr-2">Save Changes</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="form" id="passwordForm" method="POST" action="{{ route('user.profile.password') }}" >
        @csrf
        @method('PATCH')

        <div class="card-body">
            @if(session('message'))
            <x-alert status="{{ session('status') }}" message="{{ session('message') }}" />
            @endif
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="password" name="current_password"
                        class="form-control form-control-lg form-control-solid mb-2 @error('current_password') is-invalid @enderror"
                        value="{{ old('current_password') }}" placeholder="Current password" required />
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="password" name="new_password"
                        class="form-control form-control-lg form-control-solid mb-2 @error('new_password') is-invalid @enderror"
                        value="{{ old('new_password') }}" placeholder="New password" required />
                    @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Confirm New Password</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="password" name="new_password_confirm"
                        class="form-control form-control-lg form-control-solid mb-2 @error('new_password_confirm') is-invalid @enderror"
                        value="{{ old('new_password_confirm') }}" placeholder="Confirm New password" required />
                    @error('new_password_confirm')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
@endsection
