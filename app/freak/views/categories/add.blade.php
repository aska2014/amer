@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Category</span>
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
                            <label class="control-label" for="input05">English Title</label>
                            <div class="controls">
                                <input type="text" name="Category[title]" id="input05" class="span12" value="{{ $category->en('title') }}" required>
                            </div>
                        </div>

                        <input type="hidden" name="Category[language]" value="en"/>
                    </form>
                </div>
                <div class="tab-pane" id="tab-02">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Arabic Title</label>
                            <div class="controls">
                                <input type="text" name="Category[title]" id="input05" class="span12" value="{{ $category->ar('title') }}" required>
                            </div>
                        </div>

                        <input type="hidden" name="Category[language]" value="ar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop