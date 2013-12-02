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
@foreach($pages as $page)
<tr>
    <td>{{ $page->id }}</td>
    <td>
        {{ $page->ar('title') }}
    </td>

    @include('freak::elements.tools', array('id' => $page->id))
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
