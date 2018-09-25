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
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li>|</li>
                        <li>Register</li>
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
                                    <input type="hidden" name="event_id" value="{{$event['id']}}">
                                    <div class="form-group">
                                        <input id="team_name" type="text" name="team_name" class="form-control" placeholder="Team Name" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="title" type="text" name="title" class="form-control" placeholder="Title" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="description" name="description" class="form-control" placeholder="Description" rows="5"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="contact_person" type="text" name="contact_person" class="form-control" placeholder="Contact Person" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" name="email" class="form-control" placeholder="Email" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="mobile" type="text" name="mobile" class="form-control" placeholder="Mobile" >
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div id="wrapper"></div>

                                    <div class="btn-2 text-center" id="add_members">
                                        <button class="btn-primary" type="button">+ Add Members</button>
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
<script>
    $(document).ready(function() {
        var max_fields      = 5; //maximum input boxes allowed
        //alert('dfds');
        var x = 0; //initlal text box count
        $("#add_members").click(function(e){ //on add input button click

            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                    $("#wrapper").append('<div id="member-'+ x +'"><hr><div style="margin-left: 310px;padding-bottom: 15px">Member' + x + '</div><div class="form-group"><input id="name'+ x +'" type="text" name="names[]" class="form-control" placeholder="Name'+ x +'" required ></div><div class="form-group"><input id="email'+ x +'" type="text" name="emails[]" class="form-control" placeholder="Email'+ x +'" required ></div><div class="form-group"><input id="mobile'+ x +'" type="text" name="mobiles[]" class="form-control" placeholder="Mobile'+ x +'" required ></div><a href="javascript:void(0)" class="remove_field"> Remove</a></div>'); //add input box
            }
        });


        $('#wrapper').on("click",".remove_field", function(e){ //user click on remove text
            //alert('test');
            e.preventDefault(); $("#wrapper").empty(); x--;
            for(var i=1;i<=x;i++){
                $("#wrapper").append('<div id="member-'+ i +'"><hr><div style="margin-left: 310px;padding-bottom: 15px">Member' + i + '</div><div class="form-group"><input id="name'+ i +'" type="text" name="names[]" class="form-control" placeholder="Name'+ i +'" required></div><div class="form-group"><input id="email" type="text" name="emails[]" class="form-control" placeholder="Email'+ i +'" required></div><div class="form-group"><input id="mobile'+ i +'" type="text" name="mobiles[]" class="form-control" placeholder="Mobile'+ i +'" required></div><a href="javascript:void(0)" class="remove_field"> Remove</a></div>');
            }
        })


//        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
//            e.preventDefault(); $(this).parent('div').remove(); x--;
//        })
    });
</script>
@endsection