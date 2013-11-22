@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>English Title</th>
        <td>{{ $category->en('title') }}</td>
    </tr>
    <tr>
        <th>Arabic Title</th>
        <td>{{ $category->ar('title') }}</td>
    </tr>
    </tbody>
</table>
@stop
