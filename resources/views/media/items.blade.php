<div class="card-body">
    <div class="row ajaxMediaShow">
        @foreach($medias as $media)
            <div class="col-md-2 mt-3" id="card_media_{{ $media->id }}">
                <div class="card-body img-card-background loading filter image" style="background-image: url('{{ $media->getFile() }}'); ">
                    <div class="card-tools">
                        <a href="javascript:void(0)" id="showMedia" data-id="{{ $media->id }}" class="btn btn-tool"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card-footer">
    {!! $medias->render() !!}
</div>
