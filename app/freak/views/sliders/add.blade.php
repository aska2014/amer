@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Slider</span>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Title</label>
                            <div class="controls">
                                <input type="text" name="Slider[title]" id="input05" class="span12" value="{{ $slider->ar('title') }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Small Description</label>
                            <div class="controls">
                                <textarea name="Slider[small_description]" id="editor1" class="cleditor">{{ $slider->ar('small_description') }}</textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Large Description</label>
                            <div class="controls">
                                <textarea name="Slider[large_description]" id="editor2" class="cleditor">{{ $slider->ar('large_description') }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="Slider[language]" value="ar"/>
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