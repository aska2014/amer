@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Title</th>
        <td>{{ $slider->ar('title') }}</td>
    </tr>
    <tr>
        <th>Small description</th>
        <td>{{ $slider->ar('small_description') }}</td>
    </tr>
    <tr>
        <th>Large description</th>
        <td>{{ $slider->ar('large_description') }}</td>
    </tr>
    </tbody>
</table>
@stop
