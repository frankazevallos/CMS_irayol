<div class="card-body">
    <div class="row ajaxMediaShow">
        @foreach($medias as $media)
            <div class="col-md-2 mt-3 show-image">
                <div class="card-body img-card-background loading filter image" style="background-image: url('{{ $media->getFile() }}'); ">
                    
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card-footer">
    {!! $medias->render() !!}
</div>
