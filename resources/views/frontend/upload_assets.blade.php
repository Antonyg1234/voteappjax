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
                            <p>{{$event['description']}}</p>
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
                            <h2>Upload Assets</h2>
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
                                    <form id="contact-form" data-toggle="validator" action="{{url('participants/uploadassets')}}" role="form" method="POST">
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

                                        <div class="form-group">

                                            <label for="asset_type" class="control-label">{{ 'asset_type' }}<span class="require">*</span></label>
                                            <div class="col-md-6">
                                                <input name="asset_type" type="radio"
                                                       id="asset_type"  data-id = "image_upload" checked>Image
                                                <input name="asset_type" data-id = "video_upload" type="radio"
                                                       id="asset_type">Video
                                                {!! $errors->first('asset_type', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group " id="image_upload">
                                            <label for="images" class="control-label">{{ 'Upload Image' }}</label>
                                            <input id="images" type="file" accept="image/*" name="images[]" multiple value="{!! old('images') !!}" class="{{ $errors->has('images') ? 'alert alert-danger' : ''}} form-control">
                                            <p id="images_error"></p>
                                        </div>
                                        <div class="form-group" id="video_upload" style="display: none;">
                                            <label for="video" class="control-label">{{ 'Upload Video Link' }}</label>
                                            <input id="video" type="text"  accept="video/*" name="video" value="{!! old('video') !!}" placeholder="Enter YouTube Url" class="{{ $errors->has('video') ? 'alert alert-danger' : ''}} form-control">
                                            <p id="video_error"></p>
                                        </div>
                                        <div class="btn-2 text-center">
                                            <button class="btn-primary" id="upload" name="submit-form" type="submit">Upload</button>
                                        </div>
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