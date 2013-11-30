@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr onclick>
    <td>{{ $user->id }}</td>
    <td>
        {{ $user->name }}
    </td>
    <td>
        {{ $user->email }}
    </td>
    <td class="action-col" width="10%">
        <span class="btn-group">
            <a href="{{ freakUrl($element->getUri('show/'.$user->id)) }}" class="btn btn-small"><i class="icon-search"></i></a>
            <a href="{{ freakUrl($element->getUri('delete/'.$user->id)) }}" class="btn btn-small"><i class="icon-trash"></i></a>
        </span>
    </td>
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
