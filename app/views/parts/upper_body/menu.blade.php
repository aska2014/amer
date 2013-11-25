<div class="large-menu">

    <?php $i = 0; ?>

    @foreach($estateCategories as $category)

    <?php $i++; ?>

    <div class="menu-item">
        <a href="{{ URL::page('all-estates', $category) }}">
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
                <li><a href="{{ URL::page('all-estates', $childCategory) }}">{{ $childCategory->title }}</a></li>
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
            @if($link->getModel() and $link->getModel()->same($category))
            <option value="{{ URL::page('all-estates', $category) }}" selected="selected">{{ $category->title }}</option>
            @else
            <option value="{{ URL::page('all-estates', $category) }}">{{ $category->title }}</option>
            @endif
        @endforeach
    </select>
</div>