@extends('layout.default')
@section('title', 'Profile')
@section('content')
<!--begin::Card-->
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">Profile</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account data</span>
        </div>
        <div class="card-toolbar">
            <button type="submit" form="passwordForm" class="btn btn-success mr-2">Save Changes</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="form" id="passwordForm" method="POST" action="{{ route('user.profile.update') }}" >
        @csrf
        @method('PATCH')

        <div class="card-body">
            @if(session('message'))
            <x-alert status="{{ session('status') }}" message="{{ session('message') }}" />
            @endif
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Your Name</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="text" name="name"
                        class="form-control form-control-lg form-control-solid mb-2 @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" placeholder="Your Name" required />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Your Email</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="email" name="email"
                        class="form-control form-control-lg form-control-solid mb-2 @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" placeholder="Your Email" required />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
@endsection
