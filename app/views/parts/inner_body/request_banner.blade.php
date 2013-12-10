<div class="main-title" id="login-form-title">
    <a href="#login-form-title">{{ trans('titles.request_banner') }}</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('banner-request') }}" method="POST">
    <div class="form-group">
        <label for="text2">{{ trans('form.banner.area') }}</label>
        <select name="BannerRequest[banner_place_id]" class="form-control" id="text2">
            @foreach($bannerPlaces as $bannerPlace)
            @if($bannerPlace->isSize(Input::get('size')))
            <option value="{{ $bannerPlace->id }}" selected="selected">{{ $bannerPlace->size }}</option>
            @else
            <option value="{{ $bannerPlace->id }}">{{ $bannerPlace->size }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="text">{{ trans('form.banner.description') }}</label>
        <textarea class="form-control" name="BannerRequest[description]" cols="30" rows="10"></textarea>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">{{ trans('form.banner.submit') }}</button>
    </div>
</form>