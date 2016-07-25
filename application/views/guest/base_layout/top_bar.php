<script type="text/javascript">
    try {
        ace.settings.check('navbar', 'fixed')
    } catch (e) {
    }
</script>

<div class="navbar-container" id="navbar-container">
    <!-- #section:basics/sidebar.mobile.toggle -->
    <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
        <span class="sr-only">Toggle sidebar</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>
    </button>

    <!-- /section:basics/sidebar.mobile.toggle -->
    <div class="navbar-header pull-left">
        <!-- #section:basics/navbar.layout.brand -->
        <a href="#" class="navbar-brand">
            <small>
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                Beedu
            </small>
        </a>

        <!-- /section:basics/navbar.layout.brand -->

        <!-- #section:basics/navbar.toggle -->

        <!-- /section:basics/navbar.toggle -->
    </div>

    <!-- #section:basics/navbar.dropdown -->
    <div class="navbar-buttons navbar-header pull-right" role="navigation">
        <ul class="nav ace-nav">
            <li class="purple">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                    <span class="badge badge-important"><?php echo count($notify_data); ?></span>
                </a>

                <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                    <li class="dropdown-header">
                        <i class="ace-icon fa fa-exclamation-triangle"></i>
                        <?php echo count($notify_data); ?> Notifications

                    </li>

                    <li class="dropdown-content">
                        <ul class="dropdown-menu dropdown-navbar navbar-pink">
                            <?php foreach ($notify_data as $item) { ?>
                                <li>
                                    <a href="<?php echo $item->link_to_warning; ?>">
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="fa <?php echo $item->icon; ?> fa-lg"></i>
                                                <?php echo substr($item->content, 0, 32) . "..."; ?>
                                            </span>
                                            &nbsp;
                                            <span
                                                class="badge badge-info">+ <?php echo $item->count; ?>
                                            </span>
                                            <input type="radio" class="btn_seen pull-right tooltip-success"
                                                   data-rel="tooltip" data-placement="right"
                                                   title="Đánh dấu đã xem"
                                                   value="<?php echo site_url("notification_manage/update_notify_status") . '/' . $item->id; ?>">
                                        </div>
                                    </a>

                                </li>
                            <?php } ?>
                        </ul>
                    </li>

                    <li class="dropdown-footer">
                        <a href="<?php echo site_url('notification_manage'); ?>">
                            See all notifications
                            <i class="ace-icon fa fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- #section:basics/navbar.user_menu -->
            <li class="light-blue">
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <i class="fa fa-user fa-2x nav-user-photo" aria-hidden="true"></i>
                    <span class="user-info">
                        <small>Xin chào,</small>
                        <?php echo $this->session->userdata("user_name"); ?>
                    </span>
                    <i class="ace-icon fa fa-caret-down"></i>
                </a>

                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                    <li>
                        <a href="<?php echo site_url("admin/user/profile"); ?>" class="e_ajax_link">
                            <i class="ace-icon fa fa-user"></i>
                            Profile
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo site_url("admin/login/logout"); ?>">
                            <i class="ace-icon fa fa-power-off"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>

            <!-- /section:basics/navbar.user_menu -->
        </ul>
    </div>

    <!-- /section:basics/navbar.dropdown -->
</div><!-- /.navbar-container -->