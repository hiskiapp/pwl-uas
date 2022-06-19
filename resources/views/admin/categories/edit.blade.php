@extends('layout.default')

@section('title', 'Edit Category: ' . $category->name)

@section('content')
    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    Edit Category: {{ $category->name }} <i class="mr-2"></i>
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
                        <h3 class=" text-dark font-weight-bold mb-10">Category Info:</h3>
                        <!--begin::Form-->
                        <form class="form" id="kt_form" method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                            @method('PATCH')
                            @csrf

                            <div class="form-group row">
                                <label class="col-3">Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                                           type="text" name="name" value="{{ old('name', $category->name) }}" required
                                           autocomplete="off" />
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                        <div class="separator separator-dashed my-10"></div>
                        <div class="my-52">
                            <h3 class=" text-dark font-weight-bold mb-10">Other:</h3>
                            <div class="form-group row">
                                <label class="col-3">Delete category</label>
                                <div class="col-9">
                                    <button type="button" class="btn btn-light-danger font-weight-bold btn-sm btn-destroy"
                                            data-id="{{ $category->id }}">Delete this
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
    <script src="{{ asset('js/pages/admin/categories/edit.js') }}" type="text/javascript"></script>
@endsection
