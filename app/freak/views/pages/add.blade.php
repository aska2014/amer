@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Page</span>
                <div class="toolbar">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#tab-01" data-toggle="tab">English</a></li>
                        <li><a href="#tab-02" data-toggle="tab">Arabic</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Title</label>
                            <div class="controls">
                                <input type="text" name="Page[title]" id="input05" class="span12" value="{{ $page->en('title') }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Body</label>
                            <div class="controls">
                                <textarea name="Page[body]" id="editor2" class="cleditor">{{ $page->en('body') }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="Page[language]" value="en"/>
                    </form>
                </div>

                <div class="tab-pane" id="tab-02">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Title</label>
                            <div class="controls">
                                <input type="text" name="Page[title]" id="input05" class="span12" value="{{ $page->ar('title') }}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Body</label>
                            <div class="controls">
                                <textarea name="Page[body]" id="editor3" class="cleditor">{{ $page->ar('body') }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="Page[language]" value="ar"/>
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
                        [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ],	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
                        ['Bold', 'Italic', 'Underline', 'Strike Through', 'Subscript', 'Superscript'],
                        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Link', 'Unlink', 'Anchor'],
                        ['Styles', 'Format', 'Font', 'FontSize','TextColor', 'BGColor'],
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