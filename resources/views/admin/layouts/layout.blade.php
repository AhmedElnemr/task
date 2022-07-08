<!doctype html>
<html lang="en" style="direction: rtl;">

<head>

    <meta charset="utf-8" />
    <title>الرئيسية - @yield('page-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Nami tec" name="description" />
    <meta content="mostafa ahmed elraw" name="author" />
    <!-- App favicon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{get_file($settings->header_logo)}}" />
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('86d028d1643e6c8460da', {
            cluster: 'eu'
        });

    </script>
    @include('admin.layouts.assets._css')
    <link href="{{asset('admin/css/font-awesome.min.css')}}" >

    @stack('css-push')
    @yield('styles')

    @include('admin.layouts.loader.loaderCss')
</head>

<body data-topbar="dark" >
  @include('admin.layouts.loader.loaderHtml')
<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    @if (\Route::currentRouteName() == "admin.login")

        @yield('content')

    @else

        @include('admin.layouts.inc._header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.inc._navbar')
        <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">@yield('page-title')</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                                            @yield('newLinks')
                                            <li class="breadcrumb-item active">@yield('page-title')</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @yield('content')
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <!-- Footer start -->
            @include('admin.layouts.inc._footer')
            <!-- Footer end -->


            </div>
            <!-- end main content-->
    @endif


</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->

<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->

<div class="modal fade" id="profileEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات الملف الشخصى</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="profileEdit-addOrDelete">

            </div>
            <div class="modal-footer text-center d-flex justify-content-center">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
                <button id="profileEditSave"  form="EditForm" type="submit" class="btn btn-success">
                    حفظ
                    &nbsp;
                    <i class="fa fa-save"></i>
                </button>
            </div>
        </div>
    </div>
</div>


@include('admin.layouts.assets._js')

@yield('js')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //-------------------- update profile -----------------------------------

</script>

<script>
    $.validate({
        ignore: 'input[type=hidden]',
        lang:"ar",
    });
</script>

<script>
    @isset(admin()->user()->id)

    $(document).on('click','.editProfile',function (e) {
        e.preventDefault()
        var id = $(this).attr('id');

        var url = '{{route('profileControl.edit',admin()->user()->id)}}';

        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(){
                $('.loader-ajax').show()
            },
            success: function(data){
                 $('.loader-ajax').hide()
                $('#profileEdit-addOrDelete').html(data.html);
                $('#profileEdit').modal('show')
                $('#logoOfAdmin').dropify();
                $.validate({
                    ignore: 'input[type=hidden]',
                    lang:"ar",
                });

            },
            error: function(data) {
                $('.loader-ajax').hide()
                $('#profileEdit-addOrDelete').html('<h3 class="text-center">لا تملك الصلاحية</h3>')
            }
        });

    });


    $(document).on('submit','form#EditForm',function(e) {
        e.preventDefault();
        var myForm = $("#EditForm")[0]
        var formData = new FormData(myForm)
        var url = $('#EditForm').attr('action');
        $.ajax({
            url:url,
            type: 'POST',
            data: formData,
            beforeSend: function(){
                $('.loader-ajax').show()
            },
            complete: function(){


            },
            success: function (data) {
                $('.loader-ajax').hide()
                $('#profileEdit').modal('hide')
                $(".useImageEdit").attr("src",data.logo);
                $(".nameEdit").html(data.name);
                cuteToast({
                    type: "success", // or 'info', 'error', 'warning'
                    message:"تم تعديل بيانات الملف الشخصى",
                    timer: 3000
                });
            },
            error: function (data) {
                $('.loader-ajax').hide()
                if (data.status === 500) {
                    $('#profileEdit').modal("hide");

                }
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                cuteToast({
                                    type: "error", // or 'info', 'error', 'warning'
                                    message:value,
                                    timer: 3000
                                });

                            });

                        } else {

                        }
                    });
                }
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });

    @endisset
</script>

</body>

</html>
