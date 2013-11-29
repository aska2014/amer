@extends('freak::elements.detail')

@section('tables')
<table class="table table-striped table-detail-view">
    <tbody>
    <tr>
        <th>URL</th>
        <td>
            <a href="{{ $link->url }}">
            {{ $link->url }}
            </a>
        </td>
    </tr>
    <tr>
        <th>Page</th>
        <td>
            {{ $link->page_name }}
        </td>
    </tr>
    <tr>
        <th>Model</th>
        <td>
            {{ $link->linkable_type . ' ' . $link->linkable_id }}
        </td>
    </tr>
    </tbody>
</table>
@stop
