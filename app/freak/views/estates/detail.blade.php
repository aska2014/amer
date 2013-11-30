@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-doc-text-image"></li> Estate information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Title</th>
        <td>{{ $estate->ar('title') }}</td>
    </tr>
    <tr>
        <th>City</th>
        <td>{{ $estate->city }}</td>
    </tr>
    <tr>
        <th>Region</th>
        <td>{{ $estate->region }}</td>
    </tr>
    <tr>
        <th>Category of estate</th>
        <td>
            @if($category = $estate->category)
            <a href="{{ freakUrl('element/category/show/' . $category->id) }}">
                {{ $category->ar('title') }}
            </a>
            @endif
        </td>
    </tr>
    @if($estate->price)
    <tr>
        <th>Price</th>
        <td>
            {{ $estate->price }}
        </td>
    </tr>
    @endif
    <tr>
        <th>Description</th>
        <td>{{ $estate->description }}</td>
    </tr>
    <tr>
        <th>Number of rooms</th>
        <td>{{ $estate->number_of_rooms }}</td>
    </tr>
    <tr>
        <th>Area</th>
        <td>{{ $estate->area }}</td>
    </tr>
    </tbody>
</table>



<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> User information</th>
    </tr>
    </thead>
    <tbody>
    @if($estate->user)
    <tr>
        <th>User id</th>
        <td>
            <a href="{{ freakUrl('/elements/user/' . $estate->user->id) }}">
                {{ $estate->user->id }}
            </a>
        </td>
    </tr>
    @endif
    <tr>
        <th>User full name</th>
        <td>{{ $estate->ownerInfo->name }}</td>
    </tr>
    <tr>
        <th>User mobile number</th>
        <td>{{ $estate->ownerInfo->mobile_number }}</td>
    </tr>
    <tr>
        <th>User telephone number</th>
        <td>{{ $estate->ownerInfo->telephone_number }}</td>
    </tr>
    <tr>
        <th>User email</th>
        <td>
            <a href="mailto:{{ $estate->ownerInfo->contact_email }}" target="_top">
            {{ $estate->ownerInfo->contact_email }}
            </a>
        </td>
    </tr>
    </tbody>
</table>



@if($auction = $estate->auction)
<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th colspan="2"><li class="icol-flag-blue"></li> Auction</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Start price</th>
        <td>
            {{ $auction->start_price }}
        </td>
    </tr>
    <tr>
        <th>End price</th>
        <td>
            {{ $auction->end_price }}
        </td>
    </tr>
    </tbody>
</table>
@endif

@stop
