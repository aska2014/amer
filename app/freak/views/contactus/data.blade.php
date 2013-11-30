@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Subject</th>
    <th>User email</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($contactUs as $oneContactUs)
<tr onclick>
    <td>{{ $oneContactUs->id }}</td>
    <td>
        {{ $oneContactUs->subject }}
    </td>
    <td>
        {{ $oneContactUs->ownerInfo->contact_email }}
    </td>
    <td class="action-col" width="10%">
        <span class="btn-group">
            <a href="{{ freakUrl($element->getUri('show/'.$oneContactUs->id)) }}" class="btn btn-small"><i class="icon-search"></i></a>
            <a href="{{ freakUrl($element->getUri('delete/'.$oneContactUs->id)) }}" class="btn btn-small"><i class="icon-trash"></i></a>
        </span>
    </td>
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Subject</th>
    <th>User email</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
