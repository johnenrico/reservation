<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="shortcut icon" href="images/favicon_1.ico">

    <title><?php echo $title ? $title . ' | ' .$site_name : $site_name; ?></title>

    <?php echo $this->load->view('ui/header.php') ?>
    </head>



    <body class="fixed-left" data-url="<?php echo site_url(); ?>">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">

                        <a href="<?php echo site_url('home'); ?>" class="logo"> <span><img class="img-responsive" src="<?php echo THEME; ?>images/SB logo.jpg" style="max-height: 60px;margin-top: 5px;"/> </span></a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">

                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                                </li>

                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo THEME; ?>images/users/avatar-1.png" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a href="<?php echo site_url('users/profile/'.$this->general->check_user()->username); ?>"><i class="md md-face-unlock"></i> Profile</a></li> -->
                                        <li><a href="<?php echo site_url('login/do_logout'); ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <?php // echo $this->general->list_module(0, $modid); ?>
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="<?php echo THEME; ?>images/users/avatar-1.png" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php $name = explode(' ', $this->general->check_user()->name);echo ucfirst($name[0]);  ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a href="<?php echo site_url('users/profile/'.$this->general->check_user()->username); ?>"><i class="md md-face-unlock"></i> Profile</a></li> -->
                                    <li><a href="<?php echo site_url('login/do_logout'); ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </div>

                            <p class="text-muted m-0"><?php echo $this->general->check_user()->gname; ?></p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                     <!--    <ul>
                            <li>
                                <a href="index.html" class="waves-effect"><i class="md md-home"></i><span> Dashboard </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="md md-mail"></i><span> Mail </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="inbox.html">Inbox</a></li>
                                    <li><a href="email-compose.html">Compose Mail</a></li>
                                    <li><a href="email-read.html">View Mail</a></li>
                                </ul>
                            </li>        
                        </ul> -->
                        <?php  echo $this->general->list_module(0, $modid); ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->

                <!-- Pls Remove -->
                <?php ($content) ? $this->load->view($content) : NULL; ?>   
                
                <footer class="footer text-right">
                    2017 © Evaluation.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->





        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

  
    </body>
    </html>
