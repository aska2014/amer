@if($image = $model->getImage( $imageType ))
    @if($image->exists())
    <div class="gallery-imgs" style="margin:20px;">
        <img src="{{ $image->getSmallest() }}" style="width:100px;" />
    </div>
    @endif
@endif
<style type="text/css">
    .gallery-imgs:hover .delete-icon{
        visibility: visible;;
    }
</style>