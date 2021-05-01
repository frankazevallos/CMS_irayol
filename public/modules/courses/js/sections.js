$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ****** Create section ******
    $("body").on("click", "#new-section", function () {
        $("#sectionModalLabel").html("Create secciòn");
        $(".insertButtonSection").attr("id", "btnCreateSection");
        $("#sectionModal").modal("show");
    });

    // ****** Store section ******
    $("body").on("click", "#btnCreateSection", function () {
        let course_id = $('#idCourseCreate').val();
        let title = $('#titleSectionCreate').val();
        if (title !== '') {
            $.ajax({
                url: '/sections',
                type: 'POST',
                data: {course_id, title},
                success: function (response) {
                    console.log(response);
                    let sectionCreate = `<div class="card" id="card_section_${response.data.id}">
                        <div class="card-header" id="section_id_${response.data.id}">
                            <h3 class="card-title">${response.data.title}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <a href="javascript:void(0)" id="edit-section" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" id="delete-section" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">

                        </div>
                    </div>`;

                    $("#sectionForm").trigger("reset");
                    $('#sectionModal').modal('toggle')
                    $('#section-loop').append(sectionCreate);
                    Toast.fire({ icon: response.status, title: response.message });
                },
                error: function (response) {
                    console.log("Error:", response.message);
                    Toast.fire({ icon: response.status, title: response.message });
                }
            });
        }
    });

    // ****** Edit section ******
    $("body").on("click", "#edit-section", function () {
        let section_id = $(this).data("id");
        $.get("/sections/" + section_id + "/edit", function (data) {
            $("#sectionModalLabel").html("Edit Section");

            $(".insertButtonSection").attr("id", "btnUpdateSection");
            $(".insertButtonSection").data("id", data.message.id);

            $("#sectionModal").modal("show");
            $("#titleSectionCreate").val(data.message.title);
        });
    });

    // ****** Update section ******
    $("body").on("click", "#btnUpdateSection", function () {
        let section_id = $(this).data('id');
        let title = $('#titleSectionCreate').val();

        if (title !== '') {
            $.ajax({
                url: '/sections/' + section_id,
                type: "PATCH",
                cache: false,
                data: { title },
                success: function (response) {
                    console.log(response.data);

                    let sectionUpdate = `<div class="card-header" id="section_id_${response.data.id}">
                        <h3 class="card-title">${response.data.title}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <a href="javascript:void(0)" id="edit-section" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" id="delete-section" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>`;

                    $("#sectionForm").trigger("reset");
                    $('#sectionModal').modal('toggle')
                    $("#section_id_" + response.data.id).replaceWith(sectionUpdate);
                    Toast.fire({ icon: response.status, title: response.message });
                },
                error: function (response) {
                    console.log("Error:", response.data);
                },
            });
        }
    });

    // ****** Delete section ******
    $("body").on("click", "#delete-section", function () {
        let section_id = $(this).data("id");

        Swal.fire({
            title: "¿Eliminar?",
            text: "¡Asegúrate y luego confirma!",
            type: "warning",
            cancelButtonText: "¡No, cancelar!",
            confirmButtonText: "¡Sí, bórralo!",
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#007bff",
        }).then(
            function (e) {
                if (e.value === true) {
                    $.ajax({
                        url: "/sections/" + section_id,
                        type: "DELETE",
                        success: function (data) {
                            $("#card_section_" + section_id).remove();
                            Toast.fire({ icon: data.status, title: data.message });
                        },
                        error: function (data) {
                            console.log("Error:", data);
                            Toast.fire({ icon: data.status, title: data.message });
                        },
                    });
                } else {
                    e.dismiss;
                }
            },
            function (dismiss) {
                return false;
            }
        );
    });
});
