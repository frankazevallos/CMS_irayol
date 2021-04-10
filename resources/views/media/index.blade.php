@extends('layouts.app')
@push('title', 'Media')
@section('content')
    {{-- @livewire('media') --}}
    <div class="card">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="float-left">
                        <form method='post' id="mediaForm" class="form-inline" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="files"><span class="btn btn-info"><i class="fas fa-plus-circle"></i> <span id="file_count">0</span></span></label>
                                <input type="file" id='files' name="files[]" hidden  multiple required><br>
                                <button type="submit" id="submit" class="btn btn-primary ml-2" disabled><i class="fas fa-file-upload"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right form-inline">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="{{__('global.search')}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary my-2 my-sm-0"><i class="fas fa-times-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="medias"></div>
    </div>

@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("body").on("change", "#files", function(){
            let mediaCount = document.getElementById('files').files.length
            $("#file_count").text(mediaCount);
            if(mediaCount > 0){
                $("#submit").attr("disabled", false);
            }
        });

        $('#submit').click(function(){

            let form_data = new FormData();

            // Read selected files
            let totalfiles = document.getElementById('files').files.length;
            
            for (let index = 0; index < totalfiles; index++) {
                form_data.append("files[]", document.getElementById('files').files[index]);
            }

            // AJAX request
            $.ajax({
                url: '/media', 
                type: 'post',
                data: form_data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    for(let index = 0; index < response.message.length; index++) {
                        let src = response.message[index];
                        $('.ajaxMediaShow').prepend(`
                            <div class="col-md-2 mt-3 show-image">
                                <div class="card-body img-card-background loading filter image" style="background-image: url('${src}'); "></div>
                            </div>`
                        );
                    }
                    $("#file_count").text(0);
                    $("#submit").attr("disabled", true);
                },
                error: function (response) {
                    console.log("Error:", response.message);
                },
            });
        });

        // Ajax Paginate
        function getData(page){
            if(!page) page=1;

            $.get('ajaxindex/media?page=' + page, function(data){
                $('#medias').html(data)
            });
        }

        getData();

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault(); 
            var page = $(this).attr('href').split('page=')[1];
            getData(page);
        });
    });
</script>
@endpush