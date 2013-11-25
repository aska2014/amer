@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Title</th>
        <td>{{ $news->ar('title') }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $news->ar('description') }}</td>
    </tr>
    </tbody>
</table>
@stop
