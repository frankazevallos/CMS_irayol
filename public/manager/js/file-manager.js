/* **** FILE MANAGER **** */
$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
});

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

    // ****** Store media ******
    $('#submit').click(function(){

        let form_data = new FormData();

        // Read selected files
        let totalfiles = document.getElementById('files').files.length;
        
        for (let index = 0; index < totalfiles; index++) {
            form_data.append("files[]", document.getElementById('files').files[index]);
        }

        $.ajax({
            url: '/media', 
            type: 'POST',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                for(let index = 0; index < response.message.length; index++) {
                    
                    let src = response.message[index].path;
                    let mediaId = response.message[index].id;
                    $('.ajaxMediaShow').prepend(`
                        <div class="col-md-2 mt-3" id="card_media_${mediaId}">
                            <div class="card-body img-card-background loading filter image" style="background-image: url('${src}'); ">
                                <div class="card-tools">
                                    <a href="javascript:void(0)" id="showMedia" data-id="${mediaId}" class="btn btn-tool"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
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
    
    // ****** Edit media media ******
    $("body").on("click", "#btnUpdateMedia" , function() {
        var media_id = $(this).data('id');

        var file = $('#titleFile').val();

        if(file != ''){
            $.ajax({
                url: 'media/' + media_id,
                type: "PATCH",
                cache: false,
                data: {file},
                success: function(response){
                    $('#titleFile').addClass('is-valid');
                },
                error: function (response) {
                    console.log("Error:", response.message);
                    $('#titleFile').addClass('is-invalid');
                },
            });
        }
    });

    // ****** Show media media ******
    $("body").on("click", "#showMedia", function () {
        let media_id = $(this).data("id");
        $.get("/media/" + media_id + "/edit", function (response) {
            $("#editMediaModal").modal("show");

            $('#mediaModalImage').attr('src', response.message.path);
            $("#mediaCreatedAt").text(moment(response.message.created_at).format("YYYY-MM-DD HH:mm:ss"));
            $("#linkMedia").attr({"href" : response.message.filePath, "title" : response.message.file, "target" : "_blank"});
            $("#linkMedia").text(response.message.filePath);
            $("#mediaSize").text(response.message.size);
            $("#titleFile").val(response.message.file);
            $("#deleteMedia").data('id', response.message.id)
            $("#btnUpdateMedia").data('id', response.message.id)
        });
    });

    // ****** Delete media media ******
    $("body").on("click", "#deleteMedia", function () {
        let media_id = $(this).data("id");
        if (confirm('¿Estas seguro de querer borrar este registro?')) {
            $.ajax({
                url: "/media/" + media_id,
                type: "DELETE",
                success: function (response) {
                    console.log(response);
                    $("#editMediaModal").modal("toggle");
                    $("#card_media_" + media_id).remove();
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        };
    });

    // ****** Paginate and search ajax ******
    $('#clearSearchFiles').click(function(){
        $('#searchFiles').val('');
        getData();
    });

    function getData(page, query){

        if (!page && !query) {
            page = 1;
            query = ' ';
        }

        $.ajax({
            url:"ajaxindex/media?page="+page+"&query="+query,
            success: function(data)
            {
                $('#medias').html('');
                $('#medias').html(data);
            }
        })
    }

    getData();

    $(document).on('keyup', '#searchFiles', function(){
        let query = $('#searchFiles').val();
        let page = $('#hidden_page').val();

        if(query.length > 0){
            $("#clearSearchFiles").attr("disabled", false);
        }

        getData(page, query);
    });

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#searchFiles').val();

        $('li').removeClass('active');
        $(this).parent().addClass('active');
        getData(page, query);
    });

});
/* **** FILE MANAGER **** */