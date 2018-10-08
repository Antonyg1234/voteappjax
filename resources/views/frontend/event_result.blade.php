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

    <!--Pricing Tables Area Start Here-->
    <div class="pricing-tables-area pad100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <div class="title-text mb50">
                            <h2>Result</h2>
                        </div>
                    </div>
                </div>
                <!-- /col end-->
            </div>
            <!-- /row end-->
            <div class="row">
                @foreach($winners as $key => $winner)
                    <!--Speakers Single Area Start Here-->
                        <div class="speakers-single-area pad100">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-5 col-md-12">
                                        <div class="speakers-img">
                                            @foreach($winner['assets'] as $index =>$asset)
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
                                            <h1>{{$winner['team_name']}}</h1>
                                            <span>{{$winner['contact_person'].', '.implode(', ', array_column($winner['members'],'name'))}}</span>
                                            <p>{{$winner['title']}}</p>
                                            <p class="mb-0">{!! $winner['description'] !!}</p>
                                            @if($key == 0)
                                                <span class="month">Winner</span>
                                            @elseif($key == 1)
                                                <span class="month">1st Runners-Up</span>
                                            @else
                                                <span class="month">2nd Runners-up</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.col end-->
                                </div>
                                <!-- /.row end-->

                            </div>
                            <!-- /.container end-->
                        </div>
                @endforeach
                <!-- /col end-->

            </div>
            <!-- /row end-->
        </div>
        <!-- /container end-->
    </div>
    <!--Pricing Tables Area End Here-->

@endsection