<!-- Navbar Start -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SONGJOG – NOFEL</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="SONGJOG – NOFEL" name="keywords">
    <meta content="SONGJOG – NOFEL" name="description">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('public/logo/favicon.ico') }}">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public/frontView/lib/owlcarousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontView/lib/tempusdominus/css/tempusdominus-bootstrap-4.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/frontView/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('public/frontView/css/style.css')}}" rel="stylesheet">
</head>
<script>
    var baseUrl = "{{ url('/') }}";
</script>

<body>
<!-- Topbar Start -->
<div class="container-fluid py-2 border-bottom d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+880 1711-836679</a>
                    <span class="text-body">|</span>
                    <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>info@nofel.com</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-2" target="_blank"  href="https://www.facebook.com/profile.php?id=61555878435040">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
@include('frontDirectory.layouts.menu')
<!-- Navbar End -->

@yield('main_content')

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light mt-5 py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
{{--                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Medi Aid General Hospital,--}}
{{--                    70/C, Lake Circus Kalabaga, Dhaka, Bangladesh</p>--}}
                <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@bsosbd.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+880 1711-836679</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="{{ url('/') }}"><i class="fa fa-angle-right me-2"></i>Home</a>
                    <a class="text-light mb-2" href="{{ url('/about') }}"><i class="fa fa-angle-right me-2"></i>About Us</a>

                    <a class="text-light mb-2" href="{{ url('/registration') }}"><i class="fa fa-angle-right me-2"></i>Registration</a>
                    <a class="text-light" href="{{ url('/contact') }}"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                </div>
            </div>
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>--}}
{{--                <div class="d-flex flex-column justify-content-start">--}}
{{--                    <!--                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>-->--}}
{{--                    <!--                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About Us</a>-->--}}
{{--                    <!--                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Our Services</a>-->--}}
{{--                    <!--                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>-->--}}
{{--                    <!--                    <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>-->--}}
{{--                    <!--                    <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>-->--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg-4 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Follow Us</h4>
{{--                <form action="">--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">--}}
{{--                        <button class="btn btn-primary">Sign Up</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>--}}
                <div class="d-flex">
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" target="_blank" href="https://www.facebook.com/profile.php?id=61555878435040"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-light border-top border-secondary py-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-md-0">&copy; <a class="text-primary" href="https://shohozit.com">shohozit</a>. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Designed by <a class="text-primary"  target="_blank" href="https://shohozit.com">shohozit.com</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/frontView/lib/easing/easing.js')}}"></script>
<script src="{{ asset('public/frontView/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{ asset('public/frontView/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{ asset('public/frontView/lib/tempusdominus/js/moment.min.js')}}"></script>
<script src="{{ asset('public/frontView/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
<script src="{{ asset('public/frontView/lib/tempusdominus/js/tempusdominus-bootstrap-4.js')}}"></script>

<!-- Template Javascript -->
<script src="{{ asset('public/frontView/js/main.js')}}"></script>
<script src="{{ asset('public/frontView/custom/js/home.js?'.rand(10,100))}}"></script>

</body>

</html>
<!-- Footer End -->

