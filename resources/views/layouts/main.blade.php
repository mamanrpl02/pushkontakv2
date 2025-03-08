<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Codescandy" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-M8S4MT3EYG');
    </script>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashuipro/assets/images/favicon/favicon.ico') }}" />

    <!-- Color modes -->
    <script src="{{ asset('dashuipro/assets/js/vendors/color-modes.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Libs CSS -->
    <link href="{{ asset('dashuipro/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashuipro/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashuipro/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('dashuipro/assets/css/theme.min.css') }}">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>Push Kontak by Manz</title>
</head>

<body>
    <main id="main-wrapper" class="main-wrapper">
        <div class="header">
            <!-- navbar -->
            <div class="navbar-custom navbar navbar-expand-lg">
                <div class="container-fluid px-0">
                    <a class="navbar-brand d-block d-md-none" href="index.html">
                        <h4>Manzz Web</h4>
                        {{-- <img src="{{ asset('dashuipro/assets/images/brand/logo/logo-2.svg') }}" alt="Image" /> --}}
                    </a>



                    <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
                            <path
                                d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </a>

                    <div class="d-none d-md-none d-lg-block">
                        <!-- Form -->
                        <form action="#">
                            <div class="input-group">
                                <input class="form-control rounded-3 bg-transparent ps-9" type="search" value=""
                                    id="searchInput" placeholder="Search" />
                                <span class="">
                                    <button class="btn position-absolute start-0" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search text-dark">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!--Navbar nav -->
                    <ul
                        class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-ghost btn-icon rounded-circle" type="button"
                                    aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                                    <i class="bi theme-icon-active"></i>
                                    <span class="visually-hidden bs-theme-text">Toggle theme</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center"
                                            data-bs-theme-value="light">
                                            <i class="bi theme-icon bi-sun-fill"></i>
                                            <span class="ms-2">Light</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center"
                                            data-bs-theme-value="dark">
                                            <i class="bi theme-icon bi-moon-stars-fill"></i>
                                            <span class="ms-2">Dark</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center active"
                                            data-bs-theme-value="auto">
                                            <i class="bi theme-icon bi-circle-half"></i>
                                            <span class="ms-2">Auto</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <!-- List -->
                        <li class="dropdown ms-2">
                            <a class="rounded-circle" href="#!" role="button" id="dropdownUser"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-md avatar-indicators avatar-online">
                                    <img alt="avatar" src="storage/{{ $member->gambar }}" class="rounded-circle" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <div class="px-4 pb-0 pt-2">
                                    <div class="lh-1">
                                        <h5 class="mb-1">{{ $member->nama }}</h5>
                                    </div>
                                    <div class="dropdown-divider mt-3 mb-2"></div>
                                </div>

                                <ul class="list-unstyled">

                                    <li>
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('member.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- navbar vertical -->
        <div class="app-menu"><!-- Sidebar -->

            <div class="navbar-vertical navbar nav-dashboard">
                <div class="h-100" data-simplebar>
                    <!-- Brand logo -->
                    <a class="navbar-brand" href="index.html">
                        <h4>Manz Web</h4>
                    </a>
                    <!-- Navbar nav -->
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <!-- Nav item -->
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow " href="{{ route('device') }}">
                                <i data-feather="monitor" class="nav-icon me-2 icon-xxs"></i>
                                Devices
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow " href="{{ route('kirimPesan') }}">
                                <i class="bi bi-chat-dots nav-icon me-2 icon-xxs"></i>
                                Send Message
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow " href="{{ route('adjustNomor') }}">
                                <i class="bi bi-clipboard2-pulse nav-icon me-2 icon-xxs"></i>
                                Adjust Number
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow " href="{{ route('list.group') }}">
                                <i class="bi-list-stars nav-icon me-2 icon-xxs"></i>
                                List Group
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow " href="{{ route('upGroup.view') }}">
                                <i class="bi bi-database-up nav-icon me-2 icon-xxs"></i>
                                Update Group
                            </a>
                        </li>
                    </ul>
                    <div class="card bg-light shadow-none text-center mx-4 my-8">
                        <div class="card-body py-6">
                            <img src="{{ asset('dashuipro/assets/images/background/speaker1.png') }}"
                                alt="Manz - Jasa Push Kontak" width="150" />
                            <div class="mt-4">
                                <h5>Web Push Kontak By Manz</h5>
                                <p class="fs-6 mb-4">Solusi Push Kontak Dengan Sat Kali Klik Untuk Para Anak JB</p>
                                <a href="https://wa.me/6281223937340" class="btn btn-secondary btn-sm">Bantuan? Hubungi Manz</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <div id="app-content">
            <!-- Container fluid -->

            @yield('content')

        </div>
    </main>

    <!-- Scripts -->

    <!-- Libs JS -->

    <script src="{{ asset('dashuipro/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashuipro/assets/libs/feather-icons/dist/feather.min.js') }}"></script>
    <script src="{{ asset('dashuipro/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('dashuipro/assets/js/theme.min.js') }}"></script>

    <script src="{{ asset('dashuipro/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashuipro/assets/js/vendors/chart.js') }}"></script>


    <!-- popper js -->
    <script src="{{ asset('dashuipro/assets/libs/%40popperjs/core/dist/umd/popper.min.js') }}"></script>

    <!-- tippy js -->
    <script src="{{ asset('dashuipro/assets/libs/tippy.js/dist/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ asset('dashuipro/assets/js/vendors/tooltip.js') }}"></script>

    <!-- Listjs required js scripts -->
    <script src="{{ asset('dashuipro/assets/libs/list.js/dist/list.min.js') }}"></script>
    <script src="{{ asset('dashuipro/assets/libs/list.pagination.js/dist/list.pagination.min.js') }}"></script>
    <script src="{{ asset('dashuipro/cdn.jsdelivr.net/npm/moment%402.29.1/min/moment.min.js') }}"></script>

    <!-- CRM Contact js -->
    <script src="{{ asset('dashuipro/assets/js/vendors/crm-contact.init.js') }}"></script>
</body>

</html>
