<div class="row-fluid">
    <div class="span12 widget">
        <div class="widget-header">
            <span class="title">SEO information</span>
        </div>
        <div class="widget-content form-container">
            <form class="form-horizontal form-editor" method="POST" action="{{ freakUrl('packages/store/SEO') }}">
                <div class="control-group">
                    <label class="control-label">SEO title</label>
                    <div class="controls">
                        <input type="text" name="SEO[title]" value="{{ $seo->title }}" class="span12"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">SEO keywords</label>
                    <div class="controls">
                        <input type="text" name="SEO[keywords]" value="{{ $seo->keywords }}"  class="span12"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">SEO description</label>
                    <div class="controls">
                        <input type="text" name="SEO[description]" value="{{ $seo->description }}"  class="span12"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>