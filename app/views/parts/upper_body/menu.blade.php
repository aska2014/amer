<div class="large-menu">

    <?php $i = 0; ?>

    @foreach($estateCategories->take(9) as $category)

    <?php $i++; ?>

    <div class="menu-item">
        @if($category->children->isEmpty())
        <a href="{{ URL::page('estate/all', $category) }}">
        @endif

            <div class="item-img">
                @if($image = $category->getImage('main'))
                <img class="img-responsive" src="{{ $image->getLargest() }}" alt="{{ $category->title }}"/>
                @endif
            </div>

            <div class="img-info">{{ $category->title }}</div>

        @if($category->children->isEmpty())
        </a>
        @endif

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
            @if($model && $model->same($category))
            <option value="{{ URL::page('estate/all', $category) }}" selected="selected">{{ $category->title }}</option>
            @else
            <option value="{{ URL::page('estate/all', $category) }}">{{ $category->title }}</option>
            @endif
        @endforeach
    </select>
</div>