/*Validar formulario*/
$(document).ready(function () {
    $('#sectionForm').validate({
        rules: {
            title: {
                required: true,
                minlength: 2,
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

// ****** Datatables Courses ******
let dataCourses = $('.data-table-courses').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/courses`,
    columns: [
        { data: "title", },
        { data: "author", orderable: false, searchable: false },
        {
            data: "categories[].name", fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                if (oData.categories.length > 0) {
                    let cat = ""
                    for (let index = 0; index < oData.categories.length; index++) {
                        let element = oData.categories[index];
                        cat += "<a class='badge badge-pill badge-primary mr-2' href='/categories/" + element.id + "'>" + element.name + "</a>"
                    }
                    $(nTd).html(cat);
                }
            }, orderable: false, searchable: false
        },
        { data: "updated_at", orderable: false, searchable: false },
        { data: 'action', orderable: false, searchable: false },
    ],
    deferRender: true,
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ****** Delete Courses ******
    $('body').on("click", "#deleteCourse", function () {
        let course_id = $(this).data("id");

        if (confirm('¿Estas seguro de querer borrar este registro?')) {
            $.ajax({
                url: `/courses/${course_id}`,
                type: 'DELETE',
                success: function (response) {
                    dataCourses.ajax.reload();
                    console.log(response);
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        };

    });
});