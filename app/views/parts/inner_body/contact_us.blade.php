<div class="main-title" id="login-form-title">
    <a href="#login-form-title">{{ trans('titles.contact_us') }}</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('contact-us') }}" method="POST">
    <div class="form-group">
        <label for="text">{{ trans('form.contact_us.subject') }}</label>
        <input class="form-control" type="text" id="text" name="ContactUs[subject]">
    </div>
    <div class="form-group">
        <label for="text">{{ trans('form.contact_us.body') }}</label>
        <textarea class="form-control" name="ContactUs[body]" cols="30" rows="10"></textarea>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">{{ trans('form.contact_us.submit') }}</button>
    </div>
</form>