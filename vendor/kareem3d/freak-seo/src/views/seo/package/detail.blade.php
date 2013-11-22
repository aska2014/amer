@if($seo)
<table class="table table-striped table-detail-view">
    <thead>
    <tr>
        <th>SEO information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Title</th>
        <td>
            {{ $seo->title }}
        </td>
    </tr>
    <tr>
        <th>Keywords</th>
        <td>
            {{ $seo->keywords }}
        </td>
    </tr>
    <tr>
        <th>Description</th>
        <td>
            {{ $seo->description }}
        </td>
    </tr>
    </tbody>
</table>
@endif