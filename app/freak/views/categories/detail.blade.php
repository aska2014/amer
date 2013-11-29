@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Title</th>
        <td>{{ $category->ar('title') }}</td>
    </tr>

    @if($category->parent)
    <tr>
        <th>Parent category</th>
        <td>
            <a href="{{ freakUrl('element/category/show/'.$category->parent->id) }}">
            {{ $category->parent->en('title') ?: $category->parent->ar('title') }}
            </a>
        </td>
    </tr>
    @endif


    @if(! $category->children->isEmpty())
    <tr>
        <th>Nested categories</th>
        <td>
            <ul>
                @foreach($category->children as $child)
                <li><a href="{{ freakUrl('element/category/show/'.$child->id) }}">{{ $child->title }}</a></li>
                @endforeach
            </ul>
        </td>
    </tr>
    @endif
    </tbody>
</table>
@stop
