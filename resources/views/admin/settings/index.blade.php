@extends('admin.layouts.layout')
@section('styles')
    <!-- include summernote css/js -->
    <link href="summernote-bs5.css" rel="stylesheet">
    {{--    <link href="{{asset('dashboard/summernote/summernote-bs4.css')}}">--}}
    <style>
        .dropify-font-upload:before,
        .dropify-wrapper .dropify-message span.file-icon:before {
            content: "\f382";
            font-weight: 100;
            color: #000;
            font-size: 26px;
        }

        .dropify-wrapper .dropify-message p {
            text-align: center;
            font-size: 15px;
        }

    </style>



@endsection

@section('page-title')
    الإعدادات العامة
@endsection


@section('content')
    <div class="checkout-tabs">
        <div class="row">
            <div class="col-xl-2 col-sm-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    {{----------------------------------}}
                    <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                        <i class= "bx bx-info-circle d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">المعلومات الرئيسية</p>
                    </a>

                    {{----------------------------------}}
                    <a class="nav-link" id="v-pills-confir-t" data-bs-toggle="pill" href="#v-pills-conf" role="tab" aria-controls="v-pills-conf" aria-selected="false">
                        <i class= "bx bx-image-alt d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">اللوجو</p>
                    </a>

                    {{----------------------------------}}
                    <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                        <i class= "bx bx-image d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">معلومات التواصل</p>
                    </a>
                    {{----------------------------------}}
                    <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                        <i class= "bx bxs-layout d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">مواقع التواصل الإجتماعى</p>
                    </a>
                    {{----------------------------------}}
                    <a class="nav-link" id="v-pills-confir-ta" data-bs-toggle="pill" href="#v-pills-confi" role="tab" aria-controls="v-pills-confi" aria-selected="false">
                        <i class= "bx bx-shield-quarter d-block check-nav-icon mt-1 mb-1"></i>
                        <p class="fw-bold mb-4">الشروط و الأحكام</p>
                    </a>
                    {{----------------------------------}}
                </div>
            </div>
            <div class="col-xl-10 col-sm-9">
                {{----------------------------------}}
                <div class="card">
                    <div class="card-body">

                        <form id="Form" method="post" action="{{route('settings.update',$settings->id)}}">
                            @csrf
                            @method('PUT')
                        <div class="tab-content" id="v-pills-tabContent">
                            {{----------------------------------}}

                            <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                <div>
                                    <h4 class="card-title">المعلومات الرئيسية</h4>
                                    <p class="card-title-desc">هذه الحقول مطلوبة</p>

                                    <div class="form-group row mb-4">
                                        <label for="ar_title" class="col-md-2 col-form-label">اسم التطبيق بالعربية</label>
                                        <div class="col-md-10">
                                            <input data-validation="required" name="ar_title" value="{{$settings->ar_title}}" type="text" class="form-control" id="ar_title" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="en_title" class="col-md-2 col-form-label">اسم التطبيق بالإنجليزية</label>
                                        <div class="col-md-10">
                                            <input data-validation="required" name="en_title"  value="{{$settings->en_title}}" type="text" class="form-control" id="en_title" placeholder="">
                                        </div>
                                    </div>




                                    <div class="form-group row mb-4">
                                        <label for="ar_desc" class="col-md-2 col-form-label">الوصف بالعربية</label>
                                        <div class="col-md-10">
                                            <textarea data-validation="required" class="form-control" name="ar_desc" id="ar_desc" rows="3" placeholder="">{{$settings->ar_desc}}</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="en_desc" class="col-md-2 col-form-label">الوصف بالإنجليزية</label>
                                        <div class="col-md-10">
                                            <textarea data-validation="required" class="form-control" name="en_desc" id="en_desc" rows="3" placeholder="">{{$settings->en_desc}}</textarea>
                                        </div>
                                    </div>

{{--                                    </form>--}}
                                </div>
                            </div>


                            {{----------------------------------}}

                            <div class="tab-pane fade" id="v-pills-conf" role="tabpanel" aria-labelledby="v-pills-confir-t">
                                <div>

                                    <h4 class="card-title">اللوجو</h4>
                                    <p class="card-title-desc">هذه الحقول مطلوبة</p>


                                    <div class="form-group row mb-4">
                                        <label for="header_logo" class="col-md-2 col-form-label"> اللوجو (الرئيسى)</label>
                                        <div class="col-md-10">
                                            <input type="file" data-default-file="{{get_file($settings->header_logo)}}" class="form-control dropify" id="header_logo" name="header_logo" placeholder="اللوجو">

                                        </div>
                                    </div>



                                    <div class="form-group row mb-4">
                                        <label for="footer_logo" class="col-md-2 col-form-label">اللوجو (الإضافى)</label>
                                        <div class="col-md-10">
                                            <input  type="file" data-default-file="{{get_file($settings->footer_logo)}}" class="form-control dropify" id="footer_logo" name="footer_logo" placeholder=" لوجو آخر">

                                        </div>
                                    </div>



                                </div>
                            </div>


                            {{----------------------------------}}

                            <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                <div>

                                    <h4 class="card-title">معلومات التواصل</h4>
                                    <p class="card-title-desc">هذه الحقول مطلوبة</p>


                                    <div class="form-group row mb-4">
                                        <label for="email1" class="col-md-2 col-form-label">البريد الإلكترونى  (الرئيسى)</label>
                                        <div class="col-md-10">
                                            <input data-validation="required,email" name="email1" type="email" value="{{$settings->email1}}" class="form-control" id="email1" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="email2" class="col-md-2 col-form-label">البريد الإلكترونى  (الإضافى)</label>
                                        <div class="col-md-10">
                                            <input data-validation="required,email" name="email2"  type="email" value="{{$settings->email2}}" class="form-control" id="email2" placeholder="">
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="phone1" class="col-md-2 col-form-label">رقم الجوال  (الرئيسى)</label>
                                        <div class="col-md-10">
                                            <input data-validation="required" name="phone1" type="tel" value="{{$settings->phone1}}" class="form-control" id="phone1" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="email2" class="col-md-2 col-form-label">رقم الجوال (الإضافى)</label>
                                        <div class="col-md-10">
                                            <input data-validation="required" name="phone2"  type="tel" value="{{$settings->phone2}}" class="form-control" id="phone2" placeholder="">
                                        </div>
                                    </div>


                                </div>
                            </div>

                            {{----------------------------------}}

                            <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                <div>

                                    <h4 class="card-title">مواقع التواصل الإجتماعى</h4>
                                    <p class="card-title-desc">هذه الحقول مطلوبة</p>



                                    <div class="form-group row mb-4">
                                        <label for="facebook" class="col-md-2 col-form-label">رابط الفيس بوك</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" value="{{$settings->facebook}}" class="form-control" id="facebook" name="facebook" placeholder="رابط الفيس بوك">

                                        </div>
                                    </div>



                                    <div class="form-group row mb-4">
                                        <label for="twitter" class="col-md-2 col-form-label">رابط التويتر</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" value="{{$settings->twitter}}" id="twitter" name="twitter" placeholder=" رابط التويتر">

                                        </div>
                                    </div>




                                    <div class="form-group row mb-4">
                                        <label for="instagram" class="col-md-2 col-form-label">رابط الانستجرام</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" value="{{$settings->instagram}}" id="instagram" name="instagram" placeholder=" رابط الانستجرام">

                                        </div>
                                    </div>



                                    <div class="form-group row mb-4">
                                        <label for="linkedin" class="col-md-2 col-form-label">رابط اللينكدان</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" value="{{$settings->linkedin}}" id="linkedin" name="linkedin" placeholder=" رابط اللينكدان">

                                        </div>
                                    </div>



                                    <div class="form-group row mb-4">
                                        <label for="telegram" class="col-md-2 col-form-label">رابط التليجرام</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" value="{{$settings->telegram}}"  id="telegram" name="telegram" placeholder=" رابط التليجرام">

                                        </div>
                                    </div>



                                    <div class="form-group row mb-4">
                                        <label for="youtube" class="col-md-2 col-form-label"> رابط اليوتيوب</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" id="youtube" value="{{$settings->youtube}}"  name="youtube" placeholder=" رابط اليوتيوب">

                                        </div>
                                    </div>



                                    <div class="form-group row mb-4">
                                        <label for="google_plus" class="col-md-2 col-form-label">رابط جوجل بلس</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" id="google_plus" value="{{$settings->google_plus}}" name="google_plus" placeholder=" رابط جوجل بلس">

                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="snapchat_ghost" class="col-md-2 col-form-label">رابط اسناب شات</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" id="snapchat_ghost" value="{{$settings->snapchat_ghost}}"  name="snapchat_ghost" placeholder=" رابط اسناب شات">

                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="whatsapp" class="col-md-2 col-form-label">رابط الوتس اب</label>
                                        <div class="col-md-10">

                                            <input data-validation="required" type="text" class="form-control" id="whatsapp"  value="{{$settings->whatsapp}}"  name="whatsapp" placeholder=" رابط الوتس اب">

                                        </div>
                                    </div>


                                </div>
                            </div>

                            {{----------------------------------}}

                            <div class="tab-pane fade" id="v-pills-confi" role="tabpanel" aria-labelledby="v-pills-confir-ta">
                                <div>

                                    <h4 class="card-title">الشروط و الأحكام</h4>
                                    <p class="card-title-desc">هذه الحقول مطلوبة</p>


                                    <div class="form-group row mb-4">
                                        <label for="ar_about_app" class="col-md-2 col-form-label">عن التطبيق بالعربية</label>
                                        <div class="col-md-10">
                                            <textarea data-validation="required" class="form-control  textEditor" name="ar_about_app" id="ar_about_app" rows="10" placeholder="">{{$settings->ar_about_app}}</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="en_about_app" class="col-md-2 col-form-label">عن التطبيق بالإنجليزية</label>
                                        <div class="col-md-10">
                                            <textarea data-validation="required" class="form-control textEditor" name="en_about_app" id="en_about_app" rows="5" placeholder="">{{$settings->en_about_app}}</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="ar_terms_condition" class="col-md-2 col-form-label">الشروط و الأحكام بالعربية</label>
                                        <div class="col-md-10">
                                            <textarea data-validation="required" class="form-control textEditor" name="ar_terms_condition" id="ar_terms_condition" rows="5" placeholder="">{{$settings->ar_terms_condition}}</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="en_terms_condition" class="col-md-2 col-form-label">الشروط و الأحكام بالإنجليزية</label>
                                        <div class="col-md-10">
                                            <textarea data-validation="required" class="form-control textEditor" name="en_terms_condition" id="en_terms_condition" rows="5" placeholder="">{{$settings->en_terms_condition}}</textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            {{----------------------------------}}
                        </div>
                        </form>

                    </div>
                </div>
                {{----------------------------------}}
                <div class="row mt-4">
                    <div class="col-sm-6">

                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="text-end">
                            <button form="Form" type="submit"  class="btn btn-success">
                                <i class="mdi mdi-content-save me-1"></i> حفظ
                            </button>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.0/tinymce.min.js" integrity="sha512-XQOOk3AOZDpVgRcau6q9Nx/1eL0ATVVQ+3FQMn3uhMqfIwphM9rY6twWuCo7M69rZPdowOwuYXXT+uOU91ktLw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.dropify').dropify();



        tinymce.init({ selector:'.textEditor',
            toolbar: 'language',
            directionality : 'rtl',
        });
    </script>

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
                    $('.loader-ajax').show()
                },
                complete: function(){


                },
                success: function (data) {
                    $('.loader-ajax').hide()
                    $(".logo_basic").attr("src",data.logo);
                    cuteToast({
                        type: "success", // or 'info', 'error', 'warning'
                        message:"تم تعديل الإعدادات العامة",
                        timer: 3000
                    });
                },
                error: function (data) {
                    $('.loader-ajax').hide()
                    if (data.status === 500) {
                        cuteToast({
                            type: "error", // or 'info', 'error', 'warning'
                            message:"يوجد خطأ ",
                            timer: 3000
                        });


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


    </script>

@endsection
