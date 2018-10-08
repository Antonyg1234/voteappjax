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
            @if ( session()->has('success') )
                <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
            @endif
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="speakers-img">
                        @foreach($details['assets'] as $index =>$asset)
                            @if($asset['asset_type'] == 'image')
                                @if($index ==0)
                                    <a href="{{$asset['assets']}}" data-lightbox="display">
                                        <img class="img-fluid" src="{{$asset['assets']}}" width="375" alt="trainer-img">
                                    </a>
                                @else
                                    <a href="{{$asset['assets']}}" data-lightbox="display" style="display:none">
                                        <img class="img-fluid" src="{{$asset['assets']}}" width="375" alt="trainer-img">
                                    </a>
                                @endif
                            @else
                                <iframe width="100%"  src="{{$asset['assets']}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                                </iframe>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- /.col end-->
                <div class="col-lg-7 col-md-12">
                    <div class="inner-content">
                        <h1>{{$details['team_name']}}</h1>
                        <span>{{implode(', ', array_column($details['members'],'name'))}}</span>
                        <p>{{$details['title']}}</p>
                        <p class="mb-0">{!! $details['description'] !!} </p>
                        {{--<div class="social-icon">--}}
                        {{--<ul>--}}
                        {{--<li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
                        {{--<li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
                        {{--<li><a href="#"><i class="fa fa-dribbble"></i></a></li>--}}
                        {{--<li><a href="#"><i class="fa fa-camera"></i></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        @if(!$event['voting_end_date'])
                            <button class="sub-btn btn-primary">
                                <a href="{{url('vote',$details['id'])}}">Vote</a>
                            </button>
                        @endif
                    </div>
                </div>
                <!-- /.col end-->
            </div>
                <br/>
            <!-- /.row end-->
                <div class="text-lg-center">
                    <button class="sub-btn btn-primary">
                        <a href="{{url('participants',$event['id'])}}">View All Participants</a>
                    </button>
                </div>
        </div>
        <!-- /.container end-->
    </div>
    <!--Speakers Single Area End Here-->
@endsection