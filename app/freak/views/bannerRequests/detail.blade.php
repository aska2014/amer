@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Size</th>
        <td>{{ $bannerRequest->place->size }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $bannerRequest->description }}</td>
    </tr>
    </tbody>
</table>

@include('panel::users.tables', array('user' => $bannerRequest->user))
@stop
