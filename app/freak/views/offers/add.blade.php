@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Special Offer</span>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Duration</label>
                            <div class="controls">
                                <input type="number" name="SpecialOffer[duration_period]" class="span6" value="{{ $specialOffer->duration_period }}"/>
                                <select name="SpecialOffer[duration_type]" id="special-offer-duration-type" class="span6">
                                    <option value="day">Day</option>
                                    <option value="week">Week</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="input05">Price in L.E</label>
                            <div class="controls">
                                <input type="text" name="SpecialOffer[price]" id="input05" class="span12" value="{{ $specialOffer->price }}" required>
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
@parent
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#special-offer-duration-type").val('{{ $specialOffer->duration_type }}');
    });
</script>
@stop