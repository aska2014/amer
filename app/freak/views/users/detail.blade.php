@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Name</th>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <th>Last time he was online</th>
        <td>{{ date('F j, Y, g:i a', strtotime($user->online_at)) }}</td>
    </tr>
    <tr>
        <th>Account created at</th>
        <td>{{ date('F j, Y, g:i a', strtotime($user->created_at)) }}</td>
    </tr>

    </tbody>
</table>

@include('panel::userinfo.detail_table', array('userInfo' => $user->getInfo()))
@stop
