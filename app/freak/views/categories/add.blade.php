@extends('freak::elements.empty_add')

@section('form')
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <span class="title">Category</span>
            </div>
            <div class="tab-content widget-content form-container">
                <div class="tab-pane active" id="tab-01">
                    <form class="form-horizontal" method="POST">

                        <div class="control-group">
                            <label class="control-label" for="input05">Parent Category<br />
                            <small>Leave empty if no parent</small>
                            </label>
                            <div class="controls">
                                <select name="Category[parent_id]" id="input05">
                                    <option value="">No parent</option>
                                    @foreach($estateCategories as $estateCategory)
                                        @if($estateCategory->id == $category->parent_id)
                                        <option value="{{ $estateCategory->id }}" selected="selected">{{ $estateCategory->title }}</option>
                                        @else
                                        <option value="{{ $estateCategory->id }}">{{ $estateCategory->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="input05">Arabic Title</label>
                            <div class="controls">
                                <input type="text" name="Category[title]" id="input05" class="span12" value="{{ $category->ar('title') }}" required>
                            </div>
                        </div>

                        <input type="hidden" name="Category[language]" value="ar"/>
                    </form>


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
            </div>
        </div>
    </div>
</div>
@stop