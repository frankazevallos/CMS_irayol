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
        //minimumInputLength: 2,
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

    // Datatable
    $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "/paysubscriptions/ajaxindex/packages",
        columns: [
            { data: "name", name : 'name' },
            { data: "interval", name : 'interval' },
            { data: "interval_count", name : 'interval_count' },
            { data: "trial_days", name : 'trial_days' },
            { data: "price", name : 'price' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

    $('.data-table-subscription').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "/paysubscriptions/ajaxindex/subscriptions",
        columns: [
            { data: "user" },
            { data: "package" },
            { data: "status" },
            { data: "start_date" },
            { data: "trial_end_date" },
            { data: "end_date" },
            { data: 'action', orderable: false, searchable: false },
        ],
    });

    moment.locale('es');
    let start = moment().subtract(29, 'days');
    let end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Los últimos 7 días': [moment().subtract(6, 'days'), moment()],
           'Los últimos 30 días': [moment().subtract(29, 'days'), moment()],
           'Este mes': [moment().startOf('month'), moment().endOf('month')],
           'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
    }, function(start, end){
        $.ajax({
            url: "/paysubscriptions/getsubscriptionanalytics/subscriptions",
            type: "POST",
            data: {from: start.format('YYYY-MM-DD'), to: end.format('YYYY-MM-DD')},
            dataType: "json",
            success: function (data) {
                $(".subscriptions").html(data.message.subscriptions);
                $(".total_subscripciones").html("$" + Number(data.message.total_subscripciones).toFixed(2));
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });

    cb(start, end);
});
