<div class="main-title">
    <a href="#">التسجيل فى عامر جروب 2</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('register') }}" method="POST">
    <div class="form-group">
        <label for="text">الأسم بالكامل</label>
        <input class="form-control" type="text" id="text" name="UserInfo[name]">
    </div>
    <div class="form-group">
        <label for="text">الإيميل</label>
        <input class="form-control" type="text" id="text" name="User[email]">
    </div>
    <div class="form-group">
        <label for="text">كلمة المرور</label>
        <input class="form-control" type="password" id="text" name="User[password]">
    </div>
    <div class="form-group">
        <label for="text">رقم الموبيل</label>
        <input class="form-control" type="text" id="text" name="UserInfo[mobile_number]" >
    </div>
    <div class="form-group">
        <label for="text">رقم الهاتف</label>
        <input class="form-control" type="text" id="text" name="UserInfo[telephone_number]" >
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-success">التسجيل</button>
    </div>
</form>