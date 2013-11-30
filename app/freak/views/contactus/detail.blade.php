@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Subject</th>
        <td>{{ $contactUs->subject }}</td>
    </tr>
    <tr>
        <th>Body</th>
        <td>{{ $contactUs->body }}</td>
    </tr>
    </tbody>
</table>
@stop
