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
@foreach($sliders as $slider)
<tr>
    <td>{{ $slider->id }}</td>
    <td>{{ $slider->ar('title') }}</td>

    @include('freak::elements.tools', array('id' => $slider->id))
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
