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

    <!--Speakers Single Area Start Here-->
    <div class="speakers-single-area pad100">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="speakers-img">
                        @foreach($details['assets'] as $index =>$asset)
                            @if($asset['asset_type'] == 'image')
                                @if($index ==0)
                                    <a href="{{$asset['assets']}}" data-lightbox="display">
                                        <img class="img-fluid" src="{{$asset['assets']}}" alt="trainer-img">
                                    </a>
                                @else
                                    <a href="{{$asset['assets']}}" data-lightbox="display" style="display:none">
                                        <img class="img-fluid" src="{{$asset['assets']}}" alt="trainer-img">
                                    </a>
                                @endif
                            @else
                                <iframe width="450" height="280" src="https://www.youtube.com/embed/sXmucZx5_ig" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                                </iframe>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- /.col end-->
                <div class="col-lg-7 col-md-12">
                    <div class="inner-content">
                        <h1>{{$details['team_name']}}</h1>
                        <span>{{$details['contact_person']}}</span>
                        <p>{{$details['title']}}</p>
                        <p class="mb-0">{{$details['description']}}</p>
                        {{--<div class="social-icon">--}}
                        {{--<ul>--}}
                        {{--<li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
                        {{--<li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
                        {{--<li><a href="#"><i class="fa fa-dribbble"></i></a></li>--}}
                        {{--<li><a href="#"><i class="fa fa-camera"></i></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        <button class="sub-btn btn-primary">
                            <a href="{{url('vote',$details['id'])}}">Vote</a>
                        </button>
                    </div>
                </div>
                <!-- /.col end-->
            </div>
            <!-- /.row end-->

        </div>
        <!-- /.container end-->
    </div>
    <!--Speakers Single Area End Here-->
@endsection