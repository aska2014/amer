@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Price</th>
        <td>{{ $specialOffer->price }}</td>
    </tr>
    <tr>
        <th>Duration</th>
        <td>{{ $specialOffer->getTranslatedDuration }}</td>
    </tr>
    </tbody>
</table>
@stop
