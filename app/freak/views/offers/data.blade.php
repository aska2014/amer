@extends('freak::elements.filterable')

@section('table')
<thead>
<tr>
    <th>Id</th>
    <th>Price</th>
    <th>Duration</th>
    <th>Tools</th>
</tr>
</thead>
<tbody>
@foreach($specialOffers as $specialOffer)
<tr>
    <td>{{ $specialOffer->id }}</td>
    <td>
        {{ $specialOffer->price }}
    </td>

    <td>
        {{ $specialOffer->getTranslatedDuration() }}
    </td>

    @include('freak::elements.tools', array('id' => $specialOffer->id))
</tr>
@endforeach
</tbody>
<tfoot>
<tr>
    <th>Id</th>
    <th>Price</th>
    <th>Duration</th>
    <th>Tools</th>
</tr>
</tfoot>
@stop
