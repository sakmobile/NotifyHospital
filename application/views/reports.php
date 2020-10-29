<script src="<?php echo base_url(); ?>assets/dist/js/pages/report.js?v=65"></script>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary" id='load'>
            <div class="box-header with-border">
                <h3 class="box-title">รายงาน</h3>
            </div>

            <div class="box-body">

                <div class="row">
                    <form class="form-inline" method="post" action="<?php echo base_url(); ?>Reports/action">
                        <div class="form-inline">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>เลือกหน่วยงาน : </label>
                                    <select class="form-control" id="device_search" name="device_search">
                                        <?php
foreach ($device as $r_device) {
    echo "<option value='" . $r_device['Device_id'] . "'>" . $r_device['Device_name'] . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> เริ่มต้น : </label>
                                    <input type="date" class="form-control" id="date_search_start"
                                        name="date_search_start" value="<?php echo $date; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> สิ้นสุด : </label>
                                    <input type="date" class="form-control" id="date_search_end" name="date_search_end"
                                        value="<?php echo $date; ?>">


                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <button id="report_search" class="btn btn-info"><i
                                            class="fa fa-search report_search"></i> ค้นหา</button>
                                </div>
                            </div>


                        </div>
                </div>



                <div id="printJS-form">


                    <h2><span id="name_device_c" class="label label-primary"></span></h2>


                    <table border="1" cellspacing="0" width="100%" class="table  table-bordered" id="tb_report">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="">ห้อง</th>
                                <th style="">วันเวลาเรียก</th>
                                <th style="">วันเวลาช่วยเหลือ</th>
                                <th style="">ขาดการช่วยเหลือ/ครั้ง</th>
                                <th style="">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
            <div class="box-footer clearfix">


                <ul id="pagination" class="pagination pagination-sm no-margin pull-right">


                    <div class="form-group">
                        <input type="submit" name="export" class="btn btn-block btn-success btn-lg "
                            value="Export Excel" />
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-block btn-success btn-lg"
                            onclick="PrintElem('#printJS-form')">
                            Export PDF</button>
                    </div>
                    </form>



                </ul>
            </div>
        </div>



    </div>
</div>
<script type="text/javascript">
function PrintElem(elem) {
    Popup($(elem).html());
}

function Popup(data) {
    var mywindow = window.open('', 'my div', 'height=400,width=600');
    mywindow.document.write('<html><head><title>รายงาน</title><style type="text/css">');
    mywindow.document.write(
        '<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/app.css?v=11" type="text/css" />');

    // mywindow.document.write('table {border-collapse: collapse;  }');
    // mywindow.document.write('tbody,th,td {  border: 1px solid black; }');


    mywindow.document.write('</style></head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.print();
    mywindow.close();

    return true;
}
</script>