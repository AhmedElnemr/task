<form action="{{route('users.update',$user->id)}}" method="post" id="Form">
    @csrf
    @method('PUT')

    {{--form--}}
    <div class="row ">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="username"> الاسم</label>
                <input data-validation="required" type="text" class="form-control" value="{{$user->username}}"
                       id="username" name="username"
                       placeholder="الاسم">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="phone_number"> رقم الجوال </label>
                <input data-validation="required" type="text" class="form-control" value="{{$user->phone_number}}"
                       id="phone_number" name="phone_number"
                       placeholder=" رقم الجوال ">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="password">  كلمة المرور جديد   </label>
                <input type="text" class="form-control" value=""
                       id="password" name="password"
                       placeholder=" كلمة المرور">
            </div>
        </div>


    </div>
    {{--form--}}
</form>


