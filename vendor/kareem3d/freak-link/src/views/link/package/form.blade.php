<div class="row-fluid">
    <div class="span12 widget">
        <div class="widget-header">
            <span class="title">URL</span>
        </div>
        <div class="widget-content form-container">
            <form class="form-horizontal form-editor" action="{{ freakUrl('packages/store/Link') }}" method="POST">
                <div class="control-group">
                    <label class="control-label">URL</label>
                    <div class="controls">
                        <input type="text" name="Link[relative_url]" value="{{ $link->relative_url }}" class="span12" required/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>