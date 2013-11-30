@extends('freak::master.layout1')

@section('content')
@foreach($payments as $payment)
<div class="row-fluid">
    <div class="span12 widget">
        <div class="widget-header">
            <span class="title">{{ $payment->user->name }}</span>
            <div class="toolbar">
                <div class="btn-group">
                    <a href="{{ freakUrl('element/show/' . $payment->id) }}" class="btn"><i class="icos-pencil"></i>Edit</a>
                </div>
            </div>
        </div>
        <div class="widget-content table-container">
            <table class="table table-striped table-detail-view">
                <tbody>
                <tr>
                    <th>Estate</th>
                    <td>
                        <a href="{{ freakUrl('element/estate/show/'.$payment->estate->id) }}">
                            {{ $payment->estate->ar('title') }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Offer</th>
                    <td>
                        <a href="{{ freakUrl('element/offer/show/'.$payment->offer->id) }}">
                            {{ $payment->offer->getTranslatedDuration() }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>
                        <a href="{{ freakUrl('element/user/show/'.$payment->user->id) }}">
                            {{ $payment->user->name }}
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="btn-toolbar">
                <a href="{{ freakUrl('element/payment/accept/'. $payment->id) }}" class="btn btn-success">Payment received | make estate special</a>
                <a href="{{ freakUrl('element/payment/reject/'. $payment->id) }}" class="btn btn-danger">Reject and delete payment</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@stop
