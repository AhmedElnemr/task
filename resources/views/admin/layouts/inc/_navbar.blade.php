<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->


            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">القائمة</li>

                {{--------  Home---------}}
                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">الرئيسية</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('settings.index')}}" class="waves-effect">
                        <i class="bx bx-wrench"></i>
                        <span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">الإعدادات العامة</span>
                    </a>
                </li>


                <li>
                    <a href="#" class="waves-effect editProfile">
                        <i class="bx bx-card"></i>
                        <span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">الملف الشخصى</span>
                    </a>
                </li>
                {{--------  مديرو الموقع---------}}



                <li>
                    <a href="{{route('admins.index')}}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">المشرفين</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('users.index')}}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">المستخدمين </span>
                    </a>
                </li>

                {{--<li>
                    <a href="{{route('contacts.index')}}" class="waves-effect">
                        <i class="bx bxs-contact"></i>
                        <span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">طلبات التواصل</span>
                    </a>
                </li>
--}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>



