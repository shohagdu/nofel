@extends('admin.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-xl-12 col-xxl-12 ">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-lg-8 col-xxl-6" >
                            <h5 class="card-title mb-0">Faculty Member Record</h5>
                        </div>
                        <div class="col-6 col-lg-4 col-xxl-6" style="text-align: right">
                            <a href="{{ url('/addNewFacultyMember/') }}" class="btn btn-info btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;">S/N</th>
                        <th>Image</th>
                        <th>Country</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Institute</th>
                        <th>Degree</th>
                        <th style="width: 14%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @if(!empty($facultyMember))
                        @foreach($facultyMember as $faculty)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                     @if(!empty($faculty->image) && Storage::disk('public')->exists($faculty->image))
                                         <img src="{{ asset('storage/app/public/' . $faculty->image) }}" style="max-width: 80px;">
                                     @else
                                         <img src="{{ asset('public/frontView/img/default.jpeg') }}" style="max-width: 80px;">
                                     @endif
                                </td>
                                <td>{{ $faculty->country??null }}</td>
                                <td>{{ $faculty->name??null }}</td>
                                <td>{{ $faculty->designation??null }}</td>
                                <td>{{ $faculty->institute??null }}</td>
                                <td>{{ $faculty->degree_info??null }}</td>
                                <td>{{ $faculty->is_active?($faculty->is_active==1?'Active':'Inactive'):'' }}</td>
                                <td><a href="{{ url('/updateFacultyMember/'.encrypt($faculty->id)) }}" class="btn btn-primary btn-sm">Edit</a>
{{--                                    <a href="{{ url('/deleteFacultyMember/'.encrypt($faculty->id)) }}" class="btn btn-danger btn-sm">Delete</a> </td>--}}
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
