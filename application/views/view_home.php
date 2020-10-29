<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div class="row">
    <div class="col-md-12">

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <form class="form-inline ">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> เริ่มต้น : </label>
                            <input type="date" class="form-control" id="date_s" name="date_s"
                                value="<?php echo $date; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> สิ้นสุด : </label>
                            <input type="date" class="form-control" id="date_e" name="date_e"
                                value="<?php echo $date; ?>">
                        </div>
                    </div>

                    <label for="exampleInputName2">เลือกหน่วยงาน : </label>
                    <select class="form-control">
                        <?php
foreach ($device as $r_device) {
    echo "<option  id ='option_search' value='" . $r_device['Device_id'] . "'>" . $r_device['Device_name'] . "</option>";
}
?>
                    </select>
                    <button type="submit" id="s_p" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>
                        ค้นหา</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>



        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title" id="title_s"></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="myChart" width="400" height="100"></canvas>
                </div>
            </div>
            <!-- /.box-body -->
        </div>


    </div>
</div>