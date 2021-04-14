let dataPages = $('.data-table-page').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/page`,
    columns: [
        { data: "title", name : 'title' },
        { data: "author", name : 'author', orderable: false, searchable: false },
        { data: "updated_at", name : 'updated_at', orderable: false, searchable: false },
        { data: "status", name: "status", orderable: false, searchable: false},
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
});

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ****** Set main page ******
    $(`body`).on("click", "#setMainPage" , function() {
        var page_id = $(this).data('id');

        $.ajax({
            url: `mainpage/${page_id}`,
            type: "POST",
            cache: false,
            success: function(response){
                dataPages.ajax.reload();
                console.log(response)
            },
            error: function (response) {
                console.log("Error:", response.message);
            },
        });

    });

    // ****** Delete page ******
    $('body').on("click", "#deletePage", function () {
        let page_id = $(this).data("id");

        if (confirm('¿Estas seguro de querer borrar este registro?')) {
            $.ajax({
                url: `/pages/${page_id}`,
                type: 'DELETE',
                success: function (response) {
                    dataPages.ajax.reload();
                    console.log(response);
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        };

    });
});