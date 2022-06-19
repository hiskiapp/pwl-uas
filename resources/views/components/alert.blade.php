<!--begin::Alert-->
<div class="alert alert-custom alert-light-{{ $status }} fade show mb-10" role="alert">
    <div class="alert-icon">
        <span class="svg-icon svg-icon-3x svg-icon-{{ $status }}">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
            {{ Metronic::getSvg('media/svg/icons/Code/Info-circle.svg') }}
            <!--end::Svg Icon-->
        </span>
    </div>
    <div class="alert-text font-weight-bold">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
        </button>
    </div>
</div>
<!--end::Alert-->
