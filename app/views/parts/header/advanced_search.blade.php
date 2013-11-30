<div class="advanced-search">

    <div class="left-search">

        @if(! $authUser)
        <div class="upper-section">
            <div class="register">تسجيل</div>
        </div>
        <div class="register-form">
            <form role="form" action="{{ URL::route('login') }}" method="POST">
                <div class="form-row">
                    <label for="input-email">الإيميل</label>
                    <input type="email" class="form-control" name="Login[email]" id="input-email" placeholder="الإيميل">
                </div>
                <div class="form-row">
                    <label for="input-password">كلمة السر</label>
                    <input type="password" class="form-control" name="Login[password]" id="input-password" placeholder="كلمة المرور">
                </div>
                <div class="buttons">
                    <button type="submit" class="blue-btn">دخول</button>
                    <button type="button" onclick="window.location.href = '{{ URL::page('login/show') }}'" class="blue-btn big-btn">مستخدم جديد</button>
                </div>

                @if(! $errors->isEmpty())
                <div class="errors">
                    {{ implode($errors->all(':message'), '<br/>') }}
                </div>
                @else
                <a href="#">لإسترجاع كلمة السر</a>
                @endif
            </form>
        </div>
        @else

        <div class="welcome-message">
            مرحبا بك
            {{ $authUser->name }}

            <a href="{{ URL::route('logout') }}">خروج</a>
        </div>
        @endif
    </div>


    <div class="separator"></div>


    <h3 class="search-link"><a href="#">أبحث عن إعلان</a></h3>

    <div class="right-search">

        <div class="upper-section">

            <div class="offer-image">
                <img src="{{ URL::asset('app/img/offer-image.png') }}" class="img-responsive" alt=""/>
            </div>

            <div class="upper-form">

                <h3>أبحث عن عقار</h3>

                <select name="" class="form-control">
                    <option value="">من الأحدث للأقدم</option>
                </select>
                <div class="buttons">
                    <div class="form-btn"><a href="">للبيع</a></div>
                    <div class="form-btn"><a href="">للإيجار</a></div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <form action="{{ URL::page('search') }}" method="GET">
            <div class="lower-section">
                <div class="row">
                    <div class="left">
                        <label for="search-in2">المساحة</label>
                        <div class="two-inputs form-inputs">
                            <input name="search_area_low" value="{{ Input::get('search_area_low') }}" type="text" id="search-in2" class="form-control" placeholder="من"/>
                            <input name="search_area_high" value="{{ Input::get('search_area_high') }}" type="text" class="form-control" placeholder="إلى"/>
                        </div>
                    </div>
                    <div class="right">
                        <label for="search-in1">نوع العقار</label>
                        <div class="form-inputs">

                            <select name="search_category" id="category-input" class="form-control">
                                <option value="">اختر نوع العقار</option>

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
                        <label for="search-in1">المدينة</label>
                        <div class="form-inputs">
                            <input name="search_city" value="{{ Input::get('search_city') }}" type="text" id="search-in2" class="form-control"/>
                        </div>
                    </div>
                    <div class="right">
                        <label for="search-in2">المحافظة</label>
                        <div class="form-inputs">
                            <select id="search-in1" name="search_province" class="form-control">
                                <option value="">اختر المحافظة</option>
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
                    <div class="left">
                        <label for="search-in2">السعر</label>
                        <div class="two-inputs form-inputs">
                            <input name="search_price_low" value="{{ Input::get('search_price_low') }}" type="text" id="search-in2" class="form-control" placeholder="من"/>
                            <input name="search_price_high" value="{{ Input::get('search_price_high') }}" type="text" class="form-control" placeholder="إلى"/>
                        </div>
                    </div>
                    <div class="right">
                        <label for="search-in1">المنطقة</label>
                        <div class="form-inputs">
                            <input name="search_region" value="{{ Input::get('search_region') }}" type="text" id="search-in2" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="buttons">
                    <button class="btn-search" type="submit"></button>
                </div>
            </div>
        </div>
    </form>

</div>