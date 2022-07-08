<form action="{{route('profileControl.update',$admin->id)}}" method="post" id="EditForm">
    @csrf
    @method("PUT")


    <div class="row">

        <div class="col-lg-6 col-sm-6 mb-4">
            <label class="label mb-2 "> الإسم بالكامل </label>
            <input type="text" name="name"  value="{{$admin->name}}" class="form-control" data-validation="required">
        </div>


        <div class="col-lg-6 col-sm-6 mb-4">
            <label class="label mb-2 ">البريد الإلكترونى </label>
            <input type="email" name="email" value="{{$admin->email}}" class="form-control" data-validation="required,email">
        </div>


        <div class="col-lg-6 col-sm-6 mb-4">
            <label class="label mb-2 ">كلمة المرور الجديدة </label>
            <input type="password" name="password" value="" class="form-control" >
        </div>



        <div class="col-lg-6 col-sm-4 mb-4">
            <label class="label mb-2 "> الصورة الشخصية </label>
            <input type="file" class="dropify" id="logoOfAdmin" name="image" data-default-file="{{get_file($admin->image)}}"/>
        </div>


    </div>


</form>
