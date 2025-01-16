
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BSOSBD">
    <meta name="author" content="BSOSBD">
    <meta name="keywords" content="BSOSBD">

    {{--    <link rel="preconnect" href="https://fonts.gstatic.com">--}}
    <link rel="shortcut icon" href="{{ asset('public/logo/favicon.ico') }}" />

    {{--    <link rel="canonical" href="https://demo-basic.adminkit.io/" />--}}

    <title>BSOS BD</title>
    <link href="{{ asset('public/adminView/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="index.html">
                <span class="align-middle">BSOS BD</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Pages
                </li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ url('/dashboard') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/workshopApplicant') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Applicant Record</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/facultyMember') }}">
                        <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Faculty Member</span>
                    </a>
                </li>

            </ul>

        </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                             <span class="text-dark">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ url('/profile') }}"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                 <span class="dropdown-item">   {{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content">
            <div class="container-fluid p-0">
                @yield('main_content')
            </div>
        </main>
        @include('admin.layouts.footer')

