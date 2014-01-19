@extends('freak::master.layout1')

@section('content')
<form action="{{ freakUrl('element/estate/accept-many') }}" method="POST">
    <div class="row-fluid">
        <div class="span12 widget">
            <div class="widget-header">
                <span class="title">{{ $element->getName() }}</span>
            </div>
            <div class="widget-content table-container">
                <table id="demo-dtable-02" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Accepted</th>
                        <th>Has payment</th>
                        <th>Make special</th>
                        <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estates as $estate)
                    <tr>
                        <td>{{ $estate->id }}</td>
                            <td>{{ $estate->ar('title') }}</td>
                        <td>
                            @if($category = $estate->category)
                            <a href="{{ freakUrl('element/category/show/' . $category->id) }}">
                                {{ $category->ar('title') }}
                            </a>
                            @endif
                        </td>
                        <td>
                            <input type="hidden" name="Estate[accepted_ids][]" value="{{ $estate->id }}"/>
                            <input type="checkbox" name="Estate[accepted][{{ $estate->id }}]" data-provide="ibutton" data-label-on="Yes" data-label-off="No"
                                {{ $estate->accepted ? 'checked="checked"' : '' }}
                                />
                        </td>

                        @if($estate->hasPayments())
                        <td><a href="{{ freakUrl('element/payment/show-by-estate/'.$estate->id)  }}">Show payments</a></td>
                        @else
                        <td>{{ $estate->hasPayments() ? 'Yes' : 'No' }}</td>
                        @endif

                        <td>
                            <a href="{{ freakUrl('element/estate/make-special/'. $estate->id) }}" class="btn btn-info">Make special</a>
                        </td>

                        <td class="action-col" width="10%">
                            <span class="btn-group">
                                <a href="{{ freakUrl($element->getUri('show/'.$estate->id)) }}" class="btn btn-small"><i class="icon-search"></i></a>
                                <a href="{{ URL::page('estate/edit', $estate) }}" class="btn btn-small"><i class="icon-pencil"></i></a>
                                <a href="{{ freakUrl($element->getUri('delete/'.$estate->id)) }}" class="btn btn-small"><i class="icon-trash"></i></a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Accepted</th>
                        <th>Has payment</th>
                        <th>Make special</th>
                        <th>Tools</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-success" value="Update estate accepted state"/>
</form>
@stop
