@extends('frontDirectory.layouts.master')
@section('title', 'Contact Us')
@section('main_content')



    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" >
                <h5 class="d-inline-block text-primary  border-bottom border-5">Profile of </h5>
                <h1>{{ $facultyMember->name??NULL }}</h1>
            </div>
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6">
                    <div class="bg-light rounded overflow-hidden">
                        @if(!empty($facultyMember->image) && Storage::disk('public')->exists($facultyMember->image))
                            <img src="{{ asset('storage/app/public/' . $facultyMember->image) }}"  style="height: 350px;width: 100%;">
                        @else
                            <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="height: 350px;width: 100%;">
                        @endif
                        <div class="p-4">
                            <p class="h3 d-block mb-3" >{{ $facultyMember->name??NULL }}</p>
                            <p class="m-0" >{{ $facultyMember->designation??NULL }}</p>
                            <p class="m-0">{{ $facultyMember->degree_info??NULL }}</p>
                            <p class="m-0">{{ $facultyMember->institute??NULL }}</p>                       </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6">
                    <p class="m-0" style="color: #333;">
{{--                        {{ $facultyMember->institute??NULL }}--}}
                        {!! $facultyMember->biography??NULL  !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection



