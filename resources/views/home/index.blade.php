<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>{{ config('app.name') }} | Home</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="Si Peka (Sistem Informasi Pengetesan Kemiskinan) Adalah Wadah Perencanaan, Monitoring Pelakasanaan dan Evaluasi Kinerja Program Pengetesan Kemiskinan Terintegrasi Dengan Konsep Kolaborasi Program dan Anggaran." />
    <meta name="keywords" content="Kemiskinan, perencanaan,monitoring, evaluasi" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="/logo_title.png" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/custom/jquery-ui/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<!--begin::Body-->

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">
    <!--Begin::Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!--End::Google Tag Manager (noscript) -->

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Header Section-->
        <div class="mb-0" id="home">
            <!--begin::Wrapper-->
            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg"
                style="background-image: url(/admin/assets/media/svg/illustrations/landing.svg)">
                <!--begin::Header-->
                <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
                    data-kt-sticky-offset="{default: '200px', lg: '300px'}">

                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center justify-content-between">
                            <!--begin::Logo-->
                            <div class="d-flex align-items-center flex-equal">
                                <!--begin::Mobile menu toggle-->
                                <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                                    id="kt_landing_menu_toggle">
                                    <i class="ki-duotone ki-abstract-14 fs-2hx"><span class="path1"></span><span
                                            class="path2"></span></i> </button>
                                <!--end::Mobile menu toggle-->

                                <!--begin::Logo image-->
                                <a href="">
                                    <img alt="Logo" src="/admin/assets/media/logos/landing.svg"
                                        class="logo-default h-25px h-lg-30px" />
                                    <img alt="Logo" src="/admin/assets/media/logos/landing-dark.svg"
                                        class="logo-sticky h-20px h-lg-25px" />
                                </a>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Logo-->

                            <!--begin::Toolbar-->
                            <div class="flex-equal text-end ms-1">
                                <a href="{{ route('login.login-akun') }}" class="btn btn-success">Sign In</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->

                <!--begin::Landing hero-->
                <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                    <!--begin::Heading-->
                    <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                        <!--begin::Title-->
                        <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">
                            <span id="kt_typedjs_example_1"></span> <br />
                            Sistem

                            <span
                                style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                <span id="kt_landing_hero_text">Informasi</span>
                            </span>
                        </h1>
                        <!--end::Title-->

                        <!--begin::Action-->
                        <button type="button" class="btn btn-primary" data-kt-drawer-show="true"
                            data-kt-drawer-target="#side_form" id="button-side-form" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_1">
                            Daftar
                        </button>
                        <!--end::Action-->
                    </div>
                    <!--end::Heading-->
                </div>
                <!--end::Landing hero-->

                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Data Mahasiswa</h3>

                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                                    </svg>
                                </div>
                                <!--end::Close-->
                            </div>

                            <div class="modal-body">
                                <form class="form-data" enctype="multipart/form-data">
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="uuid">
                                    <div class="mb-10">
                                        <label class="form-label">Nama Mahasiswa</label>
                                        <input type="text" id="nama_mahasiswa" class="form-control"
                                            name="nama_mahasiswa">
                                        <small class="text-danger nama_mahasiswa_error"></small>
                                    </div>

                                    <div class="mb-10">
                                        <label class="form-label">NIM</label>
                                        <input type="text" id="nim" class="form-control" name="nim">
                                        <small class="text-danger nim_error"></small>
                                    </div>

                                    <div class="mb-10">
                                        <label class="form-label">Angkatan</label>
                                        <input type="text" id="angkatan" class="form-control" name="angkatan">
                                        <small class="text-danger angkatan_error"></small>
                                    </div>


                                    <div class="mb-10">
                                        <label class="form-label">Transkrip Nilai <small
                                                style="font-style: italic; color:#EA443E">(pdf)</small></label>
                                        <input type="file" accept=".pdf" id="file" class="form-control"
                                            name="file">
                                        <small class="text-danger file_error"></small>
                                        <!-- Contoh elemen HTML untuk menampilkan informasi file -->
                                        <div class="mt-3" id="fileInfoContainer"></div>

                                    </div>

                                    <div class="separator separator-dashed mt-8 mb-5"></div>
                                    <div class="d-flex gap-5">
                                        <button type="submit"
                                            class="btn btn-primary btn-sm btn-submit d-flex align-items-center"><i
                                                class="bi bi-file-earmark-diff"></i> Simpan</button>
                                        <button type="reset" id="side_form_close" data-bs-dismiss="modal"
                                            class="btn mr-2 btn-light btn-cancel btn-sm d-flex align-items-center"
                                            style="background-color: #ea443e65; color: #EA443E"><i
                                                class="bi bi-trash-fill" style="color: #EA443E"></i>Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Wrapper-->

            <!--begin::Curve bottom-->
            <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                        fill="currentColor"></path>
                </svg>
            </div>
            <!--end::Curve bottom-->
        </div>
        <!--end::Header Section-->

        <!--begin::Testimonials Section-->
        <div class="mt-20 mb-n20 position-relative z-index-2">
            <!--begin::Container-->
            <div class="container">
                <!--end::Row-->

                <!--begin::Highlight-->
                <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13"
                    style="background: linear-gradient(90deg, #20AA3E 0%, #03A588 100%);">
                    <!--begin::Content-->
                    <div class="my-2 me-5">
                        <!--begin::Title-->
                        <div class="fs-1 fs-lg-2qx fw-bold text-white mb-2">
                            Website Pendaftaran Lokasi PPL

                            <span class="fw-normal">Jurusan Sistem Informasi</span>
                        </div>
                        <!--end::Title-->

                        <!--begin::Description-->
                        <div class="fs-6 fs-lg-5 text-white fw-semibold opacity-75">
                            Dapatkan lokasi PPl sesuai nilai pada transkrip nilai
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Content-->

                    <!--begin::Link-->
                    <button type="button"
                        class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2"
                        data-kt-drawer-show="true" data-kt-drawer-target="#side_form" id="button-side-form"
                        data-bs-toggle="modal" data-bs-target="#kt_modal_1">Daftar Data Sekarang</button>
                    <!--end::Link-->
                </div>
                <!--end::Highlight-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Testimonials Section-->


        <!--begin::Footer Section-->
        <div class="mb-0">

            <!--begin::Wrapper-->
            <div class="landing-dark-bg pt-20">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Row-->
                    <div class="row justify-content-center py-10 py-lg-20">
                        <div style="color: white; font-size: 30px">Mitra Kerja Sama</div>
                        <!--begin::Col-->
                        @foreach ($data as $item)
                            <div class="col-lg-6 p-lg-16 mb-10 mb-lg-0">
                                <!--begin::Block-->
                                <div class="rounded landing-dark-border text-center p-9 mb-10">
                                    <!--begin::Title-->
                                    <img src="{{ asset('storage/logo/' . $item->logo) }}" alt=""
                                        style="width: 100%; border-radius: 10px; margin-bottom: 10px">
                                    <!--end::Title-->

                                    <!--begin::Text-->
                                    <span class="fw-normal fs-4 text-light">
                                        {{ $item->nama_perusahaan }}
                                    </span>
                                    <!--end::Text-->
                                </div>
                                <!--end::Block-->
                            </div>
                        @endforeach
                        <!--end::Col-->

                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->

                <!--begin::Separator-->
                <div class="landing-dark-separator"></div>
                <!--end::Separator-->

                <!--begin::Container-->
                <div class="container">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                        <!--begin::Copyright-->
                        <div class="d-flex align-items-center order-2 order-md-1">
                            <!--begin::Logo-->
                            <a href="/admin/../demo1/landing.html">
                                <img alt="Logo" src="/admin/assets/media/logos/landing.svg"
                                    class="h-15px h-md-20px" />
                            </a>
                            <!--end::Logo image-->

                            <!--begin::Logo image-->
                            <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="https://keenthemes.com">
                                &copy; Sapurata Creative.
                            </span>
                            <!--end::Logo image-->
                        </div>
                        <!--end::Copyright-->

                        <!--begin::Menu-->
                        <ul
                            class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                            <li class="menu-item">
                                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                            </li>

                            <li class="menu-item mx-5">
                                <a href="https://devs.keenthemes.com" target="_blank"
                                    class="menu-link px-2">Support</a>
                            </li>

                            <li class="menu-item">
                                <a href="" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Footer Section-->

        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Scrolltop-->
    </div>
    <!--end::Root-->
    <!--begin::Engage modals-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="bi bi-arrow-up-short"></i>
    </div>
    <!--end::Scrolltop-->
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script src="admin/assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
    <script>
        var hostUrl = "assets/";
        var typed = new Typed("#kt_typedjs_example_1", {
            strings: ["Pendaftaran Tempat PPL"],
            typeSpeed: 30
        });
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('admin/assets/plugins/custom/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.bundle.js') }}"></script><!--begin::Custom Javascript(used by this page)-->
    <!--end::Custom Javascript-->
    {{-- @if ($message = Session::get('failed'))
        <script>
            swal.fire({
                title: "Eror",
                text: "{{ $message }}",
                icon: "warning",
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
    @endif

    @if ($message = Session::get('success'))
        <script>
            swal.fire({
                title: "Sukses",
                text: "{{ $message }}",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
    @endif --}}

    <script src="{{ asset('admin/assets/js/panel.js') }}"></script>
    <script>
        let control = new Control();

        $(document).on('click', '#button-side-form', function() {
            control.overlay_form('Tambah', 'Mahasiswa');
        })

        $(document).on('submit', ".form-data", function(e) {
            e.preventDefault();
            let type = $(this).attr('data-type');
            if (type == 'add') {
                control.submitFormMultipartData('/addHome-mahasiswa', 'Tambah',
                    'Mahasiswa',
                    'POST');
            }
        });
    </script>

</body>
<!--end::Body-->

</html>
