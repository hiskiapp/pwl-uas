@php
$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
{{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
    {{-- Header --}}
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            User Profile
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>

    {{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
        {{-- Header --}}
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <span class="symbol-label font-size-h1 font-weight-bold">{{ auth()->user()->initial }}</span>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    {{ auth()->user()->name }}
                </a>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
                                {{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
                            </span>
                            <span class="navi-text text-muted text-hover-primary">{{ auth()->user()->email }}</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Separator --}}
        <div class="separator separator-dashed mt-8 mb-5"></div>

        {{-- Nav --}}
        <div class="navi navi-spacer-x-0 p-0">
            {{-- Item --}}
            <a href="{{ auth('admin')->check() ? route('admin.admins.edit', auth()->user()->id) : route('user.profile.index') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            {{ Metronic::getSVG("media/svg/icons/General/Notification2.svg", "svg-icon-md svg-icon-success") }}
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            My Profile
                        </div>
                        <div class="text-muted">
                            Account settings and more
                            <span class="label label-light-danger label-inline font-weight-bold">update</span>
                        </div>
                    </div>
                </div>
            </a>

            @if(auth('web')->check())
            {{-- Item --}}
            <a href="{{ route('user.profile.password') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            {{ Metronic::getSVG("media/svg/icons/General/Lock.svg", "svg-icon-md svg-icon-warning") }}
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            Change Password
                        </div>
                        <div class="text-muted">
                            Change your account password
                        </div>
                    </div>
                </div>
            </a>
            @endif

            {{-- Item --}}
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            {{ Metronic::getSVG("media/svg/icons/Files/Selected-file.svg", "svg-icon-md svg-icon-danger") }}
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            Logout
                        </div>
                        <div class="text-muted">
                            Thank you..
                        </div>
                    </div>
                </div>
            </a>

            <form id="logout-form" action="{{ auth('admin')->check() ? route('admin.logout') : route('logout') }}" method="POST" style="display: none;">
                @csrf

            </form>
        </div>
    </div>
</div>
