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
                    <a href="<?php echo site_url(''); ?>reservation?date=<?php echo date('Y-m-d'); ?>" target="_blank">
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow">
                                <span class="mini-stat-icon bg-success"><i class="ion-document"></i></span>
                                <div class="mini-stat-info text-right text-muted">
                                    <span class="counter"><?php echo number_format($Reservation); ?></span>
                                    Daily Reservation
                                </div>

                            </div>
                        </div>
                    </a>
                    <a href="<?php echo site_url(''); ?>customers?&status=1" target="_blank">
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow">
                                <span class="mini-stat-icon bg-info"><i class="fa fa-users"></i></span>
                                <div class="mini-stat-info text-right text-muted">
                                    <span class="counter"><?php echo number_format($active); ?></span>
                                    Active Customers
                                    <NAV></NAV>
                                </div>

                            </div>
                        </div>
                    </a>
                    <a href="<?php echo site_url(''); ?>customers?&status=0" target="_blank">
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="mini-stat clearfix bx-shadow">
                                <span class="mini-stat-icon bg-purple"><i class="fa fa-question"></i></span>
                                <div class="mini-stat-info text-right text-muted">
                                   <span class="counter"><?php echo number_format($inactive); ?></span>
                                   Pending Customers
                               </div> 

                           </div>
                       </div>
                   </a>
                   <a href="<?php echo site_url(''); ?>time_slot" target="_blank">
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="mini-stat clearfix bx-shadow">
                            <span class="mini-stat-icon bg-pink"><i class="ion-clock"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter"><?php echo number_format($time_slots); ?></span>
                                Time Slots
                            </div>

                        </div>
                    </div>
                </div> 
            </a>
            <!-- End row-->




                <div class="col-lg-12">
                    <div class="portlet"><!-- /portlet heading -->
                        <div class="portlet-heading">
                            <h3 class="portlet-title text-dark text-uppercase">
                                Recent Reservation
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
                             <table class="table table-striped table-bordered" id="customer_datatable">
                              <thead>
                                <th>Trans ID</th>
                                <th>Name</th>
                                <th>Time</th>
                                <th>Date</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> <!-- /Portlet -->
        </div> <!-- end col -->
    </div> <!-- End row -->


</div> <!-- container -->

</div> <!-- content -->

<?php echo $this->load->view('ui/footer.php') ?>

<script type="text/javascript">

 var oTable = $('#customer_datatable').DataTable({ 
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [[2, 'DESC']], //Initial no order.
          "ajax": {
            "url": '<?php echo base_url('').$controller.'/recent_reservation'; ?>',
            "type": "POST",
        },
        "columns": [
        { data: 'id', name:  'id', searchable: false, orderable: false, sortable: false },
        { data: 'users', name:  'users', searchable: false, orderable: false, sortable: false },
        { data: 'time', name:  'time',searchable: false, orderable: false, sortable: false },
        { data: 'date_reserved', name:  'date_reserved',searchable: false, orderable: false, sortable: false},
        ],

    });

 $('#customer_datatable').on('submit', function(e) {
    oTable.draw();
    e.preventDefault();
});

</script>