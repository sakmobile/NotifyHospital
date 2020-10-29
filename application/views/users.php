<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div class="row">
    <div class="col-md-12">
        <!-- add User-->
        <div id="add_user_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> เพิ่มเจ้าหน้าที่</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>รหัส เจ้าหน้าที่</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-id-card-o "></i>
                                        </div>
                                        <input type="text" name="add_user_code" id="add_user_code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ชื่อ - สกุล เจ้าหน้าที่</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <input type="text" name="add_user_name" id="add_user_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ตำแหน่ง</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-id-badge "></i>
                                        </div>
                                        <input type="text" name="add_user_position" id="add_user_position"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>สังกัดหน่วยงาน</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-id-card-o"></i>
                                        </div>

                                        <select class="form-control" name="device_select" id="device_select">

                                            <option id="department">เลือกหน่วยงาน</option>
                                            <?php
foreach ($devices as $device) {
    echo "<option value='" . $device['Device_id'] . "'>" . $device['Device_name'] . "</option>";
}
?>

                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope-o "></i>
                                        </div>
                                        <input type="Email" name="add_user_email" id="add_user_email"
                                            class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" id="add_user" class="btn btn-primary add_user">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- update user -->
        <div id="update_user_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <form method="post" id="user_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> แก้ไขเจ้าหน้าที่
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>รหัส เจ้าหน้าที่</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-card-o "></i>
                                            </div>
                                            <input type="text" name="up_user_code" id="up_user_code"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>ชื่อ - สกุล เจ้าหน้าที่</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <input type="text" name="up_user_name" id="up_user_name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>ตำแหน่ง</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-badge "></i>
                                            </div>
                                            <input type="text" name="up_user_position" id="up_user_position"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="test">สังกัดหน่วยงาน</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-card-o"></i>
                                            </div>

                                            <select class="form-control" name="device_update" id="device_update">
                                                <option id="edit_option"></option>
                                                <?php
foreach ($devices as $device) {
    echo "<option value='" . $device['Device_id'] . "'>" . $device['Device_name'] . "</option>";
}
?>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope-o "></i>
                                            </div>
                                            <input type="hidden" name="user_id" id="user_id" />
                                            <input type="Email" name="up_user_email" id="up_user_email"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" id="update_user" class="btn btn-primary ">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- endupdate user -->
        <div class="box box-primary" id='load'>
            <div class="box-header with-border">
                <h3 class="box-title">เจ้าหน้าที่</h3>
            </div>

            <div class="box-body">

                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_user_model">
                    <i class="fa fa-plus" aria-hidden="true"> </i> เพิ่มเจ้าหน้าที่
                </button>

                <br />
                <br />
                <div class="table-responsive">
                    <table class="table table-striped" id="user_table">
                        <thead>
                            <tr>
                                <th style="">รหัสประจำตัว</th>
                                <th style="width: 200px">ชื่อ - สกุล</th>

                                <th style="width: 200px">ตำแหน่ง</th>
                                <th style="width: 200px">สังกัดหน่วยงาน</th>
                                <th style="">Email</th>
                                <th style="width: 100px">Active</th>
                            </tr>
                        </thead>

                    </table>
                </div>


                <div class="box-footer clearfix">


                    <ul id="pagination" class="pagination pagination-sm no-margin pull-right">

                    </ul>
                </div>
            </div>
            <!-- /.box -->









        </div>
    </div>