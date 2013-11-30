@extends('freak::elements.empty_add')

@section('form')
@if($special->exists)

<div class="row-fluid">
    <div class="span12">
        <blockquote>
            <p>
                This estate is already set to
                be special<br />
                from: <b>{{ date('F j, Y, g:i a', strtotime($special->from)) }}</b> , <br />
                to: <b>{{ date('F j, Y, g:i a', strtotime($special->to)) }}</b>
            </p>
        </blockquote>
    </div>
</div>

@endif
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Special</span>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal form-editor" method="POST">


                        <div class="control-group">
                            <label class="control-label" for="input05">Special from date</label>
                            <div class="controls">
                                <input type="text" class="span12 timepicker-date" name="Special[from]" value="{{ date('m/d/Y H:i', strtotime($special->from)) }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Special to date</label>
                            <div class="controls">
                                <input type="text" class="span12 timepicker-date" name="Special[to]" value="{{ date('m/d/Y H:i', strtotime($special->to)) }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
@parent

<script type="text/javascript">

    $(document).ready(function()
    {
        $(".timepicker-date").datetimepicker();
    });

</script>

@stop