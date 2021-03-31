$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    if( $('#enable_custom_link').prop('checked') ) {
        $("#show_enable_custom_link").show();
    } else {
        $("#show_enable_custom_link").hide();
    }

    $("#enable_custom_link").click(function() {
        if($(this).is(":checked")) {
            $("#show_enable_custom_link").show();
        } else {
            $("#show_enable_custom_link").hide();
        }
    });

    $('#user_id').select2({
        theme: 'bootstrap4',
        ajax: {
            url: '/paysubscriptions/subscriptions/getuser',
            dataType: 'json',
            type: "post",
            delay: 250,
            data: function (params) {
                let query = {
                    search: params.term,
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (data) {
                        return {
                            text: data.name,
                            id: data.id
                        }
                    })
                };
            },
            cache: true
        },
    });



    $('#package_id').select2({
        theme: 'bootstrap4',
        ajax: {
            url: '/paysubscriptions/subscriptions/getpackage',
            dataType: 'json',
            type: "post",
            delay: 250,
            data: function (params) {
                let query = {
                    search: params.term,
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (data) {
                        return {
                            text: data.name,
                            id: data.id
                        }
                    })
                };
            },
            cache: true
        }
    });

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

    $('#start_date').datetimepicker({
        date: moment($('#start_date').val()),
        format: date_format,
        icons: icons,
    });

    $('#trial_end_date').datetimepicker({
        date: moment($('#trial_end_date').val()),
        format: date_format,
        icons: icons,
    });

    $('#end_date').datetimepicker({
        date: moment($('#end_date').val()),
        format: date_format,
        icons: icons,
    });
});
