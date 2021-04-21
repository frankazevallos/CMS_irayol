let dataUsers = $('.data-table-users').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/users`,
    columns: [
        { data: "email" },
        { data: "email_verified_at" },
        { data: "name" },
        { data: "roles[].name", fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                if (oData.roles.length > 0) {
                    let rol = ""
                    for (let index = 0; index < oData.roles.length; index++) {
                        let element = oData.roles[index];
                        rol +=  '<span class="badge badge-pill badge-primary mr-2">'+element.name+'</span>'
                    }
                    $(nTd).html(rol);
                }
            }, orderable: false, searchable: false
        },
        { data: "updated_at", orderable: false, searchable: false },
        { data: 'action', orderable: false, searchable: false },
    ],
});

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ****** Delete category ******
    $('body').on("click", "#deleteUser", function () {
        let user_id = $(this).data("id");

        if (confirm('¿Estas seguro de querer borrar este registro?')) {
            $.ajax({
                url: `/users/${user_id}`,
                type: 'DELETE',
                success: function (response) {
                    dataUsers.ajax.reload();
                    console.log(response);
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        };

    });
});
