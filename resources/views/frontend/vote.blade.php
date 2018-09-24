@extends('frontend.layouts.app')

@section('main-content')

    <!--About Us Area Start Here-->
    <div class="about-us-area pad-head bg-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content">
                        <div class="section-title text-center">
                            <h2>Vote</h2>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li>|</li>
                            <li>Vote</li>
                        </ol>
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
            <div class="row justify-content-md-center">
                <div class="col-lg-5">
                    <div class="section-title">
                        <div class="title-text pl">
                            <h2>Get in Touch</h2>
                            <p>Get In Touch With The Financial Team</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /col-->
            <div class="row justify-content-md-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8">
                    <div class="contact ct-form">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="contact-form">
                                    <form id="contact-form" data-toggle="validator" action="{{route('register.store')}}" role="form" method="POST">
                                        {{csrf_field()}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        
                                        <div class="form-group">
                                            <input id="email" type="text" name="email" class="form-control" placeholder="Enter Email" >
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <input id="mobile" type="text" name="mobile" class="form-control" placeholder="Enter Mobile" >
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="btn-2 text-center">
                                            <button class="btn-primary" name="submit-form" type="submit">Send</button>
                                        </div>
                                    </form>
                                    <div id="msgalert" class="hidden"></div>
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

@endsection