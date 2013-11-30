<div class="main-title" id="login-form-title">
    <a href="#login-form-title">اتصل بنا</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('contact-us') }}" method="POST">
    <div class="form-group">
        <label for="text">عنوان الرسالة</label>
        <input class="form-control" type="text" id="text" name="ContactUs[subject]">
    </div>
    <div class="form-group">
        <label for="text">نص الرسالة</label>
        <textarea class="form-control" name="ContactUs[body]" cols="30" rows="10"></textarea>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">إرسال</button>
    </div>
</form>