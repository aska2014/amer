<div class="main-title-bright" id="login-form-title">
    <a href="#login-form-title">{{ trans('titles.forget_password') }}</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('password.retrieve') }}" method="POST">
    <div class="form-group">
        <label for="text">{{ trans('form.login.email') }}</label>
        <input class="form-control" type="text" id="text" name="Retrieve[email]">
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">{{ trans('form.login.submit_retrieve') }}</button>
    </div>
</form>