@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-doc-text-image"></li> Product information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Category</th>
        <td>
            @if($category = $product->category)
            <a href="{{ freakUrl('element/category/show/' . $category->id) }}">
                {{ $category->en('title') }}
            </a>
            @endif
        </td>
    </tr>
    <tr>
        <th>Price</th>
        <td>{{ $product->price }}</td>
    </tr>
    <tr>
        <th>Offer Price</th>
        <td>{{ $product->offer_price }}</td>
    </tr>
    <tr>
        <th>Type</th>
        <td>{{ $product->getTypeString() }}</td>
    </tr>
    </tbody>
</table>



<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> English information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Title</th>
        <td>
            {{ $product->en('title') }}
        </td>
    </tr>
    <tr>
        <th>Description</th>
        <td>
            {{ $product->en('description') }}
        </td>
    </tr>
    <tr>
        <th>Specifications</th>
        <td>
            {{ $product->en('specifications') }}
        </td>
    </tr>
    </tbody>
</table>



<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> Arabic information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Title</th>
        <td>
            {{ $product->ar('title') }}
        </td>
    </tr>
    <tr>
        <th>Description</th>
        <td>
            {{ $product->ar('description') }}
        </td>
    </tr>
    <tr>
        <th>Specifications</th>
        <td>
            {{ $product->ar('specifications') }}
        </td>
    </tr>
    </tbody>
</table>
@stop
