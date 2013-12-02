@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> Arabic information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Title</th>
        <td>{{ $page->ar('title') }}</td>
    </tr>
    <tr>
        <th>Body</th>
        <td>{{ $page->ar('body') }}</td>
    </tr>
    </tbody>
</table>
<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> English information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Title</th>
        <td>{{ $page->en('title') }}</td>
    </tr>
    <tr>
        <th>Title</th>
        <td>{{ $page->en('body') }}</td>
    </tr>
    </tbody>
</table>
@stop
