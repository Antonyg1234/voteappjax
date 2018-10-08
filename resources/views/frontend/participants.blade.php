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

    <!--Whos Speaking Area Start Here-->
    <div class="whos-speaking-area speakers  pad100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <div class="title-text mb50">
                            <h2>All Participants</h2>
                            <br><br>
                            @if ( session()->has('success') )
                                <div class="alert alert-success">{{ session()->get('success') }}</div>
                            @endif
                            @php $today = \Carbon\Carbon::now();
                            @endphp
                            @if($event['voting_end_date']['smaller'])
                                <button class="sub-btn btn-primary">
                                    <a href="{{url('participants/result',$event['id'])}}">View Event Result</a>
                                </button>
                            @elseif((application_date_format($today) == application_date_format($event['event_date'])) || application_date_format($today) < application_date_format($event['voting_start_date']))
                                <p>Voting start date is {{application_date_format($event['voting_start_date'])}}</p>
                            @else
                                <p>Last date for voting is {{application_date_format($event['voting_end_date']['date'])}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /col end-->
            </div>
            <!-- /.row  end-->
            <div class="row mb50">
                @foreach($participant_teams as $index => $team)
                    @if($team['assets'])
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 participants-cards">
                            <div class="speakers xs-mb30">
                                <div class="">
                                    @foreach($team['assets'] as $key => $asset)
                                            @if($asset['asset_type'] == 'image')
                                                @if($key ==0)
                                                <a href="{{$asset['assets']}}" data-lightbox="display{{$index}}">
                                                    <img class="img-fluid" src="{{$asset['assets']}}" alt="trainer-img">
                                                </a>
                                                @else
                                                <a href="{{$asset['assets']}}" data-lightbox="display{{$index}}" style="display:none">
                                                    <img class="img-fluid" src="{{$asset['assets']}}" alt="trainer-img">
                                                </a>
                                                @endif
                                            @else
                                                <iframe width="250" height="180" src="{{$asset['assets']}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                                                </iframe>
                                            @endif
                                    @endforeach
                                    {{--<ul>--}}
                                        {{--<li><a href="#" style="color:red">Click</a></li>--}}
                                        {{--<li><a href="#" style="color:red">To</a></li>--}}
                                        {{--<li><a href="#" style="margin-left: 15px;font-size: 20px;color:red">Vote</a></li>--}}
                                    {{--</ul>--}}
                                </div>
                                @php
                                    $today = \Carbon\Carbon::now()->format('Y-m-d h:i:s');
                                @endphp
                                <div class="spk-info">
                                    <h3 style="font-size: 15px"><a href="{{url('participants/details',$team['id'])}}">{{$team['team_name']}}</a></h3>
                                    <p>Contact Person : {{$team['contact_person']}}</p>
                                    @if(($today >= $event['voting_start_date'] && $today <= $event['voting_end_date']['date']))
                                        <button class="sub-btn btn-primary">
                                            <a href="{{url('vote',$team['id'])}}">Vote</a>
                                        </button>
                                    @endif
                                </div>
                                <div style="display: none">
                                    @foreach($team['assets'] as $asset)
                                        <a href="#">{{$asset['assets']}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @if(!($teamassets))
                    <h6 class="text-center">Sorry, No content to display.</h6>
            @endif
            <!-- /row end-->
        </div>
        <!-- /container end-->
    </div>

@endsection