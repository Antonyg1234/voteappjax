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
                    <h3>Neosoft Ganesh</h3>
                </div>
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get($success) !!}</li>
                        </ul>
                    </div>
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
                    <p>In ludus latine mea, eos paulo quaestio an. Meis possit ea sit. Vidisse molestie<br> cum te, sea lorem instructior at.</p>
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
                                @foreach($future_events as $event)
                                <tr class="inner-box">
                                    <th scope="row">
                                        <div class="event-date">
                                            <span>{{$event['event_date'][0]}}</span>
                                            <p>{{$event['event_date'][1]}}</p>
                                            <p>{{$event['event_date'][2]}}</p>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="event-img">
                                            <img class="img-fluid" src="{{('frontend/img/team/creativity.png')}}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="event-wrap">
                                            <h3><a href="speakers-single.html">{{$event['title']}}</a></h3>
                                            <div class="meta">
                                                <div class="organizers">
                                                    <a href="#">{{$event['description']}}</a>
                                                </div>
                                                <div class="time">
                                                    <span>{{$event['event_date'][3]." ".$event['event_date'][4]}}</span>
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
                                @foreach($past_events as $event)
                                <tr class="inner-box">
                                    <th scope="row">
                                        <div class="event-date">
                                            <span>{{$event['event_date'][0]}}</span>
                                            <p>{{$event['event_date'][1]}}</p>
                                            <p>{{$event['event_date'][2]}}</p>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="event-img">
                                            <img class="img-fluid" src="{{('frontend/img/team/creativity.png')}}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="event-wrap">
                                            <h3><a href="speakers-single.html">{{$event['title']}}</a></h3>
                                            <div class="meta">
                                                <div class="organizers">
                                                    <a href="#">{{$event['description']}}</a>
                                                </div>
                                                <div class="time">
                                                    <span>{{$event['event_date'][3]." ".$event['event_date'][4]}}</span>
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
                                            <a class="btn-primary" href="{{url('participants',$event['id'])}}">View</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="primary-btn text-center">
                    <a href="#" class="btn-primary">Download Schedule</a>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Event Schedule Area End Here-->

<!--Whos Speaking Area Start Here-->
<div class="whos-speaking-area pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text mb50">
                        <h2>Who's Speaking?</h2>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /.row  end-->
        <div class="row mb50">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12  cards-flex">
                <div class="speakers xs-mb30">
                    <div class="spk-img">
                        <img class="img-fluid" src="{{('frontend/img/team/1.jpg')}}" alt="trainer-img">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-life-ring"></i></a></li>
                        </ul>
                    </div>
                    <div class="spk-info">
                        <a href="speakers-single.html">
                            <h3>Harman Kardon</h3>
                        </a>
                        <p>CEO,Mockplus</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12  cards-flex">
                <div class="speakers xs-mb30">
                    <div class="spk-img">
                        <img class="img-fluid" src="{{('frontend/img/team/2.jpg')}}" alt="trainer-img">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-life-ring"></i></a></li>
                        </ul>
                    </div>
                    <div class="spk-info">
                        <a href="speakers-single.html">
                            <h3>Toni Duggan</h3>
                        </a>
                        <p>GM, Pixelperfect</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12  cards-flex">
                <div class="speakers xs-mb30">
                    <div class="spk-img">
                        <img class="img-fluid" src="{{('frontend/img/team/3.jpg')}}" alt="trainer-img">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-life-ring"></i></a></li>
                        </ul>
                    </div>
                    <div class="spk-info">
                        <a href="speakers-single.html">
                            <h3>Philipp Lahm</h3>
                        </a>
                        <p>Digital photography</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 d-md-none d-lg-block col-sm-12  cards-flex">
                <div class="speakers">
                    <div class="spk-img">
                        <img class="img-fluid" src="{{('frontend/img/team/4.jpg')}}" alt="trainer-img">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-life-ring"></i></a></li>
                        </ul>
                    </div>
                    <div class="spk-info">
                        <a href="speakers-single.html">
                            <h3>Lieke Martens</h3>
                        </a>
                        <p>CEO, Animation Studios</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
        <div class="row">
            <div class="offset-2 no-gutter"></div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12  cards-flex">
                <div class="speakers xs-mb30">
                    <div class="spk-img">
                        <img class="img-fluid" src="{{('frontend/img/team/5.jpg')}}" alt="trainer-img">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-life-ring"></i></a></li>
                        </ul>
                    </div>
                    <div class="spk-info">
                        <a href="speakers-single.html">
                            <h3>Fara Williams</h3>
                        </a>
                        <p>Designer, Treehouse</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12  cards-flex">
                <div class="speakers xs-mb30">
                    <div class="spk-img">
                        <img class="img-fluid" src="{{('frontend/img/team/6.jpg')}}" alt="trainer-img">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-life-ring"></i></a></li>
                        </ul>
                    </div>
                    <div class="spk-info">
                        <a href="speakers-single.html">
                            <h3>Manuel Neuer</h3>
                        </a>
                        <p>CEO, Spingboard</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12  cards-flex">
                <div class="speakers">
                    <div class="spk-img">
                        <img class="img-fluid" src="{{('frontend/img/team/7.jpg')}}" alt="trainer-img">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-life-ring"></i></a></li>
                        </ul>
                    </div>
                    <div class="spk-info">
                        <a href="speakers-single.html">
                            <h3>Lieke Martens</h3>
                        </a>
                        <p>Digital photography</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Whos Speaking Area End Here-->

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

