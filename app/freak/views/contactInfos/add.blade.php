@extends('freak::master.layout1')

@section('content')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Category</span>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Email</label>
                            <div class="controls">
                                <input type="text" name="ContactInfo[email]" id="input05" class="span12" value="{{ $email }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Mobile number 1</label>
                            <div class="controls">
                                <input type="text" name="ContactInfo[mobile_number][]" id="input05" class="span12" value="{{ isset($mobileNumbers[0]) ? $mobileNumbers[0] : '' }}" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input05">Mobile number 2</label>
                            <div class="controls">
                                <input type="text" name="ContactInfo[mobile_number][]" id="input05" class="span12" value="{{ isset($mobileNumbers[1]) ? $mobileNumbers[1] : '' }}" required>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save contact information</button>
                            <button class="btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop