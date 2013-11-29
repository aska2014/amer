@extends('freak::elements.add')

@section('form')
<form class="form-horizontal form-editor" method="POST">
    <div class="control-group">
        <label class="control-label">URL</label>
        <div class="controls">
            <input type="text" name="Link[url]" value="{{ $link->url }}" class="span12" required/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Page linked to</label>
        <div class="controls">
            <input type="text" name="Link[page_name]" value="{{ $link->page_name }}" class="span12"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Model type<br></label>
        <div class="controls">
            <input type="text" name="Link[linkable_type]" value="{{ $link->linkable_type }}"  class="span12"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Model id<br></label>
        <div class="controls">
            <input type="text" name="Link[linkable_id]" value="{{ $link->linkable_id }}"  class="span12"/>
        </div>
    </div>
</form>
@stop