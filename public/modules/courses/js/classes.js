$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ****** Create class ******
    $("body").on("click", "#new-class", function () {
        $("#classForm").trigger("reset");
        $("#note").summernote("code", "");
        $("#classModalLabel").html("Nueva clase");
        $(".insertButtonClass").attr("id", "btnCreateClass");
        $("#classesModal").modal("show");
    });

    // ****** Store section ******
    $("body").on("click", "#btnCreateClass", function () {
        $.ajax({
            url: '/classes',
            type: 'POST',
            data: $("#classForm").serialize(),
            success: function (response) {
                console.log(response.data);

                let classCreate = `<div class="list-group-item list-group-flush" data-id="${response.data.id}" id="list_class_${response.data.id}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-arrows-alt handle mr-3"></i> ${response.data.title}
                        </div>
                        <div>
                            <a href="javascript:void(0)" id="edit-class" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" id="delete-class" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>`;

                $("#classForm").trigger("reset");
                $('#classesModal').modal('toggle')
                $("#class_loop_" + response.data.section_id).append(classCreate);

                Toast.fire({ icon: response.status, title: response.message });
            },
            error: function (response) {

                $.each(response.responseJSON.errors, function (key, value) {
                    console.log(key);
                    $('.' + key + '_err').text(value);
                });

                Toast.fire({ icon: 'error', title: response.responseJSON.message });
            }
        });
    });

    // ****** Edit class ******
    $("body").on("click", "#edit-class", function () {
        let class_id = $(this).data("id");
        $.get("/classes/" + class_id + "/edit", function (data) {
            console.log(data.message);
            $(".insertButtonClass").attr("id", "btnUpdateClass");
            $(".insertButtonClass").data("id", data.message.id);

            $("#class_id").val(data.message.id);
            $("#title_class").val(data.message.title);
            $("#section_class_id option[value='"+ data.message.section_id +"']").attr("selected",true);
            $("#is_active option[value='"+ data.message.is_active +"']").attr("selected",true);
            $("#media_type option[value='"+ data.message.media_type +"']").attr("selected",true);
            $("#url").val(data.message.url);
            $("#duration").val(data.message.duration);
            $("#access option[value='"+ data.message.access +"']").attr("selected",true);

            $("#note").summernote("code", data.message.note);

            $("#classModalLabel").html("Editar Clase");
            $(".insertButtonClass").attr("id", "btnUpdateClass");
            $("#classesModal").modal("show");
        });
    });

    // ****** Update section ******
    $("body").on("click", "#btnUpdateClass", function () {
        let class_id = $(this).data('id');

        $.ajax({
            url: '/classes/' + class_id,
            type: "PATCH",
            cache: false,
            data: $("#classForm").serialize(),
            success: function (response) {
                console.log(response.data);

                let classCreate = `<div class="list-group-item list-group-flush" data-id="${response.data.id}" id="list_class_${response.data.id}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-arrows-alt handle mr-3"></i> ${response.data.title}
                        </div>
                        <div>
                            <a href="javascript:void(0)" id="edit-class" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" id="delete-class" data-id="${response.data.id}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>`;

                $("#list_class_" + response.data.id).remove();
                $("#class_loop_" + response.data.section_id).append(classCreate);

                $("#classForm").trigger("reset");
                $('#classesModal').modal('toggle')
                Toast.fire({ icon: response.status, title: response.message });
            },
            error: function (response) {
                console.log("Error:", response.data);
            },
        });
    });

    //delete section
    $("body").on("click", "#delete-class", function () {
        let class_id = $(this).data("id");

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
                        url: "/classes/" + class_id,
                        type: "DELETE",
                        success: function (data) {
                            $("#card_class_" + class_id).remove();
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

$('.sortabe').sortable({
    handle: '.handle',
    invertSwap: true,
    animation: 150,
    store: {
        set: function (sortabe) {

            let order = {};

            $('.list-group-item').each(function() {
                order[$(this).data('id')] = $(this).index();
            });

            $.ajax({
                url: '/classes/order',
                type: 'POST',
                data: {order: order},
                success: function(data){
                    console.log(data)
                    Toast.fire({ icon: data.status, title: data.message });
                }
            })
        }
    }
})
