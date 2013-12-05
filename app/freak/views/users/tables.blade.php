<table class="table table-striped table-detail-view">
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> Account information</th>
    </tr>
    <tbody>
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