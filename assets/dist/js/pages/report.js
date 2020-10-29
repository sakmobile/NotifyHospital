$(document).ready(function () {
    console.log("Test");
    $("#report_search").click(function (event) {

        event.preventDefault();
        var device_search = $("#device_search").val();
        var date_search_start = $("#date_search_start").val();
        var date_search_end = $("#date_search_end").val();

        $.ajax({
            url: "./Reports/search_report",
            type: "POST",
            data: {
                dates_search_e: date_search_end,
                dates_search_s: date_search_start,
                devices_search: device_search,
            },
            dataType: "JSON",
            cache: false,
            success: function (report_data) {
                console.log(report_data);
                if (report_data == "") {
                    $.notify({

                        icon: 'glyphicon glyphicon-ok',
                        title: '',
                        message: 'ไม่พบข้อมูล',
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

                }
                var trHTML = '';
                var i = 1;

                $.each(report_data, function (k, v) {
                    var $num;
                    if (v.date_back == null) {
                        $num = 1;
                    } else {
                        $num = 0;
                    }
                    $("#name_device_c").text(v.Device_name);
                    trHTML += '<tr><td>' + i + '</td><td>' + v.room_name + '</td><td>' + v.date_call + "</td><td>" + v.date_back + "</td><td>" +
                        $num + "</td><td>" + v.note + '</td><tr>';

                    i++;
                });
                $('#tb_report').append(trHTML);








            }
        });
    });

    //     $(document).on('submit', '#user_form', function(event) {
    //         event.preventDefault();
    //         var edit_user_code = $('#up_user_code').val();
    //         var edit_user_name = $('#up_user_name').val();
    //         var edit_user_position = $('#up_user_position').val();
    //         var device_update = $('#device_update').val();
    //         var edit_user_id = $('#user_id').val();
    //         var edit_user_email = $('#up_user_email').val();


    //         $.ajax({
    //             url: "./Users/edit_user",
    //             type: "POST",
    //             data: new FormData(this),
    //             contentType: false,
    //             processData: false,
    //             success: function(data) {
    //                 $.notify({
    //                     // options
    //                     icon: 'glyphicon glyphicon-ok',
    //                     title: '',
    //                     message: 'แก้ไขข้อมูลเรียบร้อย',
    //                 }, {
    //                     element: 'body',
    //                     position: null,
    //                     type: "info",
    //                     allow_dismiss: true,
    //                     newest_on_top: false,
    //                     showProgressbar: false,
    //                     placement: {
    //                         from: "top",
    //                         align: "right"
    //                     },
    //                     offset: 20,
    //                     spacing: 10,
    //                     z_index: 1031,
    //                     delay: 2000,
    //                     timer: 1000,
    //                     url_target: '_blank',
    //                     mouse_over: null,
    //                     animate: {
    //                         enter: 'animated fadeInDown',
    //                         exit: 'animated fadeOutUp'
    //                     }
    //                 });

    //                 $('#user_form')[0].reset();
    //                 $('#update_user_model').modal('hide');
    //                 dataTable.ajax.reload();
    //             }
    //         });
    //     });
    //     //ลบข้อมูลเจ้าหน้าที่

    //     $(document).on('click', '.delete_user', function() {
    //         var user_id = $(this).attr("id");
    //         console.log(user_id);
    //         swal({
    //                 title: "คุณต้องการลบใช่หรือไม่?",
    //                 text: "หากลบแล้วจะไม่สามารถกู้คืนได้อีก!",
    //                 type: "warning",
    //                 showCancelButton: true,
    //                 confirmButtonClass: 'btn-danger',
    //                 confirmButtonText: 'ลบ!',

    //                 cancelButtonText: 'ยกเลิก'

    //             },
    //             function() {
    //                 $.ajax({
    //                     url: "./Users/delete_user",
    //                     method: "POST",
    //                     data: { id: user_id },
    //                     success: function(data) {
    //                         if (data) {
    //                             $.notify({
    //                                 // options
    //                                 icon: 'glyphicon glyphicon-trash',
    //                                 title: '',
    //                                 message: 'ลบข้อมูลเรียบร้อย',
    //                             }, {

    //                                 element: 'body',
    //                                 position: null,
    //                                 type: "info",
    //                                 allow_dismiss: true,
    //                                 newest_on_top: false,
    //                                 showProgressbar: false,
    //                                 placement: {
    //                                     from: "top",
    //                                     align: "right"
    //                                 },
    //                                 offset: 20,
    //                                 spacing: 10,
    //                                 z_index: 1031,
    //                                 delay: 2000,
    //                                 timer: 1000,
    //                                 url_target: '_blank',
    //                                 mouse_over: null,
    //                                 animate: {
    //                                     enter: 'animated fadeInDown',
    //                                     exit: 'animated fadeOutUp'
    //                                 }
    //                             });
    //                             dataTable.ajax.reload();
    //                         }
    //                     }
    //                 });
    //             })


    //     });










    // });

    // $(document).on('click', '.update_user', function() {
    //     var user_id = $(this).attr('id');
    //     console.log(user_id);
    //     $.ajax({
    //         url: "./Users/fetch_single_user",
    //         type: "POST",
    //         data: { 'id': user_id },
    //         dataType: "JSON",
    //         cache: false,
    //         success: function(datauser) {
    //             console.log(datauser.device_name + '  name');
    //             console.log(datauser.device_id + '  id');
    //             $('#update_user_model').modal('show');
    //             $('#up_user_code').val(datauser.user_code);
    //             $('#up_user_name').val(datauser.user_name);
    //             $('#up_user_email').val(datauser.user_email);
    //             $('#up_user_position').val(datauser.user_position);
    //             $('#edit_option').text(datauser.device_name);
    //             $('#edit_option').val(datauser.device_id);
    //             $('#user_id').val(user_id);

    //         }
    //     });


});