@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Estate</span>
                <div class="toolbar">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#tab-02" data-toggle="tab">Arabic</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal form-editor" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Category</label>
                            <div class="controls">
                                <select name="Estate[category_id]" required>
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                    @if($estate->category_id == $category->id)
                                    <option selected="selected" value="{{ $category->id }}">{{ $category->en('title') }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->en('title') }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Title</label>
                            <div class="controls">
                                <input type="text" name="Estate[title]" id="input05" class="span12" value="{{ $estate->en('title') }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Price</label>
                            <div class="controls">
                                <input type="number" name="Estate[price]" id="input05" class="span2" value="{{ $estate->price }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Type</label>
                            <div class="controls">
                                <select name="Estate[type]">
                                    @foreach($estate->getTypes() as $key => $value)
                                    @if($estate->type == $key)
                                    <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                                    @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Number of rooms</label>
                            <div class="controls">
                                <input type="text" name="Estate[number_of_rooms]" id="input05" class="span12" value="{{ $estate->number_of_rooms }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Area</label>
                            <div class="controls">
                                <input type="text" name="Estate[area]" id="input05" class="span12" value="{{ $estate->area }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Place</label>
                            <div class="controls">
                                <input type="text" name="Estate[place]" id="input05" class="span12" value="{{ $estate->place }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Region</label>
                            <div class="controls">
                                <input type="text" name="Estate[place]" id="input05" class="span12" value="{{ $estate->place }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Description</label>
                            <div class="controls">
                                <textarea name="Estate[description]" id="editor1" class="cleditor">{{ $estate->en('description') }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="Estate[language]" value="en" />
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
    ;(function( $, window, document, undefined ) {

        $(document).ready(function() {
            $(".cleditor").each(function()
            {
                // When all page resources has finished loading
                CKEDITOR.replace( $(this).attr('id'), {
                    toolbar: [
                        { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                        [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike Through', 'Subscript', 'Superscript'] },
                        { items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Link', 'Unlink', 'Anchor'] }
                    ]
                });
            });

            setInterval('refreshCkeditor()', 1000);
        });

    }) (jQuery, window, document);

    function getEditor( editor )
    {
        return CKEDITOR.instances[editor];
    }

    function refreshCkeditor()
    {
        $(".cleditor").each(function() {
            $(this).val(getEditor($(this).attr('id')).getData());
        });
    }
</script>
@stop