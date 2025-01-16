@extends('frontDirectory.layouts.master')
@section('title', 'Contact Us')
@section('main_content')
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-12">
                    <div class="row justify-content-center position-relative" >
                        <div class="col-lg-12">
                            <div class="">
                                @if(session('success'))
                                    <div class="form-group">
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                @endif

                                @if(session('error'))
                                     <div class="form-group">
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                @endif
                                <form action="{{url('/updateWorkshopPaymentInfo')}}" method="post">
{{--                                <form action="{{ route('url-create') }}" method="post">--}}
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12 col-sm-3">
                                            <label  id="levelFontSize">Title <span class="mandatory_field">(*)</span> </label>
                                            <select id="title"  name="title" required
                                                    class="form-control changeDoctorTitle">
                                                <option value="">Select Title</option>
                                                @foreach($doctorTitle as $key=> $title)
                                                    <option value="{{$key}}">{{$title}}</option>
                                                @endforeach
                                            </select>
                                            @error('title')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-9">
                                            <label id="levelFontSize">Name <span class="mandatory_field">(*)</span></label>
                                            <input id="name" type="text" name="name" required
                                            placeholder="Enter Name" class="form-control">
                                            @error('name')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>




                                        <div class="col-12">
                                            <label id="levelFontSize">Institute <span class="mandatory_field">(*)</span></label>
                                            <input id="institute" type="text" required name="institute" placeholder="Enter Institute"
                                                   class="form-control">
                                            @error('institute')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label id="levelFontSize">Highest Degree <span class="mandatory_field">(*)</span></label>
                                            <input id="degree" type="text" required name="degree" placeholder="Enter Highest Degree"
                                                   class="form-control">
                                            @error('degree')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label id="levelFontSize">Mobile No  <span class="mandatory_field">(*)</span></label>
                                            <input id="mobile_personal" required type="text" name="mobile" maxlength="15" minlength="11"
                                                   placeholder="Enter Mobile No(Applicant)" class="form-control">
                                            @error('mobile')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label id="levelFontSize">E-mail <span class="mandatory_field">(*)</span></label>
                                            <input id="email" required type="email" name="email" placeholder="Enter Email"
                                                   class="form-control">
                                            @error('email')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Next</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #levelFontSize{
            font-weight: bold;
            font-size: 16px;
            color:#333;
        }
    </style>

@endsection


