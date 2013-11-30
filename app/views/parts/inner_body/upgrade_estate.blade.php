
@if($activeSpecial = $estate->getActiveSpecial())

<div class="alert alert-success alert-dismissable">

    {{ trans('messages.estate.already_special', array(
    'from' => $date->date('d F Y', $activeSpecial->from),
    'to' => $date->date('d F Y', $activeSpecial->to))) }}
</div>

@else

<div class="main-title">
    <a href="#">ميز اعلانك</a>
</div>

<form action="{{ URL::page('estate/upgrade', $estate) }}" method="POST" ng-controller="UpgradeEstateController">
    <div class="upgrade-estate">

        <span>أختر فترة تميز هذا الاعلان</span>

        <div class="clearfix"></div>

        @foreach($offers as $offer)

        <div class="upgrade-box">
            <h5>{{ $offer->getTranslatedDuration() }}</h5>
            <span class="price">{{ $offer->price->format() }}</span>
            <input type="radio" name="SpecialPayment[special_offer_id]" value="{{ $offer->id }}" />
        </div>

        @endforeach

    </div>

    <div class="separator"></div>
    <div class="clear-fix"></div>
    <div class="separator"></div>

    <div class="buttons">
        <input type="submit" class="btn btn-success" value="نعم اريد"/>
        <a href="{{ URL::page('estate/show', $estate) }}" class="btn btn-primary">لا شكراً</a>
    </div>
</form>

<div class="separator"></div>
<div class="separator"></div>

@endif

<div class="main-title">
    <a href="#">فوائد الاعلان المميز</a>
</div>

<p>
    <ol>
        <li>يتم إعطاء الإعلانات المميزه أولويه في الظهور في عمليات البحث</li>
        <li>يحظى العميل بعدد مشاهدات كبير جداً.</li>
        <li>تكون الأولوية في الظهور في القوائم البريدية</li>
        <li>تكون له الأولوية في الإعلانات ذان الصلة</li>
        <li>يتم تثبيت الإعلانات في أعلى قوائم التصنيفات والتصنيفات الفرعيه بحيث يكون من ضمن أول 7 إعلانات مع تمييزها بلون خلفيه خاص</li>
    </ol>
</p>