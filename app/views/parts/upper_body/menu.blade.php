<div class="large-menu">

    <?php $i = 0; ?>

    @foreach($estateCategories as $category)

    <?php $i++; ?>

    <div class="menu-item">
        <a href="{{ URL::page('all-estates', $category) }}">
            <div class="item-img">
                @if($image = $category->getImage('main'))
                <img class="img-responsive" src="{{ $image->getLargest()->url }}" alt=""/>
                @endif
            </div>

            <div class="img-info">{{ $category->title }}</div>
        </a>
    </div>

    @endforeach
</div>


<div class="large-menu-dropdown">
    <select class="form-control change-redirect">
        @foreach($estateCategories as $category)
        <option value="{{ URL::page('category', $category) }}">{{ $category->title }}</option>
        @endforeach
    </select>
</div>