<!--Pricing Tables Area Start Here-->
<div class="pricing-tables-area pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text mb50">
                        <h2>Pricing Tables</h2>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="pricing-box bg-pricing xs-mb30">
                    <div class="pricing-header">
                        <div class="pricing-value">
                            <span>$</span> 55
                        </div>
                    </div>
                    <div class="pricing-title">Personal</div>
                    <div class="pricing-content">
                        <ul>
                            <li>1. Entrance</li>
                            <li>2. Coffee Break referrentur</li>
                            <li>3 One FREE bonus theme</li>
                            <li>4. Free Lunch & Snacks.</li>
                            <li>5. Certificate, Plugins & ebook</li>
                        </ul>
                    </div>
                    <div class="bordered-btn">
                        <a href="#">Buy Ticket</a>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="pricing-box bg-pricing xs-mb30">
                    <div class="pricing-header">
                        <div class="pricing-value">
                            <span>$</span> 75
                        </div>
                    </div>
                    <div class="pricing-title">Business</div>
                    <div class="pricing-content">
                        <ul>
                            <li>1. Entrance</li>
                            <li>2. Coffee Break referrentur</li>
                            <li>3 One FREE bonus theme</li>
                            <li>4. Free Lunch & Snacks.</li>
                            <li>5. Certificate, Plugins & ebook</li>
                        </ul>
                    </div>
                    <div class="bordered-btn">
                        <a href="#">Buy Ticket</a>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="pricing-box bg-pricing">
                    <div class="pricing-header">
                        <div class="pricing-value">
                            <span>$</span> 99
                        </div>
                    </div>
                    <div class="pricing-title">Premium</div>
                    <div class="pricing-content">
                        <ul>
                            <li>1. Entrance</li>
                            <li>2. Coffee Break referrentur</li>
                            <li>3 One FREE bonus theme</li>
                            <li>4. Free Lunch & Snacks.</li>
                            <li>5. Certificate, Plugins & ebook</li>
                        </ul>
                    </div>
                    <div class="bordered-btn">
                        <a href="#">Buy Ticket</a>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Pricing Tables Area End Here-->

<!--Counter Up Area Start Here-->
<div class="counter-up-area pad100 bg-counter parallax">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3">
                <div class="single-counter xs-mb40">
                    <div class="count-content">
                        <span class="count">80</span>
                        <p>Countries</p>
                    </div>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3">
                <div class="single-counter xs-mb40">
                    <div class="count-content">
                        <span class="count">120</span>
                        <p>Programs</p>
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

<!--Our Blog Area Start Here-->
<div class="our-blog-area  pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-blog">
                    <div class="single-blog xs-mb30">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{('frontend/img/blog/1.jpg')}}" alt="">
                        </div>
                        <div class="blog-content">
                            <a href="blog-single.html">
                                <h3>Events with intelligence.</h3>
                            </a>
                            <p>Ne sententiae constituam eam. Paulo omnes oblique sea ea, inani persius sea, ei exerci laudem recusabo eos.</p>
                            <div class="date">
                                <ul>
                                    <li>
                                        11 Nov 2017
                                        <span class="float-right"><i class="fa fa-share-alt"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single-blog xs-mb30">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{('frontend/img/blog/2.jpg')}}" alt="">
                        </div>
                        <div class="blog-content">
                            <a href="blog-single.html">
                                <h3>Fresh ideas for your event.</h3>
                            </a>
                            <p>Ne sententiae constituam eam. Paulo omnes oblique sea ea, inani persius sea, ei exerci laudem recusabo eos.</p>
                            <div class="date">
                                <ul>
                                    <li>
                                        11 Nov 2017
                                        <span class="float-right"><i class="fa fa-share-alt"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single-blog">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{('frontend/img/blog/3.jpg')}}" alt="">
                        </div>
                        <div class="blog-content">
                            <a href="blog-single.html">
                                <h3>We take your fun seriously.</h3>
                            </a>
                            <p>Ne sententiae constituam eam. Paulo omnes oblique sea ea, inani persius sea, ei exerci laudem recusabo eos.</p>
                            <div class="date">
                                <ul>
                                    <li>
                                        11 Nov 2017
                                        <span class="float-right"><i class="fa fa-share-alt"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Our Blog Area End Here-->

<!--Contact Us Area Start Here-->
<div class="contact-us-area-two pad-top100 bg-contact parallax no-attm">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text mb50">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
        <div class="row">
            <div class="col-lg-4 pr-0">
                <div class="inner-box">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-12 mb50">
                                <input class="form-control" type="text" placeholder="Name" required>
                            </div>
                            <div class="col-lg-12 mb50">
                                <input class="form-control" type="email" placeholder="Email" required>
                            </div>
                            <div class="col-lg-12 mb50">
                                <input class="form-control" type="text" placeholder="Subject" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea class="form-control" name="massage" placeholder="Massage"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /col end-->
            <div class="col-lg-8 pl-0">
                <!--Google Map Start Here-->
                <div class="gmap">
                    <div id="googlemap"></div>
                </div>
                <!--Google Map End Here-->
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Contact Us Area End Here-->

@endsection

