@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>English Title</th>
    <th>Arabic Title</th>
    <th>Category</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($products as $product)
<tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->en('title') }}</td>
    <td>{{ $product->ar('title') }}</td>
    <td>
        @if($category = $product->category)
        <a href="{{ freakUrl('element/category/show/' . $category->id) }}">
            {{ $category->en('title') }}
        </a>
        @endif
    </td>

    @include('freak::elements.tools', array('id' => $product->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>English Title</th>
    <th>Arabic Title</th>
    <th>Category</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
