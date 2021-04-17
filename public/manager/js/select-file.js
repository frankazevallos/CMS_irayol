/* OPEN INSERT FILE IN SUMMERNOTE */
const FMButton = function (context) {
    const ui = $.summernote.ui;
    const button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: "File Manager",
        click: function () {
            getMediaFiles();
            $("#insertMediaModal").modal("show");
            $(".insertButtonFile").attr("id", "insertFileSrc");
        },
    });
    return button.render();
};

$(".summernote").summernote({
    height: 650,
    dialogsInBody: true,
    codemirror: {
        theme: "monokai",
    },
    callbacks: {
        onInit: function () {
            $("body > .note-popover").hide();
        },
    },
    toolbar: [
        ["style", ["style"]],
        ["font", ["bold", "underline", "clear"]],
        ["fontname", ["fontname"]],
        ["color", ["color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["table", ["table"]],
        ["insert", ["link", "fm-button", ["fm"], "video"]],
        ["view", ["fullscreen", "codeview", "help"]],
    ],
    buttons: {
        fm: FMButton,
    },
});

// Hacemos peticiòn al servidor y mostramos el resultado en el id #insertFiles
function getMediaFiles(page, query){

    if (!page && !query) {
        page = 1;
        query = ' ';
    }

    $.ajax({
        url:"/getmediamodal/media?page="+page+"&query="+query,
        success: function(response){
            $('#insertFiles').html(''); // Limpiamos 
            $('#insertFiles').html(response); // Mostramos datos obtenidos
        }
    })
}

// Cuando el usuario haga click sobre la imagen se mostrarà el efecto de selecciòn y se asignarà src al botòn con #insertFile
$("body").on("click", ".selectedFileAndInsert", function () {
    
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected");
    } else {
        $('.selectedFileAndInsert').removeClass('selected');
        $(this).addClass("selected");
    }

    let file_src = $(this).data("src");
    
    $(".insertButtonFile").data("file", file_src);
});

// Cuando el uasuario haga clik en insertar se insertarà en summernote
$("body").on("click", "#insertFileSrc", function(){
    $("#insertMediaModal").modal("hide"); // cerramos la modal #insertMediaModal
    let srcMedia = $("#insertFileSrc").data("file");
    
    if (srcMedia != "") {
        $('#summernote').summernote('insertImage', srcMedia);
    }
});

// Insertar imagen destacada
$("body").on("click", ".insertMainImageModal", function(){
    getMediaFiles();
    $("#insertMediaModal").modal("show");
    $(".insertButtonFile").attr("id", "insertMainImage");
});

// Cuando el uasuario haga clik en insertar se insertarà en summernote
$("body").on("click", "#insertMainImage", function(){
    $("#insertMediaModal").modal("hide"); // cerramos la modal #insertMediaModal
    let srcMedia = $("#insertMainImage").data("file");
    
    if (srcMedia != "") {
        $('#main_image').val(srcMedia);
        $('#ImageMainSelect').attr('src', srcMedia);
    }
});

/* CLOSE INSERT FILE IN SUMMERNOTE */