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
                                    @csrf
                                    <div class="row g-2">
                                        <div class="col-12 col-sm-12">
                                            <label id="levelFontSize">Name <span class="mandatory_field">(*)</span></label>
                                            <input id="name" type="text" name="name" required
                                            placeholder="Enter Name" class="form-control">
                                            @error('name')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Father's Name <span class="mandatory_field">(*)</span></label>
                                                <input id="father_name" type="text" required name="father_name" placeholder="Enter Father Name"
                                                       class="form-control">
                                                @error('father_name')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Mother's Name <span class="mandatory_field">(*)</span></label>
                                                <input id="mother_name" type="text" required name="mother_name" placeholder="Enter Mother Name"
                                                       class="form-control">
                                                @error('mother_name')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Mobile <span class="mandatory_field">(*)</span></label>
                                                <input id="mobile_personal" required type="text" name="mobile" maxlength="15" minlength="11"
                                                       placeholder="Enter Mobile No" class="form-control">
                                                @error('mobile')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Email <span class="mandatory_field">(*)</span></label>
                                                <input id="email" type="text" required name="email" placeholder="Enter Email"
                                                       class="form-control">
                                                @error('email')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Date of Birth <span class="mandatory_field">(*)</span></label>
                                                <input id="dob" type="text" required name="dob" placeholder="Enter Date of Birth"
                                                       class="form-control">
                                                @error('dob')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Nation ID <span class="mandatory_field">(*)</span></label>
                                                <input id="nid" type="text" required name="nid" placeholder="Enter NID"
                                                       class="form-control">
                                                @error('nid')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Blood Group <span class="mandatory_field">(*)</span></label>
                                                <select id="bloodGroup" type="text" required name="bloodGroup" class="form-control">
                                                    <option value="">Select Blood Group</option>
                                                </select>

                                                @error('dob')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize">Profession <span class="mandatory_field">(*)</span></label>
                                                <select id="profession" type="text" required name="profession" class="form-control">
                                                    <option value="">Select Profession</option>
                                                </select>

                                                @error('profession')
                                                    <div style="color: red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label id="levelFontSize">How can you assist an organization through your profession? (আপনার পেশা থেকে আপনি কীভাবে সংগঠনকে সহায়তা করতে পারেন?) </label>
                                            <textarea id="howAssistOrg" type="text" required name="howAssistOrg" placeholder="How can you assist an organization through your profession? "
                                                      class="form-control"></textarea>
                                            @error('degree')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="row g-3">
                                            <h5>Present Address</h5>
                                        </div>
                                        <div class="row g-1">
                                            <div class=" col-12">
                                                <label id="levelFontSize" for="Country">Country</label>
                                                <select class="form-control" id="country" name="country"  >
                                                    <option value="">Select Country</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-1">
                                            <div class="col-12">
                                                <label id="levelFontSize" for="houseNo">House No/Post Office/State</label>
                                                <textarea type="text" class="form-control" id="houseNo" placeholder="Enter House Number"></textarea>
                                            </div>
                                        </div>
                                        <div class="row g-2 stayBD">
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize" for="upazila">Upazila</label>
                                                <input type="text" class="form-control" id="upazila" placeholder="Enter Upazila">
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize" for="district">District</label>
                                                <select class="form-control" id="district"  >
                                                    <option value="">Select district</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-2 stayForeign">
                                            <div class="col-12">
                                                <label id="levelFontSize" for="upazila">State</label>
                                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter State">
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <h5>Permanent Address</h5>
                                        </div>
                                        <div class="row g-1">
                                            <div class="col-12 ">
                                                <label id="levelFontSize" for="houseNo">House No/Post Office</label>
                                                <textarea class="form-control" id="houseNo" placeholder="Enter House No/Post Office"></textarea>
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize" for="upazila">Upazila</label>
                                                <input type="text" class="form-control" id="upazila" placeholder="Enter Upazila">
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label id="levelFontSize" for="district">District</label>
                                                <select class="form-control" id="district"  >
                                                    <option value="">Select district</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100 py-3" type="submit">Save</button>
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


