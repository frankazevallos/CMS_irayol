let dataBlogs = $('.data-table-blog').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/blog`,
    columns: [
        { data: "title", name : 'title' },
        { data: "author", name : 'author', orderable: false, searchable: false },
        { data: "updated_at", name : 'updated_at', orderable: false, searchable: false },
        { data: "category", name: "category", orderable: false, searchable: false},
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
});

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ****** Delete page ******
    $('body').on("click", "#deleteBlog", function () {
        let page_id = $(this).data("id");

        if (confirm('¿Estas seguro de querer borrar este registro?')) {
            $.ajax({
                url: `/blogs/${page_id}`,
                type: 'DELETE',
                success: function (response) {
                    dataBlogs.ajax.reload();
                    console.log(response);
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        };

    });
});