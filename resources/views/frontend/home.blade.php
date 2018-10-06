@extends('frontend.layouts.app')


@section('main-content')
<!--Hero Banner Area Start Here-->
<div class="hero-banner-area home-2 hero-bg-2 parallax no-attm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <div class="upcoming">
                        <span class="is-countdown"> </span>
                        <div data-countdown="{{$upcoming_event_time}}"></div>
                    </div>
                </div>
                @if ( session()->has('success') )
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Hero Banner Area End Here-->


<!--Event Schedule Area Start Here-->
<div class="event-schedule-area-two bg-color pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text">
                        <h2>Event Schedule</h2>
                    </div>
                </div>
            </div>
            <!-- /.col end-->
        </div>
        <!-- row end-->
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav custom-tab" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-taThursday" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upcoming</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Completed</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center" scope="col">Date</th>
                                    <th scope="col"></th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Venue</th>
                                    <th class="text-center" scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($future_events) > 0)
                                @foreach($future_events as $event)
                                <tr class="inner-box">
                                    <th scope="row">
                                        <div class="event-date">
                                            <span>{{$event->modifiedEventDate[0]}}</span>
                                            <p>{{$event->modifiedEventDate[1]}}</p>
                                            <p>{{$event->modifiedEventDate[2]}}</p>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="event-img">
                                            <img class="img-fluid" src="{{('frontend/img/team/creativity.png')}}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="event-wrap">
                                            <h3><a href="{{url('register',$event['id'])}}">{{$event['title']}}</a></h3>
                                            <div class="meta">
                                                <div class="organizers">
                                                    <a href="{{url('register',$event['id'])}}">{{$event['description']}}</a>
                                                </div>
                                                <div class="time">
                                                    <span>{{$event->modifiedEventDate[3]." ".$event->modifiedEventDate[4]}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="r-no">
                                            <span>{{$event['location']}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="primary-btn">
                                            <a class="btn-primary" href="{{url('register',$event['id'])}}">Register</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr class="inner-box">

                                        <td colspan="5" class="text-center">No upcoming events available. </td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col"></th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($past_events)>0)
                                @foreach($past_events as $event)
                                <tr onclick="document.location = '{{url('participants',$event['id'])}}';" class="inner-box">
                                    <th scope="row">
                                        <div class="event-date">
                                            <span>{{$event->modifiedEventDate[0]}}</span>
                                            <p>{{$event->modifiedEventDate[1]}}</p>
                                            <p>{{$event->modifiedEventDate[2]}}</p>

                                        </div>
                                    </th>
                                    <td>
                                        <div class="event-img">
                                            <img class="img-fluid" src="{{('frontend/img/team/creativity.png')}}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="event-wrap">
                                            <h3><a href="{{url('participants',$event['id'])}}">{{$event['title']}}</a></h3>
                                            <div class="meta">
                                                <div class="organizers">
                                                    <a href="{{url('participants',$event['id'])}}">{{$event['description']}}</a>
                                                </div>
                                                <div class="time">
                                                    <span>{{$event->modifiedEventDate[3]." ".$event->modifiedEventDate[4]}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="r-no">
                                            <span>{{$event['location']}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="primary-btn">
                                            {{--<a class="btn-primary" href="{{url('participants',$event['id'])}}">View</a>--}}
                                            {{--<br/><br/>--}}
                                            <a class="btn btn-sm btn-primary" href="{{url('participants/upload',$event['id'])}}">Upload Content</a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                                @else
                                        <tr class="inner-box">

                                            <td colspan="5" class="text-center">No past events available. </td>
                                        </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Event Schedule Area End Here-->


{{--

<!--Our Sponsers Area Start Here-->
<div class="our-sponsers-area-tow pad100 bg-color">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text mb50 xs-mb40">
                        <h2>Our Sponsers</h2>
                        <p>Ocurreret temporibus nec ad. Vim dolor appetere percipitur te. Illud noluisse petentium at mea,<br>pro vide eloquentiam ex, ne eum sumo aperiam. Hinc disputando an qui, no sed.</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
        <div class="row">
            <div class="sponsers-active owl-carousel owl-theme">
                <div class="col-lg-12">
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/10.png')}}" alt=""></a>
                    </div>
                    <div class="boder"></div>
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/12.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/11.png')}}" alt=""></a>
                    </div>
                    <div class="boder"></div>
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/15.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/12.png')}}" alt=""></a>
                    </div>
                    <div class="boder"></div>
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/16.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/13.png')}}" alt=""></a>
                    </div>
                    <div class="boder"></div>
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/17.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/13.png')}}" alt=""></a>
                    </div>
                    <div class="boder"></div>
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/10.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/15.png')}}" alt=""></a>
                    </div>
                    <div class="boder"></div>
                    <div class="single-sponsers">
                        <a href="#"><img src="{{('frontend/img/sponsers/10.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary-btn text-center">
                    <a href="#" class="btn-primary">Become Sponsor</a>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Our Sponsers Area End Here-->
--}}


<!--Counter Up Area Start Here-->
<div class="counter-up-area pad100 bg-counter parallax">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3">
                <div class="single-counter xs-mb40">
                    <div class="count-content">
                        <span class="count">80</span>
                        <p>Events</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3">
                <div class="single-counter xs-mb40">
                    <div class="count-content">
                        <span class="count">120</span>
                        <p>Participants</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3">
                <div class="single-counter xs-mb40">
                    <div class="count-content">
                        <span class="count">65</span>
                        <p>Speakers</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 d-md-none d-lg-block col-sm-3">
                <div class="single-counter">
                    <div class="count-content">
                        <span class="count">30</span>
                        <p>Sponsors</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Counter Up Area End Here-->