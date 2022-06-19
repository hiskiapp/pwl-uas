@extends('layout.default')
@section('title', 'User Details: ' . $user->name)
@section('content')
<!--begin::Profile 4-->
<div class="d-flex flex-row">
    <!--begin::Aside-->
    <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <!--begin::Body-->
            <div class="card-body pt-4">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end">
                    <div class="dropdown dropdown-inline">
                        <a href="#"
                            class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                            data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover py-5">
                                <li class="navi-item">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-gear"></i>
                                        </span>
                                        <span class="navi-text">Edit</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                </div>
                <!--end::Toolbar-->
                <!--begin::User-->
                <div class="d-flex align-items-center">
                    <div
                        class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                        <span class="symbol-label font-size-h1 font-weight-bold">{{ $user->initial }}</span>
                    </div>
                    <div>
                        <a href="#"
                            class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</a>
                        <div class="mt-2">
                            <a href="mailto:{{ $user->email }}"
                                class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Send Email</a>
                        </div>
                    </div>
                </div>
                <!--end::User-->
                <!--begin::Contact-->
                <div class="pt-8 pb-6">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Email:</span>
                        <a href="#"
                            class="text-muted text-hover-primary">{{ $user->email }}</a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Plan:</span>
                        <span class="text-muted">{{ $user->plan->name }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Registered at:</span>
                        <span class="text-muted">{{ $user->created_at->isoFormat('D MMMM Y HH:mm') }}</span>
                    </div>
                </div>
                <!--end::Contact-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
        <!--begin::Mixed Widget 14-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title font-weight-bolder">Resources</h3>
                <div class="card-toolbar">
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                {{ $resources->container() }}
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 14-->
    </div>
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Advance Table Widget 8-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Whatsapp List</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Quota: 0</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0 pb-3">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table
                        class="table table-head-custom table-head-bg table-vertical-center table-borderless">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th style="min-width: 250px" class="pl-7">
                                    <span class="text-dark-75">number</span>
                                </th>
                                <th style="min-width: 120px">name</th>
                                <th style="min-width: 130px">status</th>
                                <th style="min-width: 120px">to</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->whatsapps()->get() as $whatsapp)
                            <tr>
                                <td>{{ $whatsapp->number }}</td>
                                <td>{{ $whatsapp->name ?? '-' }}</td>
                                <td>
                                    <span
                                        class="label label-lg label-light-primary label-inline">{{ $whatsapp->stat }}</span>
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 8-->
    </div>
    <!--end::Content-->
</div>
<!--end::Profile 4-->
@endsection

@section('scripts')
{{ $resources->script() }}
@endsection
