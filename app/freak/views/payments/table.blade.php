@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Estate</th>
    <th>User</th>
    <th>Offer</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($payments as $payment)
<tr>
    <td>{{ $payment->id }}</td>
    <td>
        {{ $payment->estate->ar('title') }}
    </td>
    <td>
        {{ $payment->user->name }}
    </td>

    <td>
        {{ $payment->offer->getTranslatedDuration() }}
    </td>

    @include('freak::elements.tools', array('id' => $payment->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Estate</th>
    <th>User</th>
    <th>Offer</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
