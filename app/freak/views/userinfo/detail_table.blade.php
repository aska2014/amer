<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> User information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Name</th>
        <td>{{ $userInfo->name }}</td>
    </tr>
    <tr>
        <th>Contact email</th>
        <td>{{ $userInfo->contact_email }}</td>
    </tr>
    <tr>
        <th>Mobile number</th>
        <td>{{ $userInfo->mobile_number }}</td>
    </tr>
    <tr>
        <th>Telephone number</th>
        <td>{{ $userInfo->telephone_number }}</td>
    </tr>
    </tbody>
</table>