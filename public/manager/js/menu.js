let dataMenu = $('.data-table-menu').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/menu`,
    columns: [
        { data: "title", name : 'title' },
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
    $(`body`).on("click", "#setMainMenu" , function() {
        var menu_id = $(this).data('id');

        $.ajax({
            url: `mainmenu/${menu_id}`,
            type: "POST",
            cache: false,
            success: function(response){
                dataMenu.ajax.reload();
                console.log(response)
            },
            error: function (response) {
                console.log("Error:", response.message);
            },
        });

    });

    // ****** Delete page ******
    $('body').on("click", "#deleteMenu", function () {
        let menu_id = $(this).data("id");

        if (confirm('¿Estas seguro de querer borrar este registro?')) {
            $.ajax({
                url: `/menu/${menu_id}`,
                type: 'DELETE',
                success: function (response) {
                    dataMenu.ajax.reload();
                    console.log(response);
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        };

    });
});