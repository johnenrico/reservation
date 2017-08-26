         <div class="content">
            <div class="container">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><?php echo $title; ?></h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Home</a></li>

                        <li class="active"><?php echo $title; ?></li>
                    </ol>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="panel-title">Data</h3>
                                </div>
                                <div class="col-sm-6">
                                <button class="btn btn-default pull-right"><i class="ion-plus-round"></i> Create</button>
                                </div>
                            </div>
                        </div> 
                        <div class="panel-body"> 
                          
                        </div> 
                    </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->

        <?php echo $this->load->view('ui/footer.php') ?>