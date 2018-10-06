@extends('frontend.layouts.app')

@section('main-content')

<!--About Us Area Start Here-->
<div class="about-us-area pad-head bg-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content">
                    <div class="section-title text-center">
                        <h2>{{$event['title']}}</h2>
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
        <div class="row justify-content-md-center">
            <div class="col-lg-5">
                <div class="section-title">
                    <div class="title-text pl">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="success_message" class="alert alert-success"></div>
            <div style="display: none;" id="failed_message" class="alert alert-danger"></div>
        <!-- /col-->
        <div class="row justify-content-md-center">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8">
                <div class="contact ct-form">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-form">
                                <form id="contact-form" data-toggle="validator" action="javascript:void(0)" role="form" method="POST">
                                    {{csrf_field()}}
                                    {{--@if ($errors->any())--}}
                                        {{--<div class="alert alert-danger">--}}
                                            {{--<ul>--}}
                                                {{--@foreach ($errors->all() as $error)--}}
                                                    {{--<li>{{ $error }}</li>--}}
                                                {{--@endforeach--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}
                                    <input type="hidden" name="event_id" id="event_id" value="{{$event['id']}}">
                                    <div class="form-group ">
                                        <input id="team_name" type="text" name="team_name" value="{!! old('team_name') !!}" class="captialize {{ $errors->has('team_name') ? 'alert alert-danger' : ''}} form-control" placeholder="Team Name*" required>
                                        {!! $errors->first('team_name', '<p class="help-block">:message</p>') !!}
                                        <p id="team_name_error"></p>
                                    </div>
                                    <div class="form-group">
                                        <input id="title" type="text" name="title" value="{!! old('title') !!}" class="captialize {{ $errors->has('title') ? 'alert alert-danger' : ''}} form-control" placeholder="Activity Title*" >
                                        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                        <p id="title_error"></p>
                                    </div>
                                    <div class="form-group">
                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Activity Description*</span>
                                        <textarea id="description" name="description"  class="{{ $errors->has('description') ? 'alert alert-danger' : ''}} form-control" placeholder="Activity Description*" rows="5">{!! old('description') !!}</textarea>
                                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                        <p id="description_error"></p>
                                    </div>
                                    <div class="form-group">
                                        <input id="contact_person" type="text" name="contact_person" value="{!! old('contact_person') !!}" class="captialize {{ $errors->has('contact_person') ? 'alert alert-danger' : ''}} form-control" placeholder="Contact Person*" >
                                        {!! $errors->first('contact_person', '<p class="help-block">:message</p>') !!}
                                        <p id="contact_person_name_error"></p>
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" name="email" value="{!! old('email') !!}" class="{{ $errors->has('email') ? 'alert alert-danger' : ''}} form-control" placeholder="Email*" >
                                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        <p id="leader_email_error"></p>
                                    </div>
                                    <div class="form-group">
                                        <input id="mobile" type="number" min="0" name="mobile" value="{!! old('mobile') !!}" class="{{ $errors->has('mobile') ? 'alert alert-danger' : ''}} form-control" placeholder="Mobile*" >
                                        {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                                        <p id="mobile_error"></p>
                                    </div>
                                    <input type="hidden" name="allmembers" id="allmembers" value="">

                                    <div id="members">
                                        <div class="form-group">
                                            <h5 class="text-center">Add Members</h5>
                                        </div>
                                        <div id="success"></div>
                                        <div id="error"></div>
                                        <div class="form-group">
                                            <input id="member_name" type="text" name="member-name" value="{!! old('member_name') !!}" class="captialize member form-control" placeholder="Member Name*" >
                                            <p class="" id="member_name_error"></p>
                                        </div>
                                        <div class="form-group">
                                            <input id="member_email" type="email" name="member_email" value="{!! old('member_email') !!}" class="member form-control" placeholder="Member Email*" >
                                            <p class="" id="member_email_error"></p>
                                        </div>
                                        <div class="form-group">
                                            <input id="member_mobile" type="number" min="0" name="member_mobile" value="{!! old('member_mobile') !!}" class="member form-control" placeholder="Member Mobile*" >
                                            <p class="" id="member_mobile_error"></p>
                                        </div>
                                    </div>
                                    <div class="btn-2 text-center" id="add_members">
                                        <button class="btn-primary" type="button">+ Add Members</button>
                                    </div>
                                    <br/>
                                    <div id="member-list">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Name</th>
                                                <th class="text-center" scope="col">Email</th>
                                                <th class="text-center" scope="col">Mobile Number</th>
                                            </tr>
                                            </thead>
                                            <tbody id="member-data">

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="btn-2 text-center">
                                        <button class="btn-primary" id="registration_submit" name="submit-form" type="submit">Send</button>
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
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
    <script>CKEDITOR.replace('description');</script>
    <script>
        var checkemail = "{{url('/register/checkemail')}}";
        var register = "{{url('/register')}}";
    </script>
    <script src="{{asset('frontend/js/registration.js')}}"></script>
    <script src="{{asset('frontend/js/addmembers.js')}}"></script>


@endsection