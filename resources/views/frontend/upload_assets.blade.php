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




    <div class="ct-2 contact-area pad100">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-5">
                    <div class="section-title">
                        <div class="title-text pl">
                            <h2>Upload Content</h2>
                        </div>
                    </div>
                </div>
            </div>
            @if ( session()->has('failed') )
                <div class="alert alert-success text-center">{{ session()->get('failed') }}</div>
            @endif
            <div style="display: none;" id="success_message" class="alert alert-success"></div>
            <div style="display: none;" id="failed_message" class="alert alert-danger"></div>
            <!-- /col-->
            <div class="row justify-content-md-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8">
                    <div class="contact ct-form">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="contact-form">
                                    <form id="contact-form" enctype="multipart/form-data" data-toggle="validator" action="{{url('participants/uploadassets')}}" role="form" method="POST">
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
                                        <input type="hidden" name="event_p_email" id="event_p_email" value="{{session()->get('user_email')}}">

                                        <div class="form-group">

                                            <h6>Type*</h6>
                                            <br/>

                                            {{--<div class="radio">--}}
                                                <label class="radio-inline" style="margin-right: 100px"><input name="asset_type" type="radio" value="image"
                                                              id="asset_type"  data-id = "image_upload" checked> Image</label>

                                                <label class="radio-inline" ><input name="asset_type" data-id = "video_upload" value="video" type="radio"
                                                              id="asset_type"> Video</label>
                                            {{--</div>--}}
                                        </div>

                                        <div class="form-group " id="image_upload">
                                            <h6>{{ 'Choose Image*' }}</h6>
                                            <br/>
                                            <input id="images" type="file" accept="image/*" name="images[]" multiple class="form-control">
                                            {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
                                            <span>Note: Press Ctrl key to select multiple images.</span>
                                            <p id="images_error"></p>
                                        </div>
                                        <div class="form-group" id="video_upload" style="display: none;">
                                            <h6>{{ 'Enter Video Link*' }}</h6>
                                            <br/>
                                            https://www.youtube.com/<input id="video" type="text"  accept="video/*" name="video" placeholder="Enter YouTube Video Code" style="display: inline ; width:40%" class="text-center {{ $errors->has('video') ? 'alert alert-danger' : ''}} form-control">
                                            <br/><br/>
                                            <span>For example: https://www.youtube.com/watch?v=<mark>aBcdg7t9M4k</mark></span>
                                            <p id="video_error"></p>
                                        </div>
                                        {!! $errors->first('video', '<p class="help-block">:message</p>') !!}

                                        <div class="btn-2 text-center">
                                            <button class="btn-primary" id="upload" name="submit-form" type="submit">Upload</button>
                                        </div>
                                        <br/>
                                        @if($asset_count)
                                            <span>Note: Previously uploaded content will be deleted.</span>
                                        @endif
                                    </form>
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


@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $(':radio').change(function (e) {
                var id = $(this).data('id');
                if(id == "video_upload"){
                    $('#' + id).show();
                    $('#image_upload').hide();
                }else{
                    $('#' + id).show();
                    $('#video_upload').hide();
                }
            });

//            $("#upload").click(function(e){
//                var $fileUpload = $("#images");
//                if(parseInt($fileUpload.get(0).files.length) != 0){
//                    if (parseInt($fileUpload.get(0).files.length) > 4){
//                        alert("You can only upload a maximum of 4 files");
//                        e.preventDefault();
//                    }
//                }
//                else{
//                    alert("Please Upload files");
//                    e.preventDefault();
//                }
//            });

        });
    </script>

@endsection