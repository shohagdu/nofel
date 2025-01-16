@extends('frontDirectory.layouts.master')
@section('title', 'Dashboard')
@section('main_content')

    <!-- Hero Start -->
    <div class="container-fluid">
        <div class="row">
            <img src="{{ asset('public/frontView/img/slider_two.jpeg') }}" style="max-height: 700px; width: 100%;">
        </div>
    </div>

    <!-- Hero End -->


    <!-- Home page Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
{{--                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">--}}
{{--                    <div class="position-relative h-100">--}}
{{--                        <img class="position-absolute w-100 h-100 rounded" src="{{ asset('frontView/img/about.jpg')  }}" style="object-fit: cover;">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-12">
                    <div class="mb-4">
{{--                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">About</h5>--}}
                        <h4 class="display-6">Welcome to SONGJOG</h4>
                    </div>
                    <p style="text-align: justify;color:#333;line-height: 30px;">
                        SONGJOG – NOFEL is a groundbreaking music platform designed for audiophiles, artists, and music lovers alike. Whether you're a creator looking for a space to showcase your work or a listener eager to explore new sounds, SONGJOG – NOFEL offers a unique, immersive experience.
                        SONGJOG – NOFEL is more than just a platform; it's a movement. We are committed to pushing the boundaries of music and bringing together listeners, artists, and creators in ways never seen before.

                        SONGJOG – NOFEL is a groundbreaking music platform designed for audiophiles, artists, and music lovers alike. Whether you're a creator looking for a space to showcase your work or a listener eager to explore new sounds, SONGJOG – NOFEL offers a unique, immersive experience.
                        SONGJOG – NOFEL is more than just a platform; it's a movement. We are committed to pushing the boundaries of music and bringing together listeners, artists, and creators in ways never seen before.
                        SONGJOG – NOFEL is a groundbreaking music platform designed for audiophiles, artists, and music lovers alike. Whether you're a creator looking for a space to showcase your work or a listener eager to explore new sounds, SONGJOG – NOFEL offers a unique, immersive experience.
                        SONGJOG – NOFEL is more than just a platform; it's a movement. We are committed to pushing the boundaries of music and bringing together listeners, artists, and creators in ways never seen before.
                        Are you ready to experience music like never before? Sign up for SONGJOG – NOFEL today and become part of the musical revolution.
                        <br/> <br/>
                        SONGJOG – NOFEL is a groundbreaking music platform designed for audiophiles, artists, and music lovers alike. Whether you're a creator looking for a space to showcase your work or a listener eager to explore new sounds, SONGJOG – NOFEL offers a unique, immersive experience.
                        SONGJOG – NOFEL is more than just a platform; it's a movement. We are committed to pushing the boundaries of music and bringing together listeners, artists, and creators in ways never seen before.
                        <br/>  <br/>
                        SONGJOG – NOFEL is a groundbreaking music platform designed for audiophiles, artists, and music lovers alike. Whether you're a creator looking for a space to showcase your work or a listener eager to explore new sounds, SONGJOG – NOFEL offers a unique, immersive experience.
                        SONGJOG – NOFEL is more than just a platform; it's a movement. We are committed to pushing the boundaries of music and bringing together listeners, artists, and creators in ways never seen before.
                        SONGJOG – NOFEL is a groundbreaking music platform designed for audiophiles, artists, and music lovers alike. Whether you're a creator looking for a space to showcase your work or a listener eager to explore new sounds, SONGJOG – NOFEL offers a unique, immersive experience.
                        <br/>
                        SONGJOG – NOFEL is more than just a platform; it's a movement. We are committed to pushing the boundaries of music and bringing together listeners, artists, and creators in ways never seen before.
                        Are you ready to experience music like never before? Sign up for SONGJOG – NOFEL today and become part of the musical revolution.

                    </p>


                </div>
            </div>
        </div>
    </div>
    <!-- Home Page End -->

{{--    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true" >--}}
{{--        <div class="modal-dialog" >--}}
{{--            <div class="modal-content" >--}}
{{--                <div class="modal-header">--}}
{{--                    <div class="col-sm-11" style="text-align: center">--}}
{{--                        <a href="{{ url('/registration') }}" class="btn btn-success custom-btn blink">Registration Now</a>--}}
{{--                        <a href="{{ url('/internationalFaculty') }}" class="btn btn-primary custom-btn ">Know Our International Faculties</a>--}}

{{--                    </div>--}}
{{--                    <div class="col-sm-1 " style="text-align:end">--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <img src="{{ asset('public/frontView/img/poster.jpeg')  }}" style="width: 100%;">--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <a href="{{ url('/registration') }}" class="btn btn-success custom-btn blink">Registration Now</a>--}}
{{--                    <a href="{{ url('/internationalFaculty') }}" class="btn btn-primary custom-btn ">Know Our International Faculties</a>--}}
{{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        document.addEventListener("DOMContentLoaded", () => {--}}
{{--            const welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));--}}
{{--            welcomeModal.show();--}}
{{--        });--}}
{{--    </script>--}}
    <style>
        .modal-dialog {
            max-width: 80%;
        }

        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 95%;
            }
        }

        .custom-btn {
            font-size: 16px; /* Slightly larger font */
            padding: 10px 20px; /* Add padding for a better look */
            border-radius: 25px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
            transition: transform 0.2s, box-shadow 0.2s; /* Smooth hover effect */
            text-align: center;
        }

        .custom-btn:hover {
            transform: translateY(-2px); /* Lift the button slightly */
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Slightly stronger shadow on hover */
            opacity: 0.9; /* Dim slightly */
        }

        .custom-btn:active {
            transform: translateY(0); /* Reset lift on click */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Reset shadow on click */
            opacity: 1; /* Reset dimming */
        }

        /* Blinking effect */
        .blink {
            animation: blinking 1.5s infinite; /* Duration of blinking and infinite repeat */
        }

        @keyframes blinking {
            0%, 100% {
                opacity: 1; /* Fully visible */
            }
            50% {
                opacity: 0.5; /* Slightly transparent */
            }
        }

    </style>
@endsection
