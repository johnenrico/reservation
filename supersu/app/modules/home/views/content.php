         <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><?php echo $title; ?></h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?php echo site_url(''); ?>">Home</a></li>
                        <li class="active"><?php echo $title; ?></li>
                    </ol>
                </div>

                <!-- Start Widget -->
                <div class="row">
                    <a href="<?php echo site_url('evaluation?status=active'); ?>">
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow">
                                <span class="mini-stat-icon bg-success"><i class="fa fa-circle"></i></span>
                                <div class="mini-stat-info text-right text-muted">
                                    <span class="counter"><?php echo number_format($active_topic); ?></span>
                                    Active Topic
                                </div>

                            </div>
                        </div>
                    </a>
                    <a href="<?php echo site_url('usergroup'); ?>">
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow">
                                <span class="mini-stat-icon bg-info"><i class="fa fa-users"></i></span>
                                <div class="mini-stat-info text-right text-muted">
                                    <span class="counter"><?php echo number_format($user_group); ?></span>
                                    User Group
                                    <NAV></NAV>
                                </div>

                            </div>
                        </div>
                    </a>
                    <a href="<?php echo site_url('question'); ?>">
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow">
                                <span class="mini-stat-icon bg-purple"><i class="fa fa-question"></i></span>
                                <div class="mini-stat-info text-right text-muted">
                                   <span class="counter"><?php echo number_format($question_count); ?></span>
                                   Questions
                               </div> 

                           </div>
                       </div>
                   </a>
                   <a href="<?php echo site_url('users?category=2'); ?>">
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="mini-stat clearfix bx-shadow">
                            <span class="mini-stat-icon bg-pink"><i class="ion-android-contacts"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter"><?php echo number_format($evaluator_count); ?></span>
                                Evaluators
                            </div>

                        </div>
                    </div>
                </div> 
            </a>
            <!-- End row-->



            <div class="row">
                <div class="col-lg-8">
                    <div class="portlet"><!-- /portlet heading -->
                        <div class="portlet-heading">
                            <h3 class="portlet-title text-dark text-uppercase">
                                Topic Per Category
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                                <span class="divider"></span>
                                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="portlet1" class="panel-collapse collapse in">
                            <div class="portlet-body">
                                <canvas id="topic_charts" height="200px">

                                </canvas>
                            </div>
                        </div>
                    </div> <!-- /Portlet -->
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="portlet"><!-- /portlet heading -->
                        <div class="portlet-heading">
                            <h3 class="portlet-title text-dark text-uppercase">
                                User Per Category
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                <span class="divider"></span>
                                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="portlet2" class="panel-collapse collapse in">
                            <div class="portlet-body">
                                <canvas  id="users_charts">

                                </canvas>
                            </div>
                        </div>
                    </div> <!-- /Portlet -->
                </div> <!-- end col -->
            </div> <!-- End row -->


        </div> <!-- container -->

    </div> <!-- content -->

      <?php echo $this->load->view('ui/footer.php') ?>