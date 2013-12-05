@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Banner</span>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Banner size</label>
                            <div class="controls">
                                <select name="Banner[banner_place_id]" required>
                                    <option value="">Select banner size</option>
                                    @foreach($bannerPlaces as $bannerPlace)
                                    @if($banner->banner_place_id == $bannerPlace->id)
                                    <option selected="selected" value="{{ $bannerPlace->id }}">{{ $bannerPlace->size }}</option>
                                    @else
                                    <option value="{{ $bannerPlace->id }}">{{ $bannerPlace->size }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Banner from date</label>
                            <div class="controls">
                                <input type="text" class="span12 timepicker-date" name="Banner[from]" value="{{ date('m/d/Y H:i', strtotime($banner->from)) }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Banner to date</label>
                            <div class="controls">
                                <input type="text" class="span12 timepicker-date" name="Banner[to]" value="{{ date('m/d/Y H:i', strtotime($banner->to)) }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Url</label>
                            <div class="controls">
                                <input type="text" class="span12" name="Banner[url]" value="{{ $banner->url }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">

    $(document).ready(function()
    {
        $(".timepicker-date").datetimepicker();
    });

    $(document).ready(function()
    {
        var html = new HtmlSubmitter($("#dialog-modal"));

        var submitter = new Submitter($('.form-container').find('form'), html, "{{ freakUrl('element/banner/edit') }}");

        $(".forms-submit").click(function( e )
        {
            e.preventDefault();

            submitter.run();

        });
    });


</script>
@stop