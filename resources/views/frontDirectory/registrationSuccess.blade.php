@extends('frontDirectory.layouts.master')
@section('title', 'Contact Us')
@section('main_content')
    <div class="container-fluid py-5">
        <div class="container" style="color: #333;">
            <div class="row gx-5">
                <?php
                    $daysAttend=[
                        1=> "First day Tk 3000 ",
                        2=> "Both days (2nd day - live surgery) - Tk 5000",
                    ];
                ?>
                <div class="col-lg-12">
                    <div class="row justify-content-center position-relative" >
                        <div class="col-lg-6">
                            <div class="">
                                <table class="table table-bordered" style="width: 100%;color:#333;">
                                    <tr>
                                        <td colspan="2" style="font-weight: bold;font-size:20px;">Please Check Before Payment</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Name</th>
                                        <td>   {{$doctorTitle[$registrationInfo->title]??NULL}}    {{$registrationInfo->name??NULL}}</td>
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
                                        <td colspan="2" style="text-align: center">
                                            <a href="{{ url('/') }}" class="btn btn-danger">Back</a>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row justify-content-center position-relative" >
                                <div class="col-lg-12">
                                    <div class="">
                                        <form action="{{ route('url-create') }}" method="post">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="form-group">
                                                    <label id="levelFontSize">Payment Category <span class="mandatory_field">(*)</span> </label>
                                                </div>
                                                <div class="form-group">
                                                    <input  type="radio" value="1" class="changePackageCategory" name="packageCategory" id="packageCategory1">
                                                    <label class="form-check-label" for="packageCategory1">
                                                        DELEGATES
                                                    </label>
                                                    &nbsp;&nbsp;
                                                    <input  type="radio" value="2" name="packageCategory" class="changePackageCategory" id="packageCategory2">
                                                    <label class="form-check-label" for="packageCategory2">
                                                        TRAINEES
                                                    </label>
                                                </div>
                                                <div class="form-group DELEGATES">
                                                    <?php
                                                    foreach($daysAttend as $keyDays=> $days){
                                                        ?>
                                                    <input  type="radio" class="delegatesSubCtg" name="durationPresent" value="{{ $keyDays }}" id="durationPresent{{ $keyDays }}" >
                                                    <label class="form-check-label" for="durationPresent{{ $keyDays }}" style="color:green;font-weight: bold;font-size:18px;">
                                                            <?php echo $days ?>
                                                    </label>
                                                    <div class="clearfix"></div>
                                                    <div style="height: 10px;"></div>

                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="form-group TRAINEES">
                                                    <label class="form-check-label" style="color:green;font-weight: bold;font-size:18px;">
                                                        Both Days (TK 3,000)
                                                    </label>
                                                </div>
                                                <div class="form-group showAmountDiv">
                                                    <label id="levelFontSize">Registration Fees <span class="mandatory_field">(*)</span></label>
                                                    <div id="showAmount"></div>
                                                    <input id="amount" type="hidden" value="" name="amount" maxlength="11" required placeholder="Amount"
                                                           readonly class="form-control">
                                                </div>

                                                <div class="form-group">

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

                                                </div>
                                                <div class="form-group">
                                                    <input id="applicantID" type="hidden" name="applicantID" value="{{ !empty($registrationInfo->id)?encrypt($registrationInfo->id): NULL  }}">
                                                    <button type="submit" class="btn btn-primary  w-100 py-3" id="bKash_button">Pay with bKash</button>
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



