@extends('frontDirectory.layouts.master')
@section('title', 'Contact Us')
@section('main_content')
    <div class="container-fluid py-5">
        <div class="container" style="color: #333;">
            <div class="row gx-5">
                <?php
                $daysAttend=[
                    1=> "1st day (BDT 3,000) ",
                    2=> "2nd days [Live Surgery] (BDT 5,000)",
                ];
                ?>
                <div class="col-lg-12">
                    <div class="row justify-content-center position-relative" >
                        <div class="col-lg-12">
                            <div class="">
                                <table class="table table-bordered" style="width: 100%;color:#333;">
                                    <tr>
                                        <td colspan="2" style="font-weight: bold;font-size:20px;color:green;">Your Registration Process Successfully Complete. Registration is {{$registrationInfo->member_id??NULL}} </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Name</th>
                                        <td>
                                            {{$doctorTitle[$registrationInfo->title]??NULL}}    {{$registrationInfo->name??NULL}}</td>
                                    </tr>
                                    <tr>
                                        <th>Institute</th>
                                        <td>{{$registrationInfo->institute??NULL}}</td>
                                    </tr>
                                    <tr>
                                        <th>Degree</th>
                                        <td>{{$registrationInfo->degree??NULL}}</td>
                                    </tr>

                                    <tr>
                                        <th>Mobile</th>
                                        <td>{{$registrationInfo->mobile??NULL}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$registrationInfo->email??NULL}}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Category</th>
                                        <td>
                                            @if($registrationInfo->package_category==1)
                                                DELEGATES
                                                @if($registrationInfo->attend_days==1)
                                                    1st Day
                                                @elseif($registrationInfo->attend_days==2)
                                                    2nd Days (live Surgery)
                                                @endif
                                            @elseif($registrationInfo->package_category==2)
                                                TRAINEES
                                            @endif

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Received Amount</th>
                                        <td>{{ $registrationInfo->amount??NULL }}</td>
                                    </tr>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <td>{{ $registrationInfo->bkash_trans_id??NULL }}</td>
                                    </tr>

                                    <tr>
                                        <th>Payment ID</th>
                                        <td>{{ $registrationInfo->payment_id??NULL }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center">
                                            <a href="{{ url('/registration') }}" class="btn btn-success">Another Registration</a>
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #levelFontSize{
            font-size: 20px;
            font-weight: bold;
        }
        #showAmount{
            font-weight: bold;
            font-size: 22px;
            color:red;
        }
    </style>
@endsection



