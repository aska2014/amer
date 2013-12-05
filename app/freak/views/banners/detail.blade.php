@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>Banner size</th>
        <td>{{ $banner->place->size }}</td>
    </tr>
    <tr>
        <th>Banner from</th>
        <td>
            {{ date('F j, Y, g:i a', strtotime($banner->from)) }}
        </td>
    </tr>
    <tr>
        <th>Banner from</th>
        <td>
            {{ date('F j, Y, g:i a', strtotime($banner->to)) }}
        </td>
    </tr>
    <tr>
        <th>Banner url</th>
        <td>
            <a href="{{ $banner->url }}">
                {{ $banner->url }}
            </a>
        </td>
    </tr>
    </tbody>
</table>
@stop
