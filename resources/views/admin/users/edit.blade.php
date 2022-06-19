@extends('layout.default')

@section('title', 'Edit User: ' . $user->name)

@section('content')
<div class="card card-custom card-sticky" id="kt_page_sticky_card">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                Edit User: {{ $user->name }} <i class="mr-2"></i>
                <small class="">fill the form below</small>
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ url()->previous() }}" class="btn btn-light-primary font-weight-bolder mr-2">
                <i class="ki ki-long-arrow-back icon-sm"></i>
                Back
            </a>
            <div class="btn-group">
                <button type="submit" form="kt_form" class="btn btn-primary font-weight-bolder">
                    <i class="ki ki-check icon-sm"></i>
                    Submit
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="my-5">
                    <h3 class=" text-dark font-weight-bold mb-10">User Info:</h3>
                    <!--begin::Form-->
                    <form class="form" id="kt_form" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label class="col-3">Name</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                                    type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    autocomplete="off" />
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Email</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('email') is-invalid @enderror"
                                    type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    autocomplete="off" />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Password</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid @error('password') is-invalid @enderror"
                                    type="password" name="password" min="6" />
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="form-text text-muted">Panjang password minimal 6</span>
                            </div>
                        </div>
                    </form>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="my-52">
                        <h3 class=" text-dark font-weight-bold mb-10">Other:</h3>
                        <div class="form-group row">
                            <label class="col-3">Nonaktifkan akun</label>
                            <div class="col-9">
                                <button type="button" class="btn btn-light-danger font-weight-bold btn-sm btn-destroy"
                                    data-id="{{ $user->id }}">Delete this
                                    account
                                    ?</button>
                                <div class="form-text text-muted mt-3">Perhatian: Anda tidak bisa mengembalikannya
                                    seperti semula.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2"></div>
            </div>
        </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@section('scripts')
{{-- page scripts --}}
<script src="{{ asset('js/pages/admin/users/edit.js') }}" type="text/javascript"></script>
@endsection
