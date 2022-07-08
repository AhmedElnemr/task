@extends('admin.layouts.layout')
@section('styles')

@endsection

@section('page-title')
   تسجيل الدخول
@endsection

@section('page-links')
@endsection

@section('content')

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">مرحبا بك مرة أخرى</h5>
                                        <p>سجل دخول من هنا </p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{asset('dashboard')}}/assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="{{route('admin.login')}}" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset('dashboard')}}/assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                    </div>
                                </a>

                                <a href="{{route('admin.login')}}" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset('dashboard')}}/assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" id="Form" method="post" action="{{route('admin.login.submit')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">البريد الالكترونى</label>
                                        <input data-validation="required,email" name="email" type="email" class="form-control" id="username" placeholder="البريد الإلكترونى">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">كلمة المرور</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input  data-validation="required" name="password" type="password" class="form-control" placeholder="كلمة المرور" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                           تذكرنى
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button id="submit_button" class="btn btn-primary waves-effect waves-light" type="submit">
                                            تسجيل الدخول
                                            &nbsp;
                                            &nbsp;
                                            <i class="fa fa-lock"> </i>
                                        </button>
                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

                        <div>
                            <p>© <script>document.write(new Date().getFullYear())</script> <a href="https://nami-tec.com">Nami</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <script>

        $(document).on('submit','form#Form',function(e) {
            e.preventDefault();
            var myForm = $("#Form")[0]
            var formData = new FormData(myForm)
            var url = $('#Form').attr('action');
            $.ajax({
                url:url,
                type: 'POST',
                data: formData,
                beforeSend: function(){
                    $('#submit_button').attr('disabled',true)
                    $('#submit_button').html(`  جارى التحميل ....<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>` )

                },
                complete: function(){

                },
                success: function (data) {

                    //$('#submit-button').prop('disabled', true);

                    window.setTimeout(function() {
                        cuteToast({
                            type: "success", // or 'info', 'error', 'warning'
                            message: "تم تسجيل الدخول بنجاح :)",
                            timer: 3000
                        })
                        $('#submit_button').html(`تسجيل الدخول&nbsp;   <i class="fa fa-lock"> </i>`)
                        window.location.href='{{route('admin.dashboard')}}';
                    }, 100);

                },
                error: function (data) {
                    $('#submit_button').html(`تسجيل الدخول&nbsp;  <i class="fa fa-lock"> </i>`)
                    $('#submit_button').attr('disabled',false)
                    cuteToast({
                        type: "error", // or 'info', 'error', 'warning'
                        message: "البريد الإلكترونى أو كلمة المرور غير متطابقتان",
                        timer: 3000
                    })

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });//end ajax


        });//end submit
    </script>


@endsection
