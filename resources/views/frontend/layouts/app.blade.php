<!DOCTYPE html>
<html lang="en">

<head>

    @include('frontend.layouts.head')

</head>

<body>
<!--Preloder-->
<div class='loader'>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--text'></div>
</div>
<!--Main Container Start Here-->
<div class="main-container">

@include('frontend.layouts.header')

@section('main-content')
@show

@include('frontend.layouts.footer')

</div>
<!--Main Container End Here-->

@include('frontend.layouts.script')

</body>

</html>
