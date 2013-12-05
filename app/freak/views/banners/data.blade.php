@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>size</th>
    <th>From date</th>
    <th>To date</th>
    <th>Url</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($banners as $banner)
<tr>
    <td>{{ $banner->id }}</td>
    <td>
        {{ $banner->place->size }}
    </td>
    <td>
        {{ date('F j, Y, g:i a', strtotime($banner->from)) }}
    </td>
    <td>
        {{ date('F j, Y, g:i a', strtotime($banner->to)) }}
    </td>
    <td>
        <a href="{{ $banner->url }}">
        {{ $banner->url }}
        </a>
    </td>

    @include('freak::elements.tools', array('id' => $banner->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>size</th>
    <th>From date</th>
    <th>To date</th>
    <th>Url</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
