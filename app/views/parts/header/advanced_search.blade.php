<div class="advanced-search">

    <div class="left-search">

        @if(! $authUser)
        <div class="upper-section">
            <div class="register">{{ trans('titles.short_login') }}</div>
        </div>
        <div class="register-form">
            <form role="form" action="{{ URL::route('login') }}" method="POST">
                <div class="form-row">
                    <label for="input-email">{{ trans('form.login.email') }}</label>
                    <input type="email" class="form-control" name="Login[email]" id="input-email" placeholder="{{ trans('form.login.email') }}">
                </div>
                <div class="form-row">
                    <label for="input-password">{{ trans('form.login.password') }}</label>
                    <input type="password" class="form-control" name="Login[password]" id="input-password" placeholder="{{ trans('form.login.password') }}">
                </div>
                <div class="buttons">
                    <button type="submit" class="blue-btn">{{ trans('form.login.submit') }}</button>
                    <button type="button" onclick="window.location.href = '{{ URL::page('register/show') }}'" class="blue-btn big-btn">{{ trans('words.new_user') }}</button>
                </div>

                @if(! $errors->isEmpty())
                <div class="errors">
                    {{ implode($errors->all(':message'), '<br/>') }}
                </div>
                @else
<!--                <a href="#">لإسترجاع كلمة السر</a>-->
                @endif
            </form>
        </div>
        @else

        <div class="welcome-message">

            {{ trans('words.welcome') }} {{ $authUser->name }}

            <a href="{{ URL::route('logout') }}">{{ trans('words.logout') }}</a>
        </div>
        @endif
    </div>


    <div class="separator"></div>


    <h3 class="search-link"><a href="#">{{ trans('titles.search_estates') }}</a></h3>

    <div class="right-search">

        <form action="{{ URL::page('search') }}" method="GET">
            <div class="upper-section">

                <div class="offer-image">
                    <img src="{{ URL::asset('app/img/{lan}/offer-image.png') }}" class="img-responsive" alt=""/>
                </div>

                <div class="upper-form">

                    <h3>{{ trans('titles.search_estates') }}</h3>

                    <select name="search_order" class="form-control" select-value='{{ Input::get('search_order', 'order_new') }}'>
                        <option value="order_new">{{ trans('form.search.order_new') }}</option>
                        <option value="order_old">{{ trans('form.search.order_old') }}</option>
                        <option value="have_image">{{ trans('form.search.have_image') }}</option>
                        <option value="highest_price">{{ trans('form.search.highest_price') }}</option>
                        <option value="lowest_price">{{ trans('form.search.lowest_price') }}</option>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="lower-section">
                <div class="row">
                    <div class="left">
                        <label for="search-in2">{{ trans('form.search.area') }}</label>
                        <div class="two-inputs form-inputs">
                            <input name="search_area_low" value="{{ Input::get('search_area_low') }}" type="text" id="search-in2" class="form-control" placeholder="{{ trans('form.search.from') }}"/>
                            <input name="search_area_high" value="{{ Input::get('search_area_high') }}" type="text" class="form-control" placeholder="{{ trans('form.search.to') }}"/>
                        </div>
                    </div>
                    <div class="right">
                        <label for="search-in1">{{ trans('form.search.category') }}</label>
                        <div class="form-inputs">

                            <select name="search_category" id="category-input" class="form-control">
                                <option value="">{{ trans('form.search.choose_category') }}</option>

                                @foreach($estateCategories as $category)

                                @if($category->children->isEmpty())

                                    @if(Input::get('search_category') == $category->id)
                                    <option value="{{ $category->id }}" selected="selected">{{ $category->title }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endif

                                @else
                                <optgroup label="{{ $category->title }}">

                                    @foreach($category->children as $childCategory)

                                        @if(Input::get('search_category') == $childCategory->id)
                                        <option value="{{ $childCategory->id }}" selected="selected">{{ $childCategory->title }}</option>
                                        @else
                                        <option value="{{ $childCategory->id }}">{{ $childCategory->title }}</option>
                                        @endif

                                    @endforeach

                                </optgroup>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="left">
                        <label for="search-in2">{{ trans('form.search.price') }}</label>
                        <div class="two-inputs form-inputs">
                            <input name="search_price_low" value="{{ Input::get('search_price_low') }}" type="text" id="search-in2" class="form-control" placeholder="{{ trans('form.search.from') }}"/>
                            <input name="search_price_high" value="{{ Input::get('search_price_high') }}" type="text" class="form-control" placeholder="{{ trans('form.search.to') }}"/>
                        </div>
                    </div>
                    <div class="right">
                        <label for="search-in2">{{ trans('form.search.province') }}</label>
                        <div class="form-inputs">
                            <select id="search-in1" name="search_province" class="form-control">
                                <option value="">{{ trans('form.search.choose_province') }}</option>
                                @foreach($provinces as $province)
                                @if(Input::get('search_province') == $province->id)
                                <option value="{{ $province->id }}" selected="selected">{{ $province->name }}</option>
                                @else
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
<!--                    <div class="left">-->
<!--                        <label for="search-in1">{{ trans('form.search.city') }}</label>-->
<!--                        <div class="form-inputs">-->
<!--                            <input name="search_city" value="{{ Input::get('search_city') }}" type="text" id="search-in2" class="form-control"/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="right">-->
<!--                        <label for="search-in1">{{ trans('form.search.region') }}</label>-->
<!--                        <div class="form-inputs">-->
<!--                            <input name="search_region" value="{{ Input::get('search_region') }}" type="text" id="search-in2" class="form-control"/>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>

                <div class="clearfix"></div>

                <div class="buttons">
                    <button class="btn-search" type="submit"></button>
                </div>
            </div>
        </form>
    </div>
</div>