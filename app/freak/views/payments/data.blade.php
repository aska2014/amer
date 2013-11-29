@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Estate</th>
    <th>Offer</th>
    <th>User</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($payments as $payment)
<tr>
    <td>{{ $payment->id }}</td>
    <td>
        <a href="{{ freakUrl('element/estate/show/'.$payment->estate->id) }}">
            {{ $payment->estate->ar('title') }}
        </a>
    </td>
    <td>
        <a href="{{ freakUrl('element/offer/show/'.$payment->offer->id) }}">
            {{ $payment->offer->getTranslatedDuration() }}
        </a>
    </td>
    <td>
        <a href="{{ freakUrl('element/user/show/'.$payment->user->id) }}">
            {{ $payment->user->name }}
        </a>
    </td>

    @include('freak::elements.tools', array('id' => $payment->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Estate</th>
    <th>Offer</th>
    <th>User</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
