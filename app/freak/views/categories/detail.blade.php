@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>English Title</th>
        <td>{{ $category->en('title') }}</td>
    </tr>
    <tr>
        <th>Arabic Title</th>
        <td>{{ $category->ar('title') }}</td>
    </tr>

    @if($category->parent)
    <tr>
        <th>Parent</th>
        <td>
            <a href="{{ freakUrl('element/category/show/'.$category->parent->id) }}">
            {{ $category->parent->en('title') ?: $category->parent->ar('title') }}
            </a>
        </td>
    </tr>
    @endif
    </tbody>
</table>
@stop
