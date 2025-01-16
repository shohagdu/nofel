@extends('frontDirectory.layouts.master')
@section('title', 'Dashboard')
@section('main_content')
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">International Faculties</h5>
                <h4 class="display-6">BREASTBDCON 2025</h4>
            </div>
            <div class="row gx-5">
                @if(!empty($UK))
                    <h1 class="d-inline-block  text-uppercase border-bottom border-5 text-center">UK</h1>
                    @foreach($UK as $ukFaculty)
                        <div class="col-xl-4 col-lg-6">
                            <div class="bg-light rounded overflow-hidden">
                                @if(!empty($ukFaculty->image) && Storage::disk('public')->exists($ukFaculty->image))
                                    <img src="{{ asset('storage/app/public/' . $ukFaculty->image) }}"  style="height: 350px;width: 100%;">
                                @else
                                    <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="height: 350px;width: 100%;">
                                @endif
                                <div class="p-4" style="height: 250px;">
                                    <h3>{{ $ukFaculty->name??NULL }}</h3>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">{{ $ukFaculty->designation??NULL }}</h6>
                                    <p class="m-0">{{ $ukFaculty->degree_info??NULL }}</p>
                                    <p class="m-0">{{ $ukFaculty->institute??NULL }}</p>
                                </div>
                                <div class="d-flex justify-content-between border-top p-4">
                                    <div class="d-flex align-items-center">

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ url('/viewFacultyDetails/'.encrypt($ukFaculty->id)) }}" class="btn btn-success btn-sm" >  Read More >></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div style="height: 50px;"></div>
                @if(!empty($Turkey))
                    <h1 class="d-inline-block  text-uppercase border-bottom border-5 text-center">Turkey</h1>
                    @foreach($Turkey as $facultyTurkey)
                        <div class="col-xl-4 col-lg-6">
                            <div class="bg-light rounded overflow-hidden">
                                @if(!empty($facultyTurkey->image) && Storage::disk('public')->exists($facultyTurkey->image))
                                    <img src="{{ asset('storage/app/public/' . $facultyTurkey->image) }}"  style="height: 350px;width: 100%;">
                                @else
                                    <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="height: 350px;width: 100%;">
                                @endif
                                <div class="p-4" style="height: 250px;">
                                    <h3>{{ $facultyTurkey->name??NULL }}</h3>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">{{ $facultyTurkey->designation??NULL }}</h6>
                                    <p class="m-0">{{ $facultyTurkey->degree_info??NULL }}</p>
                                    <p class="m-0">{{ $facultyTurkey->institute??NULL }}</p>
                                </div>
                                <div class="d-flex justify-content-between border-top p-4">
                                    <div class="d-flex align-items-center">

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-success btn-xs" href="{{ url('/viewFacultyDetails/'.encrypt($facultyTurkey->id)) }}" >Read More  >> </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div style="height: 50px;"></div>
                @if(!empty($Australia))
                    <h1 class="d-inline-block  text-uppercase border-bottom border-5 text-center">Australia</h1>
                    @foreach($Australia as $facultyAustralia)
                        <div class="col-xl-4 col-lg-6">
                            <div class="bg-light rounded overflow-hidden">
                                @if(!empty($facultyAustralia->image) && Storage::disk('public')->exists($facultyAustralia->image))
                                    <img src="{{ asset('storage/app/public/' . $facultyAustralia->image) }}"  style="height: 350px;width: 100%;">
                                @else
                                    <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="height: 350px;width: 100%;">
                                @endif
                                <div class="p-4" style="height: 250px;">
                                    <h3>{{ $facultyAustralia->name??NULL }}</h3>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">{{ $facultyAustralia->designation??NULL }}</h6>
                                    <p class="m-0">{{ $facultyAustralia->degree_info??NULL }}</p>
                                    <p class="m-0">{{ $facultyAustralia->institute??NULL }}</p>
                                </div>
                                <div class="d-flex justify-content-between border-top p-4">
                                    <div class="d-flex align-items-center">

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-success btn-xs" href="{{ url('/viewFacultyDetails/'.encrypt($facultyAustralia->id)) }}" >Read More  >> </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div style="height: 50px;"></div>
                @if(!empty($India))
                    <h1 class="d-inline-block  text-uppercase border-bottom border-5 text-center">India</h1>
                    @foreach($India as $facultyIndia)
                        <div class="col-xl-4 col-lg-6">
                            <div class="bg-light rounded overflow-hidden">
                                @if(!empty($facultyIndia->image) && Storage::disk('public')->exists($facultyIndia->image))
                                    <img src="{{ asset('storage/app/public/' . $facultyIndia->image) }}"  style="height: 350px;width: 100%;">
                                @else
                                    <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="height: 350px;width: 100%;">
                                @endif
                                <div class="p-4" style="height: 250px;">
                                    <h3>{{ $facultyIndia->name??NULL }}</h3>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">{{ $facultyIndia->designation??NULL }}</h6>
                                    <p class="m-0">{{ $facultyIndia->degree_info??NULL }}</p>
                                    <p class="m-0">{{ $facultyIndia->institute??NULL }}</p>
                                </div>
                                <div class="d-flex justify-content-between border-top p-4">
                                    <div class="d-flex align-items-center">

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-success btn-xs" href="{{ url('/viewFacultyDetails/'.encrypt($facultyIndia->id)) }}" >Read More  >> </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
                <div style="height: 50px;"></div>
                @if(!empty($China))
                    <h1 class="d-inline-block  text-uppercase border-bottom border-5 text-center">China</h1>
                    @foreach($China as $facultyChina)
                        <div class="col-xl-4 col-lg-6">
                            <div class="bg-light rounded overflow-hidden">
                                @if(!empty($facultyChina->image) && Storage::disk('public')->exists($facultyChina->image))
                                    <img src="{{ asset('storage/app/public/' . $facultyChina->image) }}"  style="height: 350px;width: 100%;">
                                @else
                                    <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="height: 350px;width: 100%;">
                                @endif
                                <div class="p-4" style="height: 250px;">
                                    <h3>{{ $facultyChina->name??NULL }}</h3>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">{{ $facultyChina->designation??NULL }}</h6>
                                    <p class="m-0">{{ $facultyChina->degree_info??NULL }}</p>
                                    <p class="m-0">{{ $facultyChina->institute??NULL }}</p>
                                </div>
                                <div class="d-flex justify-content-between border-top p-4">
                                    <div class="d-flex align-items-center">

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-success btn-xs" href="{{ url('/viewFacultyDetails/'.encrypt($facultyChina->id)) }}" >Read More  >> </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection



