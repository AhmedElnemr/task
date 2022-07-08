@extends('admin.layouts.layout')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

@endsection

@section('page-title')
    معلومات عامة
@endsection

@section('page-links')
@endsection

@section('content')
    @include('admin.layouts.loader.loaderHtml')
    {{-------------------------}}

    <div class="row">

        {{-------------------------}}
        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">مرحبا مرة أخرى</h5>
                                <p>لوحة التحكم</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{asset('dashboard')}}/assets/images/profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="{{isset($settings->header_logo)?get_file($settings->header_logo):asset('39a6d186-91a6-477b-9a9b-217b49230b91.jpg')}}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-truncate">{{admin()->user()->name}}</h5>
                            <p class="text-muted mb-0 text-truncate">أدمن</p>
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">

                                <div class="row">
                                    <div class="col-12">
{{--                                        <h5 class="font-size-15">{{count($admins)}}</h5>--}}
                                        <p class="text-muted mb-0"><span class="badge bg-primary">متصل</span> </p>
                                    </div>

                                </div>
                                <div class="mt-4">
                                    <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm editProfile">مشاهدة الصفحة الشخصية <i class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-------------------------}}

        <div class="col-xl-8">
            <div class="row ">

                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">عدد المشرفين</p>
                                    <h4 class="mb-0">{{$admins}}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-user-pin font-size-24"></i>
                                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">عدد المستخدمين </p>
                                    <h4 class="mb-0">{{$users}}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-repost font-size-24"></i>
                                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-------------------------}}

    </div>

    {{-------------------------}}


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">تواريخ  تسجيل مستخدمين جدد </h4>

                    <div class="row">
                        <div id="calendar"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://washsquadsa.com/admin/plugins/calendar/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/ar.min.js" integrity="sha512-gVMzWflhCRdT4UPPUzNR9gCPtBZuc77GZxVx2CqSZyv0kEPIISiZEU0hk6Sb/LLSO87j4qXH/m9Iz373K+mufw==" crossorigin="anonymous"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#calendar').fullCalendar({
            defaultView: 'month',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            isRTL:true,
            locale: 'ar',
            lang: 'ar',
            editable: false,
            disableDragging: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            events:'{{route('admin.calender')}}',
            eventRender: function( event, element, view ) {
                var  sup =  element.find('.fc-content')
                var  con = sup.closest('span');
                var day_title = 'مستخدمين ' ;

                sup.html( day_title +"<br>"+ event.title +" <br> <br>" +`<button style="display: none" id="${event.ids}" class="click_me btn btn-outline-danger text-white">تفاصيل</button>`);
                //event.title
            }
        });//calender object

        $(document).on('click','.click_me',function (e) {
            e.preventDefault()
            alert($(this).attr('id'))
        })
    </script>


@endsection
