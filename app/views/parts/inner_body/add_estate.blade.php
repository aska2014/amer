<div class="main-title">
    <a href="#">شقق للإيجار فى القاهرة</a>
</div>

<form enctype="multipart/form-data" role="form" class="form-horizontal" method="POST" action="{{ URL::route('add-estate') }}" ng-controller="AddEstateController">
    <div class="form-group">
        <label for="title-input">عنوان الأعلان</label>
        <input class="form-control" type="text" id="title-input" name="Estate[title]" value="{{ Input::old('Estate.title') }}"
               placeholder="هذا الحقل لعنوان نص الاعلان وليس لعنوان المكان" required>
    </div>
    <div class="form-group">
        <label for="city-input">المدينة</label>
        <input class="form-control" type="text" id="city-input" name="Estate[city]" value="{{ Input::old('Estate.city') }}" required>
    </div>
    <div class="form-group">
        <label for="region-input">الحى \ المنطقه</label>
        <input class="form-control" type="text" id="region-input" name="Estate[region]" value="{{ Input::old('Estate.region') }}" required>
    </div>

    <hr/>

    <div class="form-group" ng-init="estate.category_id={{ Input::old('Estate.estate_category_id', 0) }}">
        <label for="category-input">نوع العقار</label>
        <div class="two-inputs">

            <select id="category-input" class="form-control" ng-model="estate.parent_category_id" required>
                <option value="">اختر نوع العقار</option>
                @foreach($estateCategories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>

            @foreach($estateCategories as $category)
            @if(! $category->children->isEmpty())
            <select class="form-control" id="child-category-input" ng-model="estate.child_category_id" ng-show="estate.parent_category_id == {{ $category->id }}">
                @foreach($category->children as $childCategory)
                <option value="{{ $childCategory->id }}">{{ $childCategory->title }}</option>
                @endforeach
            </select>
            @endif
            @endforeach
        </div>

        <input type="hidden" name="Estate[estate_category_id]" value="{{ angular('getCategoryId()') }}"/>
    </div>
    <div class="form-group">
        <label for="auction-input">مزاد ؟</label>
        <input type="checkbox" id="auction-input" name="estate-has-auction" ng-init="estate.auction={{ Input::old('estate-has-auction') ? 'true' : 'false' }}" ng-model="estate.auction">
    </div>
    <div class="form-group">
        <label for="price-input">السعر</label>
        <div ng-if="! estate.auction">
            <input class="form-control" type="text" id="price-input" name="Estate[price]" value="{{ Input::old('Estate.price') }}" required>
        </div>
        <div class="two-inputs" ng-if="estate.auction" ng-cloak>
            <input class="form-control" type="text" name="Auction[start_price]" value="{{ Input::old('Auction.start_price') }}" placeholder="الأدنى" required>
            <input class="form-control" type="text" name="Auction[end_price]" value="{{ Input::old('Auction.end_price') }}" placeholder="الأعلى" required>
        </div>
    </div>

    <hr/>

    <div class="form-group">
        <label for="image-input">صورة الاعلان</label>
        <div class="two-inputs">
            <input type="file" id="image-input" name="estate-img"/>
        </div>
    </div>

    <div class="form-group">
        <label for="description-input">نص الاعلان</label>
        <textarea class="form-control" id="description-input" name="Estate[description]">{{ Input::old('Estate.description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="number-of-rooms-input">عدد الغرف</label>
        <select class="form-control" id="number-of-rooms-input" name="Estate[number_of_rooms]" ng-init="estate.number_of_rooms={{ Input::old('Estate.number_of_rooms', 1) }}" ng-model="estate.number_of_rooms" required>

            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>

        </select>
    </div>
    <div class="form-group">
        <label for="area-input">المساحة</label>
        <input class="form-control" type="text" id="area-input" name="Estate[area]" value="{{ Input::old('Estate.area') }}" required>
    </div>

    <hr/>

    <div class="form-group">
        <label for="user-name-input">اسم صاحب الاعلان</label>
        <input class="form-control" type="text" id="user-name-input" name="UserInfo[name]" value="{{ Input::old('UserInfo.name') ?: $authUser->name }}" required>
    </div>
    <div class="form-group">
        <label for="user-mobile-input">رقم الموبيل</label>
        <input class="form-control" type="text" id="user-mobile-input" name="UserInfo[mobile_number]" value="{{ Input::old('UserInfo.mobile_number') ?: $authUser->mobile_number }}">
    </div>
    <div class="form-group">
        <label for="user-telephone-input">رقم الهاتف</label>
        <input class="form-control" type="text" id="user-telephone-input" name="UserInfo[telephone_number]" value="{{ Input::old('UserInfo.telephone_number') ?: $authUser->telephone_number }}">
    </div>
    <div class="form-group">
        <label for="user-email-input">البريد الإلكترونى</label>
        <input class="form-control" type="email" id="user-email-input" name="UserInfo[contact_email]" value="{{ Input::old('UserInfo.contact_email') ?: $authUser->contact_email }}" required>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-success">التالى</button>
    </div>
</form>