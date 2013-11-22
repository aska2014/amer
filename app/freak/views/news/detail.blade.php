@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>English Title</th>
        <td>{{ $news->en('title') }}</td>
    </tr>
    <tr>
        <th>Arabic Title</th>
        <td>{{ $news->ar('title') }}</td>
    </tr>
    </tbody>
</table>
@stop
