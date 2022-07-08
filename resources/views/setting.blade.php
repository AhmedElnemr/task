<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{setting()->ar_title}} </title>
    <!-- icon -->
    <link rel="icon" href="{{get_file(setting()->header_logo)}}" type="image/x-icon" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('website')}}/css/bootstrap-rtl.css" />
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('website')}}/css/mdb.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('website')}}/css/all.css" />
    <!-- swiper -->
    <link rel="stylesheet" href="{{asset('website')}}/css/swiper.css" />
    <!-- animate -->
    <link rel="stylesheet" href="{{asset('website')}}/css/aos.css" />
    <link rel="stylesheet" href="{{asset('website')}}/css/datatables2.min.css" />
    <!-- Custom style  -->
    <link rel="stylesheet" href="{{asset('website')}}/css/style.css" />
    <!-- fonts  -->
    <link href="{{asset('website')}}/https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet" />
    <style>
        .container {
            background-color: rgb(255, 255, 255);
            padding: 60px;
            border-radius: 30px;
        }
        h5 {
            font-weight: bold;
            margin-bottom: 30px;
        }
    </style>
</head>

<body style="background-image: url({{asset('website')}}/img/pattern.jpg);
    background-attachment: fixed;
    background-size: cover;">
<!--////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////   nav-bar   /////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////-->

<div class="logo">
    <div class="image py-5">
        <img src="{{get_file(setting()->header_logo)}}" alt="" style="width:120px;height:120px">
    </div>

</div>




<div class="terms">
    <div class="container w-lg-75 z-depth-2">
        <div class="links">
            <h3>إتفاقية وشروط إستخدام موقع <span> {{setting()->ar_title}} </span></h3>
            <ul class="padl-15">
                <li><a href="#1"> -  عن التطبيق</a></li>
                <li><a href="#2"> - الشروط و الأحكام</a></li>
{{--                <li><a href="#3"> -  سياسة الخصوصية</a></li>--}}


            </ul>
        </div>

        <div class="heading-para">
            <h5 id="1">(1) عن التطبيق :</h5>
            <p class="1">
                {!! setting()->ar_about_app !!}
            </p>

            <h5 id="2">(2) الشروط و الأحكام :</h5>
            <p class="1 "> {!! setting()->ar_terms_condition !!}</p>
{{--            <h5 id="3">(3) سياسة الخصوصية :</h5>--}}
{{--            <p class="1">{!! setting()->ar_privacy_policy !!}</p>--}}

        </div>
    </div>
</div>

<!--////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////JavaScript/////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////-->
<script src="{{asset('website')}}/js/jquery-3.4.1.min.js"></script>
<script src="{{asset('website')}}/js/popper.min.js"></script>
<script src="{{asset('website')}}/js/bootstrap.min.js"></script>
<script src="{{asset('website')}}/js/mdb.min.js"></script>
<script src="{{asset('website')}}/js/smooth-scroll.min.js"></script>
<script src="{{asset('website')}}/js/swiper.js"></script>
<script src="{{asset('website')}}/js/aos.js"></script>
<script src="{{asset('website')}}/js/datatables2.min.js"></script>
<script src="{{asset('website')}}/js/Custom.js"></script>
<script>
    // $("#Header").load("Header.html");
</script>
</body>

</html>


