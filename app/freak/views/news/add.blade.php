@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">News</span>
                <div class="toolbar">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#tab-01" data-toggle="tab">Arabic</a></li>
                        <li><a href="#tab-02" data-toggle="tab">English</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Arabic Title</label>
                            <div class="controls">
                                <input type="text" name="News[title]" id="input05" class="span12" value="{{ $news->ar('title') }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Arabic Description</label>
                            <div class="controls">
                                <textarea name="News[description]" id="editor1" class="cleditor">{{ $news->ar('description') }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="News[language]" value="ar"/>
                    </form>
                </div>
                <div class="tab-pane" id="tab-02">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">English Title</label>
                            <div class="controls">
                                <input type="text" name="News[title]" id="input05" class="span12" value="{{ $news->en('title') }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">English Description</label>
                            <div class="controls">
                                <textarea name="News[description]" id="editor2" class="cleditor">{{ $news->en('description') }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="News[language]" value="en"/>
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