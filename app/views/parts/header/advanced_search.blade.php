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
                    <button type="button" onclick="window.location.href = '{{ URL::page('login-register') }}'" class="blue-btn big-btn">مستخدم جديد</button>
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


    <h3 class="search-link"><a href="#">أبحث عن عقار</a></h3>

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

        <div class="lower-section">
            <div class="row">
                <div class="left">
                    <label for="search-in2">المساحة</label>
                    <div class="two-inputs form-inputs">
                        <input type="text" id="search-in2" class="form-control" placeholder="من"/>
                        <input type="text" class="form-control" placeholder="إلى"/>
                    </div>
                </div>
                <div class="right">
                    <label for="search-in1">أختر القسم</label>
                    <div class="form-inputs">
                        <select id="search-in1" class="form-control">
                            <option value="">من الأحدث للأقدم</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="left">
                    <label for="search-in2">المدينة</label>
                    <div class="form-inputs">
                        <select id="search-in1" class="form-control">
                            <option value="">القاهرة</option>
                        </select>
                    </div>
                </div>
                <div class="right">
                    <label for="search-in1">المنطقة</label>
                    <div class="form-inputs">
                        <select id="search-in1" class="form-control">
                            <option value="">القاهرة</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="left">
                    <label for="search-in2">السعر</label>
                    <div class="two-inputs form-inputs">
                        <input type="text" id="search-in2" class="form-control" placeholder="من"/>
                        <input type="text" class="form-control" placeholder="إلى"/>
                    </div>
                </div>
                <div class="right">
                    <label for="search-in1">الدولة</label>
                    <div class="form-inputs">
                        <select id="search-in1" class="form-control">
                            <option value="">مصر</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="buttons">
                <button class="btn-search" type="submit"></button>
            </div>
        </div>
    </div>

</div>