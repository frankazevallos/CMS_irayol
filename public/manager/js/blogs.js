$('#published_at').datetimepicker({
    date: moment($('#published_at').val()),
    format: date_format,
    icons: icons,
});

let dataBlogs = $('.data-table-blog').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/blog`,
    columns: [
        { data: "title", },
        { data: "author", orderable: false, searchable: false },
        { data: "categories[].name", fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                if (oData.categories.length > 0) {
                    let cat = ""
                    for (let index = 0; index < oData.categories.length; index++) {
                        let element = oData.categories[index];
                        cat +=  "<a class='badge badge-pill badge-primary mr-2' href='/categories/"+element.id+"'>"+element.name+"</a>"
                    }
                    $(nTd).html(cat);
                }
            },  orderable: false, searchable: false
        },
        { data: "updated_at", orderable: false, searchable: false },
        { data: 'action', orderable: false, searchable: false },
    ],
    deferRender: true,
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
