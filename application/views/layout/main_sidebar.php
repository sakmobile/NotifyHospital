<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle"
                    alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo activate_menu('Home'); ?>">
                <a href="<?php echo site_url('Home'); ?>">
                    <i class="fa fa-bar-chart"></i> <span>หน้าแรก</span>
                </a>
            </li>


            <li class="<?php echo activate_menu('Department'); ?>">
                <a href="<?php echo site_url('Department'); ?>">
                    <i class="fa fa-university"></i> <span>จัดการหน่วยงาน</span>
                </a>
            </li>
            <li class="<?php echo activate_menu('Users'); ?>">
                <a href="<?php echo site_url('Users'); ?>">
                    <i class="fa fa-users"></i> <span>จัดการเจ้าหน้าที่</span>
                </a>
            </li>
            <li class="<?php echo activate_menu('Reports'); ?>">
                <a href="<?php echo site_url('Reports'); ?>">
                    <i class="fa fa-external-link "></i> <span>รายงาน</span>
                </a>
            </li>
            <li class="<?php echo activate_menu('Devices'); ?>">
                <a href="<?php echo site_url('Devices'); ?>">
                    <i class="fa fa-desktop "></i> <span>อุปกรณ์</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>