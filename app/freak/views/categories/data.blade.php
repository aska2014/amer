@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Title</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($categories as $category)
<tr>
    <td>{{ $category->id }}</td>
    <td>
        {{ $category->ar('title') }}

        <ul>
        @foreach($category->children as $child)
            <li><a href="{{ freakUrl('element/category/show/'.$child->id) }}">{{ $child->title }}</a></li>
        @endforeach
        </ul>
    </td>

    @include('freak::elements.tools', array('id' => $category->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Title</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
