@extends('frontDirectory.layouts.master')
@section('title', 'Dashboard')
@section('main_content')
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                    <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Invitation</h5>
                    <h4 class="display-6">BREASTBDCON 2025</h4>
                </div>
                <div class="col-lg-12">
                    <p style="text-align: justify;color:#333;font-size: 18px;">
                       <b>Dear Colleague,</b>
                        <br/> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Warm greetings from the Bangladesh School of Oncoplastic Surgery (BSOS). We are excited to announce the upcoming <b>BREASTBDCON 2025</b> , a prestigious international scientific program focused on breast cancer, which will take place on <b> 23rd and 24th February 2025</b>.
                        <br/>
                        <br/>
                        This will be our second international program, and we are delighted to host distinguished guests from Asia and Europe, including experts from the <b> UK, Turkey, India,  Australia and China </b>. The event will feature renowned speakers, moderators, panelists, and live surgery demonstrations.<br/><br/>
                        The program will include: <b>Lectures</b> by global experts, <b>Symposia</b> and <b>Debates</b> on key topics in breast cancer care, <b>Panel Discussions</b> and <b>Case Discussions and Live Surgery Sessions</b> demonstrating cutting-edge techniques.
                        In addition to surgical topics, there will be comprehensive discussions on <b> imaging, pathology, radiation, </b>and <b>medical oncology.</b> This educational meeting promises to be an enriching experience for Bangladeshi surgeons and physicians, providing an opportunity to learn from world leaders .This is a good time to enjoy pleasant weather and unique beauty of Bangladesh.<br/><br/>
                        We look forward to your participation in what promises to be an eventful and enriching program. We hope you will join us in making <b>BREASTBDCON 2025</b> a grand success.<br/><br/>
                        <br/>
                    </p>
                    <p>
                    <table  style="width: 100%;color:#333;">

                        <tr>
                            <td style="text-align: center">
                                <img src="{{ asset('public/frontView/img/Mizanur-Rahman.jpg') }}" style="height: 200px;"> </td>
                            <td style="text-align: center">
                                <img src="{{ asset('public/frontView/img/dr_jahangirKabir.png') }}" style="height: 200px;">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;padding-top: 10px;">
                              <h5> Prof M. Mizanur Rahman </h5>
                                <h6> Chairman</h6>
                            </td>
                            <td style="text-align: center;padding-top: 10px;"> <h5>Dr. Md Jahangir Kabir  </h5>
                                <h6> Secretary</h6>
                            </td>
                        </tr>

                    </table>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
