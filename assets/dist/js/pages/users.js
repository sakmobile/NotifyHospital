$(document).ready(function () {

    var dataTable = $('#user_table').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "./Users/getuserall",
            type: "POST",
            cache: false
        },
        "columnDefs": [
            {
                "targets": [0, 1, 2, 3, 4, 5],
                "orderable": false,
            },
        ],
    });


    $("#add_user").click(function (event) {
        event.preventDefault();
        var device = $('#device_select').val();
        var usercode = $('#add_user_code').val();
        var username = $('#add_user_name').val();
        var userposition = $('#add_user_position').val();
        var useremail = $('#add_user_email').val();

        if (usercode == "" && username == "") {
            $("#add_user_code").focus();
            swal({
                title: "กรอกข้อมูลไม่ครบ",
                text: "กรุณากรอก รหัสเจ้าหน้าที่ไม่ถูกต้อง และ ชื่อเจ้าหน้าที่ไม่ถูกต้อง",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK"
            });

        } else if (userposition == "") {

            $("#add_user_position").focus();
            swal({
                title: "กรอกข้อมูลไม่ครบ",
                text: "กรุณากรอก ตำแหน่งของเจ้าหน้าที่",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK"
            });

        } else if (device == "") {


            swal({
                title: "กรอกข้อมูลไม่ครบ",
                text: "กรุณาเลือกสังกัดหน่วยงาน",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK"
            });

        }
        else if (useremail == "") {

            $("#add_user_email").focus();
            swal({
                title: "กรอกข้อมูลไม่ครบ",
                text: "กรุณากรอก อีเมล",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK"
            });

        }

        if (usercode != "" && username != "" && device !== "" && userposition != "" && useremail !== "") {
            $.ajax({
                url: "./Users/add_username",
                type: "POST",
                data: {
                    user_code: usercode,
                    user_name: username,
                    user_position: userposition,
                    user_device: device,
                    user_email: useremail
                },
                cache: false,
                success: function (data) {
                    if (data) {

                        $('#add_user_model').modal('hide');
                        dataTable.ajax.reload();
                        $('#add_user_code').val("");
                        $('#add_user_name').val("");
                        $('#add_user_email').val("");
                        $('#add_user_position').val("");

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

    $(document).on('submit', '#user_form', function (event) {
        event.preventDefault();
        var edit_user_code = $('#up_user_code').val();
        var edit_user_name = $('#up_user_name').val();
        var edit_user_position = $('#up_user_position').val();
        var device_update = $('#device_update').val();
        var edit_user_id = $('#user_id').val();
        var edit_user_email = $('#up_user_email').val();


        $.ajax({
            url: "./Users/edit_user",
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

                $('#user_form')[0].reset();
                $('#update_user_model').modal('hide');
                dataTable.ajax.reload();
            }
        });
    });
    //ลบข้อมูลเจ้าหน้าที่

    $(document).on('click', '.delete_user', function () {
        var user_id = $(this).attr("id");
        console.log(user_id);
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
                    url: "./Users/delete_user",
                    method: "POST",
                    data: { id: user_id },
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
                            dataTable.ajax.reload();
                        }
                    }
                });
            })


    });










});

$(document).on('click', '.update_user', function () {
    var user_id = $(this).attr('id');
    console.log(user_id);
    $.ajax({
        url: "./Users/fetch_single_user",
        type: "POST",
        data: { 'id': user_id },
        dataType: "JSON",
        cache: false,
        success: function (datauser) {
            console.log(datauser.device_name + '  name');
            console.log(datauser.device_id + '  id');
            $('#update_user_model').modal('show');
            $('#up_user_code').val(datauser.user_code);
            $('#up_user_name').val(datauser.user_name);
            $('#up_user_email').val(datauser.user_email);
            $('#up_user_position').val(datauser.user_position);
            $('#edit_option').text(datauser.device_name);
            $('#edit_option').val(datauser.device_id);
            $('#user_id').val(user_id);

        }
    });


});