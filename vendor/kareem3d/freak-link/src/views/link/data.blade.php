@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Url</th>
    <th>Page</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($links as $link)
<tr>
    <td>{{ $link->id }}</td>
    <td>
        <a href="{{ $link->url }}">
            {{ $link->url }}
        </a>
    </td>
    <th>{{ $link->page_name }}</th>

    @include('freak::elements.tools', array('id' => $link->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Title</th>
    <th>URL</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
