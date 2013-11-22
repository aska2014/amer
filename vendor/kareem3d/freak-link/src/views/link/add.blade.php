@extends('freak::elements.add')

@section('form')
<form class="form-horizontal form-editor" method="POST">
    <div class="control-group">
        <label class="control-label">URL</label>
        <div class="controls">
            <input type="text" name="Link[relative_url]" value="{{ $link->relative_url }}" class="span12" required/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Page linked to</label>
        <div class="controls">
            <input type="text" name="Link[page]" value="{{ $link->page_name }}" class="span12"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Arguments <br><small>URL query format</small></label>
        <div class="controls">
            <input type="text" name="Link[arguments]" value="{{ $link->getArgumentsString() }}"  class="span12"/>
        </div>
    </div>
</form>
@stop