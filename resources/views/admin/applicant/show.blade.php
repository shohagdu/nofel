@extends('admin.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-lg-8 col-xxl-6" >
                            <h5 class="card-title mb-0"> Workshop Applicant Details Information</h5>
                        </div>
                        <div class="col-6 col-lg-4 col-xxl-6" style="text-align: right">
                            <a href="{{ url('/workshopApplicant') }}" class="btn btn-danger btn-sm">Back</a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Applicant ID</th>
                        <td colspan="4">{{ $applicant->member_id??NULL }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $doctorTitle[$applicant->title]??NULL }}</td>
                        <th>Name</th>
                        <td>{{ $applicant->name??NULL }}</td>
                    </tr>
                    <tr>
                        <th>Institute</th>
                        <td>{{ $applicant->institute??NULL }}</td>
                        <th>Degree</th>
                        <td>{{ $applicant->degree??NULL }}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td>{{ $applicant->mobile??NULL }}</td>
                        <th>Email</th>
                        <td>{{ $applicant->email??NULL }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ $applicant->received_amount??NULL }}</td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th colspan="4">Bkash Transaction Information</th>
                    </tr>
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $applicant->bkash_trans_id??NULL }}</td>
                        <th>Payment ID</th>
                        <td>{{ $applicant->payment_id??NULL }}</td>
                    </tr>
                    <tr>
                        <th>From Bkash</th>
                        <td>{{ !empty($applicant->bkash_mobile)? $applicant->bkash_mobile:"(".$applicant->to_bksah.")" }} </td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
@endsection
