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
            {{ $link->page }}
        </td>
    </tr>
    <tr>
        <th>Arguments</th>
        <td>
            {{ $link->getArgumentsString() }}
        </td>
    </tr>
    </tbody>
</table>
@stop
