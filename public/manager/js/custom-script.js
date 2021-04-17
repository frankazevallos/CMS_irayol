/* OPEN GLOBAL CONST */
const icons = {
    time: 'fas fa-clock',
    date: 'fas fa-calendar',
    up: 'fas fa-arrow-up',
    down: 'fas fa-arrow-down',
    previous: 'fas fa-arrow-circle-left',
    next: 'fas fa-arrow-circle-right',
    today: 'far fa-calendar-check-o',
    clear: 'fas fa-trash',
    close: 'far fa-times'
}

const date_format = 'YYYY-MM-DD HH:mm';
/* CLOSE GLOBAL CONST */

//Close alert
window.setTimeout(function () {
    $(".alert-remove").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 3000);

$(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap4',
        tags: true,
    });
});

$(document).ready(function () {
    $(".filter-button").click(function () {
        var value = $(this).attr("data-filter");
        if (value == "all") {
            $(".filter").show("1000");
        } else {
            $(".filter").not("." + value).hide("3000");
            $(".filter").filter("." + value).show("3000");
        }
    });

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");
});

$(document).ready(function () {
    var url = window.location;
    $('ul.nav a[href="' + url + '"]')
        .parent()
        .addClass("active");
    $("ul.nav a").filter(function () {
        return this.href == url;
    }).parent().addClass("active");
});

$(document).on('click', '.dropdown-menu', ($event) => $event.stopPropagation());

if ($(window).width() < 992) {
    $('.dropdown-menu a').click(($event) => {
        $event.preventDefault();
        if ($(this).next('.submenu').length) {
            $(this).next('.submenu').toggle();
        }
        $('.dropdown').on('hide.bs.dropdown', () => $(this).find('.submenu').hide());
    });
}

/* **** CREATE AND EDIT BLOG **** */
$('#published_at').datetimepicker({
    date: moment($('#published_at').val()),
    format: date_format,
    icons: icons,
});



/* ****MENU**** */
$(document).ready(function () {
    $("li .dd-item").each(function (list) {
        if ($(this).parents("ol").length === 1) {
            $(this).find("#mega-menu-area").show(500);
        } else {
            $(this).find("#mega-menu-area").hide(500);
        }
    });

    $("#expend-icon").on("click", function () {
        let abc = $(this).parent().find(".expended-menu-item").html();
        $(".expended-menu-item").each(function () {
            if (abc === $(this).html()) {
                if ($(this).css("display") === "none") {
                    $(this).show(500);
                } else {
                    $(this).hide(500);
                }
            } else {
                $(this).hide(500);
            }
        });
    });

    $("#nestable3").nestable().on("change", function (e) {
        $("li.dd-item").each(function (list) {
            if ($(this).parents("ol").length === 1) {
                $(this).find("#mega-menu-area").show();
            } else {
                $(this).find("#mega-menu-area").hide();
            }

            if ($(this).parents("ol").length === 1) {
                $(this).find("#menu_lenght").val(1);
            } else if ($(this).parents("ol").length === 2) {
                $(this).find("#menu_lenght").val(2);
            } else if ($(this).parents("ol").length === 3) {
                $(this).find("#menu_lenght").val(3);
            }
        });
    });
});

$(document).on("submit", "form#update-menu-item", function (event) {
    $("li.dd-item").each(function (list, this2) {
        if ($(this2).parents("ol").length === 1) {
            if ($(this2).find("#is_mega_menu").val() === "tab" && $(this2).find("#is_mega_menu").val() === "no") {
                $(this2).find("li.dd-item").each(function (ii, this3) {
                    if ($(this3).find("#source").val() !== "category") {
                        $.notify("You can make child only category for tab mega menu.", "danger");
                        return false;
                    }
                    if ($(this3).parents("ol").length === 3) {
                        $.notify("You can make child length max 2.", "danger");
                        return false;
                    }
                });
            }
        }
    });
});

function delete_menu_item(row_id) {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let table_row = '#' + row_id;

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
                    url: '/menu-item/delete',
                    type: 'delete',
                    data: 'row_id=' + row_id,
                    dataType: 'json',
                    success: function (data) {
                        $(table_row).fadeOut(2000);
                    },
                    error: function (data) {
                        console.log("Error:", data);
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
}
