let dataSetting = $('.data-table-setting').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `/ajaxindex/setting`,
    columns: [
        { data: "key" },
        { data: "value" },
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

    // ****** Edit menu ******
    $("body").on("click", "#editSetting", function () {
        let setting_id = $(this).data("id");
        $.get("/setting/" + setting_id + "/edit", function (response) {
            $("#editSettingModal").modal("show");
            $("#key").val(response.message.key);
            $("#value").val(response.message.value);
            $("#btnUpdateSetting").data('id', response.message.id)
        });
    });


    // ****** Update menu ******
    $("body").on("click", "#btnUpdateSetting", function (){
        let setting_id = $(this).data('id');
        let key = $('#key').val();
        let value = $('#value').val();

        if(value !== ''){
            $.ajax({
                url: '/setting/' + setting_id,
                type: "PATCH",
                cache: false,
                data: {key, value},
                success: function(response){
                    console.log(response.message);
                    dataSetting.ajax.reload();
                    $('#key').addClass('is-valid');
                    $('#value').addClass('is-valid');
                },
                error: function (response) {
                    console.log("Error:", response.message);
                    $('#key').addClass('is-invalid');
                    $('#value').addClass('is-invalid');
                },
            });
        }
    });

});
