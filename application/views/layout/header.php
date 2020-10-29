<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>N</b>CS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>NCS</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- Notifications: style can be found in dropdown.less -->


                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image"
                            alt="User Image">
                        <span class="hidden-xs"><?php echo $name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->

                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">


                            <a href="<?php echo base_url('login/logout') ?>" class="btn btn-danger btn-flat">Logout</a>

                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>

    </nav>
</header>