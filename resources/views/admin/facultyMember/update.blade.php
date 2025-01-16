@extends('admin.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-xl-12 col-xxl-12 ">
{{--            {{ dd($facultyMemberInfo) }}--}}
            <div class="card flex-fill">
                <div class="card-header" >
                    <div class="row">
                        <div class="col-6 col-lg-8 col-xxl-6" >
                            <h5 class="card-title mb-0"> {{ !empty($facultyMemberInfo)?'Update':'Add' }} Faculty Member Information</h5>
                        </div>
                        <div class="col-6 col-lg-4 col-xxl-6" style="text-align: right">
                            <a href="{{ url('/facultyMember') }}" class="btn btn-info btn-sm">Record</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div >
                        <form action="{{ url('updatedStoreFacultyMember') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-8 col-lg-8 col-xxl-8">
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input class="form-control form-control-lg"  type="file" name="image"  accept="image/*" />

                                        @if(!empty($facultyMemberInfo->image) && Storage::disk('public')->exists($facultyMemberInfo->image))
                                           <input type="hidden" name="hiddenImage" value="{{ $facultyMemberInfo->image }}">
                                        @endif

                                        @error('image')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <select class="form-control form-control-lg"   name="country"  >
                                            <option value="">Select One</option>
                                            @if(!empty($country))
                                                @foreach($country as $cont)
                                                    <option value="{{$cont}}" {{ !empty($facultyMemberInfo->country) && $cont== $facultyMemberInfo->country?"selected":'' }}>{{$cont}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('country')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input value="{{ $facultyMemberInfo->name??'' }}" class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" />
                                        @error('name')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 col-lg-4 col-xxl-4 text-center">
                                    @if(!empty($facultyMemberInfo->image) && Storage::disk('public')->exists($facultyMemberInfo->image))
                                        <img src="{{ asset('storage/app/public/' . $facultyMemberInfo->image) }}" style="max-width: 200px;">
                                    @else
                                        <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="max-width: 200px;">
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Designation</label>
                                <input class="form-control form-control-lg" value="{{ $facultyMemberInfo->designation??'' }}" type="text" name="designation" placeholder="Enter your company name" />
                                @error('designation')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Institute</label>
                                <input class="form-control form-control-lg" value="{{ $facultyMemberInfo->institute??'' }}" type="text" name="institute" placeholder="Enter Institute" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Degree Info</label>
                                <input class="form-control form-control-lg" value="{{ $facultyMemberInfo->degree_info??'' }}" type="text" name="degree" placeholder="Enter Degree" />
                                @error('degree')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-6 col-lg-6 col-xxl-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control form-control-lg"   name="is_active"  >
                                            <option value="">Select One</option>
                                            <option value="1" {{ !empty($facultyMemberInfo->is_active) && $facultyMemberInfo->is_active==1?'selected':'' }}>Active</option>
                                            <option value="2"  {{ !empty($facultyMemberInfo->is_active) &&  $facultyMemberInfo->is_active==2?'selected':'' }}>In-Active</option>
                                        </select>
                                        @error('is_active')
                                        <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-lg-6 col-xxl-6">

                                    <div class="mb-3">
                                        <label class="form-label">View Order</label>
                                        <input class="form-control form-control-lg" value="{{ $facultyMemberInfo->view_order??'' }}" type="text" name="view_order" placeholder="Enter View Order" />
                                        @error('view_order')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Biography</label>
                                <textarea rows="6" class="form-control form-control-lg"   name="biography" placeholder="Enter Biography" >{{ $facultyMemberInfo->biography??'' }}</textarea>
                            </div>

                            <div class=" mt-3">
                                <input type="hidden" name="facultyMemberId" id="facultyMemberId" value="{{ $facultyMemberInfo->id??'' }}">
                                 <button type="submit" class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        .form-label{
            font-weight: bold;
            font-size: 16px;
        }

    </style>
@endsection
