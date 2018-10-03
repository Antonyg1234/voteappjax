@extends('frontend.layouts.app')
@section('main-content')

    <!--About Us Area Start Here-->
    <div class="about-us-area pad-head bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content">
                        <div class="section-title text-center">
                            <h2>{{$event_participant['event_title']}}</h2>
                            <p>{{$event_participant['description']}}</p>
                        </div>
                    </div>
                </div>
                <!-- /col-->
            </div>
            <!-- /row-->
        </div>
        <!--/ container-->
    </div>
    <!--About Us Area End Here-->

    <!--Contact Area Start Here-->
    <div class="ct-2 contact-area pad100">
        <div class="container">
            <!-- /col-->
            <div class="row justify-content-md-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8">
                    <div class="contact ct-form">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="contact-form">
                                    <input type="hidden" name="otp_sent" id="otp_div" value="{{session()->get('otp')}}">
                                    <div id="error"></div>
                                    <div id="success"></div>
                                    <form id="contact-form" data-toggle="validator" action="javascript:void(0)" role="form" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" id="event_praticipants_id" name="event_praticipants_id" value="{{$event_participant['participants_id']}}">
                                        <input type="hidden" id="event_id" name="event_id" value="{{$event_participant['event_id']}}">
                                        <div class="form-group">
                                            <input id="email" type="text" name="email" class="form-control" placeholder="Enter Email*" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" name="password" class="form-control" placeholder="Enter password*" >
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="btn-2 text-center">
                                            <button class="btn-primary" id="email_submit" name="submit-form" type="">Send</button>
                                        </div>

                                    </form>
                                    <form id="otp-form" data-toggle="validator" action="javascript:void(0)" style="display: none" role="form" method="POST">
                                        {{--<div id="error"></div>--}}
                                        {{--<div id="success"></div>--}}
                                        <sapn>Please enter OTP below :</sapn>
                                        <div class="form-group">
                                            <input id="otp" type="text" name="otp" class="form-control" placeholder="Enter OTP*" >
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="btn-2 text-center">
                                            <button class="btn-primary" id="otp_submit" name="submit-form" type="">Send</button>
                                            <button class="btn-primary" id="otp_resend" name="submit-form" type="">Resend</button>
                                        </div>
                                    </form>
                                    <div id="msgalert" class="hidden"></div>
                                    <span>Note : One user can vote only once</span>
                                </div>
                            </div>
                            <!-- /col-->
                        </div>
                    </div>
                </div>
                <!-- /col-->
            </div>
            <!-- /row-->
        </div>
        <!-- /container-->
    </div>
    <!--Contact Area End Here-->

@endsection

@section('script')
    <script>
        var otpSenderUrl = "{{url('vote/sendOtp')}}";
        var voteUrl = "{{url('vote/otp')}}";
    </script>
    <script src="{{asset('frontend/js/otp.js')}}"></script>


@endsection