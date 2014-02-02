<div class="main-title" id="register-form-title">
    <h1><a href="#register-form-title">{{ trans('titles.register') }}</a></h1>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('register') }}" method="POST">
    <div class="form-group">
        <label for="text">{{ trans('form.register.full_name') }}</label>
        <input class="form-control" type="text" id="text" name="Register[name]" value="{{ Input::old('Register.name') }}">
    </div>
    <div class="form-group">
        <label for="text">{{ trans('form.register.email') }}</label>
        <input class="form-control" type="text" id="text" name="Register[email]" value="{{ Input::old('Register.email') }}">
    </div>
    <div class="form-group">
        <label for="text">{{ trans('form.register.password') }}</label>
        <input class="form-control" type="password" id="text" name="Register[password]">
    </div>
    <div class="form-group">
        <label for="text">{{ trans('form.register.mobile') }}</label>
        <input class="form-control" type="text" id="text" name="Register[mobile_number]" value="{{ Input::old('Register.mobile_number') }}">
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-success">{{ trans('form.register.submit') }}</button>
    </div>
</form>