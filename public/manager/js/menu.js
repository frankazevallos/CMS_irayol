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
    $(`body`).on("click", "#setMainMenu", function() {
        let menu_id = $(this).data('id');
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

    // ****** Create menu ******
    $("body").on("click", "#btnCreateMenu", function(){
        let title = $('#titleMenuCreate').val();
        if (title !== '') {
            $.ajax({
                url: '/menu',
                type: 'POST',
                data: {title},
                cache: false,
                success: function(response){
                    dataMenu.ajax.reload();
                    $('#titleMenuCreate').addClass('is-valid');
                },
                error: function(response){
                    console.log("Error:", response.message);
                    $('#titleMenuCreate').addClass('is-invalid');
                }
            });
        }
    });

    // ****** Edit menu ******
    $("body").on("click", "#editMenu", function () {
        let menu_id = $(this).data("id");
        $.get("/menu/" + menu_id + "/edit", function (response) {
            $("#editMediaModal").modal("show");
            $("#titleMenuEdit").val(response.message.title);
            $("#btnUpdateMenu").data('id', response.message.id)
        });
    });


    // ****** Update menu ******
    $("body").on("click", "#btnUpdateMenu", function (){
        let menu_id = $(this).data('id');
        let title = $('#titleMenuEdit').val();

        if(title !== ''){
            $.ajax({
                url: '/menu/' + menu_id,
                type: "PATCH",
                cache: false,
                data: {title},
                success: function(response){
                    console.log(response.message);
                    dataMenu.ajax.reload();
                    $('#titleMenuEdit').addClass('is-valid');
                },
                error: function (response) {
                    console.log("Error:", response.message);
                    $('#titleMenuEdit').addClass('is-invalid');
                },
            });
        }
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
        }

    });
});
