$(document).ready(function () {

    s_d();

    var dataTable = $('#Device_data').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "./Department/fetch_user",
            type: "POST",
            cache: false
        },
        "columnDefs": [{
            "targets": [0, 1, 2, 3, 4],
            "orderable": false,
        },],
    });
    $(document).on('submit', '#device_form', function (event) {
        event.preventDefault();
        var edit_device_code = $('#up_device_code').val();
        var edit_device_name = $('#up_device_name').val();
        var edit_device_token_line = $('#up_device_token_line').val();

        var edit_device_id = $('#device_id').val();
        $.ajax({
            url: "./Department/edit_device",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $.notify({
                    // options
                    icon: 'glyphicon glyphicon-ok',
                    title: '',
                    message: 'แก้ไขข้อมูลเรียบร้อย',
                }, {
                        element: 'body',
                        position: null,
                        type: "info",
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: false,
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                        delay: 2000,
                        timer: 1000,
                        url_target: '_blank',
                        mouse_over: null,
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        }
                    });

                $('#device_form')[0].reset();
                $('#update_device').modal('hide');
                dataTable.ajax.reload();
            }
        });
    });

    $(document).on('click', '.delete_device', function () {

        var device_id = $(this).attr("id");
        console.log(device_id);
        swal({
            title: "คุณต้องการลบใช่หรือไม่?",
            text: "หากลบแล้วจะไม่สามารถกู้คืนได้อีก!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'ลบ!',

            cancelButtonText: 'ยกเลิก'

        },
            function () {
                $.ajax({
                    url: "./Department/delete_device",
                    method: "POST",
                    data: { id: device_id },
                    success: function (data) {
                        if (data) {
                            $.notify({
                                // options
                                icon: 'glyphicon glyphicon-trash',
                                title: '',
                                message: 'ลบข้อมูลเรียบร้อย',
                            }, {

                                    element: 'body',
                                    position: null,
                                    type: "danger",
                                    allow_dismiss: true,
                                    newest_on_top: false,
                                    showProgressbar: false,
                                    placement: {
                                        from: "top",
                                        align: "right"
                                    },
                                    offset: 20,
                                    spacing: 10,
                                    z_index: 1031,
                                    delay: 2000,
                                    timer: 1000,
                                    url_target: '_blank',
                                    mouse_over: null,
                                    animate: {
                                        enter: 'animated fadeInDown',
                                        exit: 'animated fadeOutUp'
                                    }
                                });
                            dataTable.ajax.reload();
                        }
                    }
                });
            })


    });




    $("#add_device").click(function (event) {

        event.preventDefault();
        var add_device_code = $("#add_device_code").val();
        var add_device_name = $("#add_device_name").val();
        var add_device_token_line = $("#add_device_token_line").val();



        if (add_device_name == "" && add_device_code == "") {
            $("#add_device_name").focus();
            swal({
                title: "กรอกข้อมูลไม่ครบ",
                text: "กรุณากรอก ชื่อหน่วยงาน และ รหัสหน่วยงาน",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK"
            });

        } else if (add_device_name == "") {

            $("#add_device_name").focus();
            swal({
                title: "กรอกข้อมูลไม่ครบ",
                text: "กรุณากรอก ชื่อหน่วยงาน",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK"
            });

        } else if (add_device_token_line == "") {

            $("#add_device_token_line").focus();
            swal({
                title: "กรอกข้อมูลไม่ครบ",
                text: "กรุณากรอก TokenLine",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK"
            });

        }

        if (add_device_name != "" && add_device_token_line != "" && add_device_code !== "") {
            $.ajax({
                url: "./Department/add_device",
                type: "POST",
                data: {
                    code_device: add_device_code,
                    name_device: add_device_name,
                    token_line: add_device_token_line,


                },
                cache: false,
                success: function (data) {
                    if (data) {

                        $('#add_device_model').modal('hide');
                        dataTable.ajax.reload();
                        $('#add_device_code').val("");
                        $('#add_device_token_line').val("");
                        $('#add_device_name').val("");


                        $.notify({
                            // options
                            icon: 'glyphicon glyphicon-ok',
                            title: '',
                            message: 'บันทึกข้อมูลเรียบร้อย',
                        }, {
                                element: 'body',
                                position: null,
                                type: "info",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: false,
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 2000,
                                timer: 1000,
                                url_target: '_blank',
                                mouse_over: null,
                                animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                                }
                            });

                    }
                }
            });
        }

    });


});
$(document).on('click', '.update_device', function () {
    var device_id = $(this).attr('id');

    $.ajax({
        url: "./Department/fetch_single_device",
        type: "POST",
        data: { 'id': device_id },
        dataType: 'JSON',
        cache: false,
        success: function (data) {
            console.log(data.Device_name + 'name');
            console.log(data.Device_token + 'token');
            $('#update_device').modal('show');
            $('#up_device_code').val(data.Device_code);
            $('#up_device_name').val(data.Device_name);
            $('#up_device_token_line').val(data.token_line);
            $('#device_id').val(device_id);


        }
    })





});

function s_d() {
    $.ajax({
        url: "./Devices/get_all_device",
        type: "POST",
        dataType: 'JSON',
        timeout: 2000,
        success: function (data) {
            for (i = 0; i < data.length; i++) {

                if (data[i].Device_status == "online") {
                    $("#status").append(" <div class='col-md-3 col-sm-6 col-xs-12'> " +
                        "<div class='info-box'>" +
                        "<span class='info-box-icon bg-aqua'><i class='fa fa-home'></i></span>" +

                        "<div class='info-box-content'>" +
                        "<span class='info-box-text'><h4>" + data[i].Device_name + "</h4></span>" +
                        "<span class='info-box-number'><small>สถาณะ : ทำงานปกติ</small></span>" +
                        "</div>" +

                        "</div>" +

                        "</div>");


                } else {
                    $("#status").append(" <div class='col-md-3 col-sm-6 col-xs-12'> " +
                        "<div class='info-box'>" +
                        "<span class='info-box-icon'><i class='fa fa-question'></i></span>" +

                        "<div class='info-box-content'>" +
                        "<span class='info-box-text'><h4>" + data[i].Device_name + "</h4></span>" +
                        "<span class='info-box-number'><small>สถาณะ : ไม่ทำงาน </small></span>" +
                        "</div>" +

                        "</div>" +

                        "</div>");


                }

            }

        }


    });


}