<div class="main-title">
    <h1><a href="#">{{ trans('titles.add_estate') }}</a></h1>
</div>

<form action="{{ $estate->exists ? URL::route('estate.update', $estate->id) : URL::route('estate.create') }}" enctype="multipart/form-data" ng-controller="AddEstateController" class="form-horizontal" method="POST"
 ng-init='initializeAll({{$eFiller->jsObject("title", "description", "province_id", "city", "region", "estate_category_id", "number_of_rooms", "area", "auction", "price")}},
                        {{$aFiller->jsObject("start_price", "end_price")}},
                        {{$uFiller->jsObject("name", "mobile_number", "telephone_number", "contact_email")}})'>


    <div class="form-group">
        <label for="title-input">{{ trans('form.estate.title') }}</label>

        <input class="form-control" type="text" id="title-input" name="Estate[title]" ng-model="estate.title" required>
    </div>
    <div class="form-group">
        <label for="description-input">{{ trans('form.estate.description') }}</label>
        <textarea class="form-control" id="description-input" name="Estate[description]" ng-model="estate.description"></textarea>
    </div>

    <div class="form-group">
        <label for="image-input">{{ trans('form.estate.image') }}</label>
        <div class="two-inputs">
            @if($estate->exists && $image = $estate->getImage('main'))
            <img class="img-responsive" src="{{ $image->getNearest(200, 150) }}" alt=""/>
            @endif
            <input type="file" id="image-input" name="estate-img"/>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="form-group">
        <label for="image-input">{{ trans('form.estate.gallery') }}</label>
        <div class="two-inputs">

            <button type="button" class="btn btn-default add-image" ng-click="addImage()">أضف صورة</button>
        </div>
    </div>
    <hr/>

    <div class="form-group">
        <label for="city-input">{{ trans('form.estate.province') }}</label>
        <select class="form-control" name="Estate[province_id]" required ng-model="estate.province_id">
            <option value="">{{ trans('form.estate.choose_province') }}</option>
            @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="city-input">{{ trans('form.estate.city') }}</label>
        <input class="form-control" type="text" id="city-input" name="Estate[city]" ng-model="estate.city" required>
    </div>
    <div class="form-group">
        <label for="region-input">{{ trans('form.estate.region') }}</label>
        <input class="form-control" type="text" id="region-input" name="Estate[region]" ng-model="estate.region" required>
    </div>

    <hr/>

    <div class="form-group">
        <label for="category-input">{{ trans('form.estate.category') }}</label>
        <div class="two-inputs">

            <select id="category-input" class="form-control" ng-model="estate.parent_category_id" required>
                <option value="">{{ trans('form.estate.choose_category') }}</option>
                @foreach($estateCategories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>

            @foreach($estateCategories as $category)
            @if(! $category->children->isEmpty())
            <select class="form-control child-categories" ng-model="estate.child_category_id" parent-category-id="{{ $category->id }}" ng-show="estate.parent_category_id == {{ $category->id }}">
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
        <label for="price-input">{{ trans('form.estate.price') }}</label>
        <div ng-if="! show.auction">
            <input class="form-control" type="text" id="price-input" name="Estate[price]" ng-model="estate.price" required>
        </div>
        <div class="two-inputs" ng-if="show.auction" ng-cloak>
            <input class="form-control" type="text" name="Auction[start_price]" placeholder="الأدنى" required>
            <input class="form-control" type="text" name="Auction[end_price]" placeholder="الأعلى" required>
        </div>
    </div>

    <div class="form-group" ng-show="show.number_of_rooms">
        <label for="number-of-rooms-input">{{ trans('form.estate.number_of_rooms') }}</label>
        <select class="form-control" id="number-of-rooms-input" name="Estate[number_of_rooms]" ng-model="estate.number_of_rooms" required>

            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>

        </select>
    </div>
    <div class="form-group" ng-show="show.area">
        <label for="area-input">{{ trans('form.estate.area') }}</label>
        <input class="form-control" type="text" id="area-input" ng-model="estate.area" name="Estate[area]" value="{{ $eFiller->get('area') }}" required>
    </div>

    <hr/>

    <div class="form-group">
        <label for="user-name-input">{{ trans('form.estate.user.name') }}</label>
        <input class="form-control" type="text" id="user-name-input" name="UserInfo[name]" value="{{ $uFiller->get('name', $authUser ? $authUser->name : '') }}" required>
    </div>
    <div class="form-group">
        <label for="user-mobile-input">{{ trans('form.estate.user.mobile') }}</label>
        <input class="form-control" type="text" id="user-mobile-input" name="UserInfo[mobile_number]" value="{{ $uFiller->get('mobile_number', $authUser ? $authUser->mobile_number : '') }}">
    </div>
    <div class="form-group">
        <label for="user-email-input">{{ trans('form.estate.user.email') }}</label>
        <input class="form-control" type="email" id="user-email-input" name="UserInfo[contact_email]" value="{{ $uFiller->get('contact_email', $authUser ? $authUser->contact_email : '') }}" required>
    </div>

    <input type="hidden"
           name="estate-has-auction" value="{{ angular('estate.auction') }}"/>

    <div class="buttons">
        <button type="submit" class="btn btn-success">{{ trans('form.estate.next') }}</button>
    </div>

</form>