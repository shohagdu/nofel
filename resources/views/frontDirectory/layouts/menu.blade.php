<?php
    $fullUrl        = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
        . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $lastSegment    = isset($fullUrl)? basename(parse_url($fullUrl, PHP_URL_PATH)):'';
?>
<div class="container-fluid sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ url('/public/logo/logo.jpeg') }}" style="height: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ (isset($fullUrl) && $lastSegment=='')?"active":'' }} ">Home</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link">About </a>

                    <a href="{{ url('/registration') }}" class="nav-item nav-link {{ (isset($fullUrl) && $lastSegment=='registration')?"active":'' }}">Registration</a>
                    <a href="{{ url('/contact') }}" class="nav-item nav-link {{ (isset($fullUrl) && $lastSegment=='contact')?"active":'' }}">Contact</a>

                </div>
            </div>
        </nav>
    </div>
</div>
