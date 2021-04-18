let dataCategory = $('.data-table-category').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/category`,
    columns: [
        { data: "name", name : 'name' },
        { data: "is_active", name : 'is_active', orderable: false, searchable: false},
        { data: "updated_at", name : 'updated_at', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
});

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ****** Delete category ******
    $('body').on("click", "#deleteCategory", function () {
        let category_id = $(this).data("id");

        if (confirm('¿Estas seguro de querer borrar este registro?')) {
            $.ajax({
                url: `/categories/${category_id}`,
                type: 'DELETE',
                success: function (response) {
                    dataCategory.ajax.reload();
                    console.log(response);
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        };

    });
});