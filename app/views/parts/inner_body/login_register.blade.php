<div class="main-title-bright" id="login-form-title">
    <a href="#login-form-title">الدخول لحسابك الشخصى</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('login') }}" method="POST">
    <div class="form-group">
        <label for="text">الإيميل</label>
        <input class="form-control" type="text" id="text" name="Login[email]">
    </div>
    <div class="form-group">
        <label for="text">كلمة المرور</label>
        <input class="form-control" type="password" id="text" name="Login[password]">
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">الدخول</button>
    </div>
</form>

<div class="separator"></div>
<div class="separator"></div>

<div class="main-title" id="register-form-title">
    <a href="#register-form-title">التسجيل فى عامر جروب 2</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('register') }}" method="POST">
    <div class="form-group">
        <label for="text">الأسم بالكامل</label>
        <input class="form-control" type="text" id="text" name="Register[name]" value="{{ Input::old('Register.name') }}">
    </div>
    <div class="form-group">
        <label for="text">الإيميل</label>
        <input class="form-control" type="text" id="text" name="Register[email]" value="{{ Input::old('Register.email') }}">
    </div>
    <div class="form-group">
        <label for="text">كلمة المرور</label>
        <input class="form-control" type="password" id="text" name="Register[password]">
    </div>
    <div class="form-group">
        <label for="text">رقم الموبيل</label>
        <input class="form-control" type="text" id="text" name="Register[mobile_number]" value="{{ Input::old('Register.mobile_number') }}">
    </div>
    <div class="form-group">
        <label for="text">رقم الهاتف</label>
        <input class="form-control" type="text" id="text" name="Register[telephone_number]" value="{{ Input::old('Register.telephone_number') }}">
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-success">التسجيل</button>
    </div>
</form>