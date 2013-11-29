@extends('freak::elements.empty_add')

@section('form')
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
                                <input type="text" name="Special[from]" id="input05" class="span12" value="{{ $special->from }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Special to date</label>
                            <div class="controls">
                                <input type="number" name="Special[to]" id="input05" class="span2" value="{{ $special->to }}" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop