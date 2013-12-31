<div class="main-title-bright" id="login-form-title">
    <a href="#login-form-title">{{ trans('titles.change_password') }}</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('password.change', $userToken) }}" method="POST">
    <div class="form-group">
        <label for="text">{{ trans('form.login.password') }}</label>
        <input class="form-control" type="password" id="text" name="Retrieve[new_password]">
    </div>
    <div class="form-group">
        <label for="text">{{ trans('form.login.password_again') }}</label>
        <input class="form-control" type="password" id="text" name="Retrieve[new_password_again]">
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">{{ trans('form.login.submit_change') }}</button>
    </div>
</form>