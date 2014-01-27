
@if($activeSpecial = $estate->getActiveSpecial())

<div class="alert alert-success alert-dismissable">

    {{ trans('messages.estate.already_special', array(
    'from' => $date->date('d F Y', $activeSpecial->from),
    'to' => $date->date('d F Y', $activeSpecial->to))) }}
</div>

@else

<div class="main-title">
    <h1><a href="#">{{ trans('titles.upgrade_estate') }}</a></h1>
</div>

<form action="{{ URL::page('estate/upgrade', $estate) }}" method="POST" ng-controller="UpgradeEstateController">
    <div class="upgrade-estate">

        <span>{{ trans('words.choose_upgrade_estate') }}</span>

        <div class="clearfix"></div>

        <?php $first = true; ?>
        @foreach($offers as $offer)

        <div class="upgrade-box">
            <h5>{{ $offer->getTranslatedDuration() }}</h5>
            <span class="price">{{ $offer->price->format() }}</span>
            @if($first)
            <input type="radio" name="SpecialPayment[special_offer_id]" value="{{ $offer->id }}" checked="checked" />
            @else
            <input type="radio" name="SpecialPayment[special_offer_id]" value="{{ $offer->id }}" />
            @endif
        </div>
        <?php $first = false; ?>

        @endforeach

    </div>

    <div class="separator"></div>
    <div class="clear-fix"></div>
    <div class="separator"></div>

    <div class="buttons">
        <input type="submit" class="btn btn-success" value="{{ trans('words.yes_i_want') }}"/>
        <a href="{{ URL::page('estate/show', $estate) }}" class="btn btn-primary">{{ trans('words.no_thanks') }}</a>
    </div>
</form>

<div class="separator"></div>
<div class="separator"></div>

@endif


<div class="main-title">
    <a href="#">{{ trans('titles.upgrade_benefits') }}</a>
</div>

@if(App::make('Language')->is('ar'))
<p>
    <ol>
        <li>يتم إعطاء الإعلانات المميزه أولويه في الظهور في عمليات البحث</li>
        <li>يحظى العميل بعدد مشاهدات كبير جداً.</li>
        <li>تكون الأولوية في الظهور في القوائم البريدية</li>
        <li>يتم تثبيت الإعلانات في أعلى قوائم التصنيفات والتصنيفات الفرعيه بحيث يكون من ضمن أول 7 إعلانات مع تمييزها بلون خلفيه خاص</li>
    </ol>
</p>
@else

<p>
    <ol>
        <li>Your announcement will be given the priority to show in the search process.</li>
        <li>Your announcement gets a lot views.</li>
        <li>Your announcement will be given the priority to show in the mailing list.</li>
        <li>Your announcement gets a different background to be more visible for public.</li>
    </ol>
</p>
@endif