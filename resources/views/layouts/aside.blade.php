@php
    $path = explode('/', Request::path());
    $role = auth()->user()->role;

    $dashboardRoutes = [
        'admin' => 'admin.dashboard-admin',
    ];

    $isActive = in_array($role, array_keys($dashboardRoutes)) && $path[1] === 'dashboard-' . $role;
    $activeColor = $isActive ? 'color: #F4BE2A' : 'color: #FFFFFF';
@endphp
{{-- @dd($isActive) --}}
{{-- @dd($path) --}}
<div class="aside-menu bg-primary flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y mb-5 mb-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column mt-2 menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="kt_aside_menu" data-kt-menu="true" style="gap: 3px;">

            <div class="menu-item">
                <a class="menu-link {{ $isActive ? 'active' : '' }}" href="{{ route($dashboardRoutes[$role]) }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $isActive ? url('admin/assets/media/icons/aside/dashboardact.svg') : url('admin/assets/media/icons/aside/dashboarddef.svg') }}"
                                alt="">
                        </span>
                    </span>
                    <span class="menu-title" style="{{ $activeColor }}">Dashboard</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link  {{ $path[1] === 'mahasiswa' ? 'active' : '' }}"
                    href="{{ route('admin.mahasiswa') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[1] === 'mahasiswa' ? url('admin/assets/media/icons/aside/mahasiswaact.svg') : url('/admin/assets/media/icons/aside/mahasiswadef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[1] === 'mahasiswa' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Mahasiswa</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link  {{ $path[1] === 'kritealternatif' ? 'active' : '' }}"
                    href="{{ route('admin.kriteria') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[1] === 'kriteria' ? url('admin/assets/media/icons/aside/kriteriaact.svg') : url('/admin/assets/media/icons/aside/kriteriadef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[1] === 'kriteria' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Kriteria</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link  {{ $path[1] === 'alternatif' ? 'active' : '' }}"
                    href="{{ route('admin.alternatif') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[1] === 'alternatif' ? url('admin/assets/media/icons/aside/altrenatifact.svg') : url('/admin/assets/media/icons/aside/alternatifdef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[1] === 'alternatif' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Alternatif</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link  {{ $path[1] === 'perangkingan' ? 'active' : '' }}"
                    href="{{ route('admin.perangkingan') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[1] === 'perangkingan' ? url('admin/assets/media/icons/aside/perangkinganact.svg') : url('/admin/assets/media/icons/aside/perangkingandef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[1] === 'perangkingan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Perangkingan</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link  {{ $path[1] === 'perusahaan' ? 'active' : '' }}"
                    href="{{ route('admin.perusahaan') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[1] === 'perusahaan' ? url('admin/assets/media/icons/aside/perusahaanact.svg') : url('/admin/assets/media/icons/aside/perusahaandef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[1] === 'perusahaan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Perusahaan</span>
                </a>
            </div>

        </div>
        <!--end::Menu-->
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            // $(".menu-link").hover(function(){
            //     $(this).css("background", "#282EAD");
            // }, function(){
            //     $(this).css("background", "none");
            // });
        });
    </script>
@endsection
