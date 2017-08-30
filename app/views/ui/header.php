<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo THEME; ?>css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo THEME; ?>css/dark.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo THEME; ?>css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo THEME; ?>css/animate.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo THEME; ?>css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo THEME; ?>css/calendar.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo THEME; ?>css/style.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo THEME; ?>css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

    <!-- Document Title
    ============================================= -->
    <title><?php echo $title ?></title>

</head>

<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Header
        ============================================= -->
        <header id="header" class="full-header">

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                    <!-- Logo
                    ============================================= -->
                    <div id="logo">
                        <a href="index.html" class="standard-logo" data-dark-logo="<?php echo THEME; ?>images/logo-dark.png"><img src="<?php echo THEME; ?>images/logo.png" alt="Canvas Logo"></a>
                        <a href="index.html" class="retina-logo" data-dark-logo="<?php echo THEME; ?>images/logo-dark@2x.png"><img src="<?php echo THEME; ?>images/logo@2x.png" alt="Canvas Logo"></a>
                    </div><!-- #logo end -->

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav id="primary-menu">

                        <ul>
                            <li class="<?php echo $page == 'home' ? 'current' : '' ?>">
                                <a href="<?php echo base_url(); ?>">
                                    <div>Home</div>
                                </a>
                            </li>
                            <?php if ($this->session->userdata('session_uid')): ?>
                                <li class="<?php echo $page == 'users' ? 'current' : '' ?>">
                                    <a href="<?php echo base_url(); ?>users">
                                        <div>My Account</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>login/do_logout">
                                        <div>Logout</div>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="<?php echo $page == 'login' ? 'current' : '' ?>">
                                    <a href="<?php echo base_url(); ?>login">
                                        <div>Login</div>
                                    </a>
                                </li>
                                <li class="<?php echo $page == 'registration' ? 'current' : '' ?>">
                                    <a href="<?php echo base_url(); ?>registration">
                                        <div>Register</div>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>

                    </nav><!-- #primary-menu end -->

                </div>

            </div>

        </header><!-- #header end -->