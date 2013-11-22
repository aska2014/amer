@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>English Title</th>
    <th>Arabic Title</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($news as $oneNews)
<tr>
    <td>{{ $oneNews->id }}</td>
    <td>{{ $oneNews->en('title') }}</td>
    <td>{{ $oneNews->ar('title') }}</td>

    @include('freak::elements.tools', array('id' => $oneNews->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>English Title</th>
    <th>Arabic Title</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
