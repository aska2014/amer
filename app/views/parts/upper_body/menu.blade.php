<div class="large-menu">

    <?php $i = 0; ?>

    @foreach($estateCategories as $category)

    <?php $i++; ?>

    <div class="menu-item">
        <a href="{{ URL::page('estate/all', $category) }}">
            <div class="item-img">
                @if($image = $category->getImage('main'))
                <img class="img-responsive" src="{{ $image->getLargest()->url }}" alt="{{ $category->title }}"/>
                @endif
            </div>

            <div class="img-info">{{ $category->title }}</div>
        </a>

        @if(! $category->children->isEmpty())
        <div class="item-drop-down">
            <ul>
                @foreach($category->children as $childCategory)
                <li><a href="{{ URL::page('estate/all', $childCategory) }}">{{ $childCategory->title }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    @endforeach
</div>

<div class="large-menu-dropdown">
    <select class="form-control" onchange="window.location.href=this.value;">
        @foreach($estateCategories as $category)
            @if($model AND $model->same($category))
            <option value="{{ URL::page('estate/all', $category) }}" selected="selected">{{ $category->title }}</option>
            @else
            <option value="{{ URL::page('estate/all', $category) }}">{{ $category->title }}</option>
            @endif
        @endforeach
    </select>
</div>