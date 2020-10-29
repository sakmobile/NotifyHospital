<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div class="row">
    <div class="col-md-12">
        <!-- add the device  -->
        <div id="add_device_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-university"></i> เพิ่มอุปกรณ์
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>รหัสหน่วยงาน</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-id-badge"></i>
                                        </div>
                                        <input type="text" name="add_device_code" id="add_device_code"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Token Line</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-bell"></i>
                                        </div>
                                        <input type="text" name="add_device_token_line" id="add_device_token_line"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ชื่อหน่วยงาน</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                        <input type="text" name="add_device_name" id="add_device_name"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" id="add_device" class="btn btn-success add_device"> บันทึกข้อมูล </button>
                    </div>
                </div>

            </div>
        </div>


        <!-- update the device -->

        <div id="update_device" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <form method="post" id="device_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-university"></i> Update</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสหน่วยงาน</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-badge"></i>
                                            </div>
                                            <input type="text" name="up_device_code" id="up_device_code"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Token Line</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-bell"></i>
                                            </div>
                                            <input type="text" name="up_device_token_line" id="up_device_token_line"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อหน่วยงาน</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <input type="text" name="up_device_name" id="up_device_name"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <button type="submit" id="edit_device" class="btn btn-success"> บันทึกข้อมูล </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <div class="box box-primary" id='load'>
            <div class="box-header with-border">
                <h3 class="box-title">หน่วยงาน</h3>
            </div>

            <div class="box-body">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_device_model">
                    <i class="fa fa-plus" aria-hidden="true"> </i> เพิ่มหน่วยงาน
                </button>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="Device_data">
                        <thead>
                            <tr>
                                <th style="">รหัสหน่วยงาน</th>
                                <th style="">ชื่อหน่วยงาน</th>
                                <th style="width: 200px">Token_line</th>

                                <th style="">วันที่</th>
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