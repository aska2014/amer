@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Size</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($bannerRequests as $bannerRequest)
<tr>
    <td>{{ $bannerRequest->id }}</td>
    <td>
        {{ $bannerRequest->place->size }}
    </td>

    <td class="action-col" width="10%">
    <span class="btn-group">
        <a href="{{ freakUrl($element->getUri('show/'.$bannerRequest->id)) }}" class="btn btn-small"><i class="icon-search"></i></a>
        <a href="{{ freakUrl($element->getUri('delete/'.$bannerRequest->id)) }}" class="btn btn-small"><i class="icon-trash"></i></a>
    </span>
    </td>
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Size</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
