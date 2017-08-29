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
                                  <?php if($this->general->mod_access($mod_alias,'create')): ?>
                                    <button class="btn btn-default pull-right modal_action" data-toggle="modal" data-target="#modal_action" data-type="create" data-header="Create Branch"><i class="ion-plus-round"></i> Create</button>
                                  <?php endif ?>
                                </div>
                            </div>
                        </div> 
                        <div class="panel-body"> 
                            <table class="table table-striped table-bordered" id="branches_datatable">
                                <thead>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </thead>
                            </table>
                        </div> 
                    </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->



<?php if($this->general->mod_access($mod_alias,'create') || $this->general->mod_access($mod_alias,'alter')): ?>
        <div id="modal_action" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
              <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title">Test</h3> 
              </div> 
              <div class="panel-body"> 
                  <form role="form" data-url="<?php echo base_url('').$controller.'/save' ?>" method="POST" class="flexi_form" data-clear="y" data-datatable="#branches_datatable" data-modal="#modal_action" data-target="#modal_action .flexi_form">
                    <div id="append">
                      
                    </div>
                      <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="name">Branch Name</label>
                            <input type="text" class="form-control" id="name" name="name" >
                        </div>
                    </div>
                    <div class="row">
                      <div class="hr-line-dashed"></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">
                        <label for="person">Contact Person</label>
                        <input type="text" class="form-control" id="person" name="person" >
                    </div>
                </div>
                <div class="row">
                  <div class="hr-line-dashed"></div>
              </div>

              <div class="form-group row">
                <div class="col-sm-8">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" >
                </div>
            </div>
            <div class="row">
              <div class="hr-line-dashed"></div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="5" style="resize: none;">  </textarea>
            </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </form>
</div> 
</div>
</div>
</div>
</div>
<?php endif ?>

<?php if($this->general->mod_access($mod_alias,'drop')): ?>
  <?php echo $this->load->view('ui/modal_delete'); ?>
<?php endif ?>




<?php echo $this->load->view('ui/footer.php') ?>

<script type="text/javascript">


      var oTable = $('#branches_datatable').DataTable({ 
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [[0, 'asc']], //Initial no order.
          "ajax": {
            "url": '<?php echo base_url('').$controller.'/index'; ?>',
            "type": "POST",
            "data": function (d) {
             d.date = $('#reportrange>span').text();
             d.action = $('select[name=category]').val();
           }

         },
         "columns": [
         { data: 'name', name:  'name' },
         { data: 'contact_person', name: 'contact_person' },
         { data: 'phone', name: 'phone' },
         { data: 'address', name: 'address', orderable: false, sortable: false },
         { data: 'action', name:'action', orderable: false, sortable: false },
         ],

       });
      $('#branches_datatable').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
      });


 <?php if($this->general->mod_access($mod_alias,'create') || $this->general->mod_access($mod_alias,'alter')): ?>
      $(document).on('click','.modal_action', function()
      {
        var type = $(this).data('type');
        var action = '<input type="hidden" value="'+type+'" name="type"/>';
        var title = $(this).data('header');
        $('#modal_action .panel-title').text(title);

        if(type =='create')
        {
           $('.flexi_form').find('textarea, select, input:not([type="submit"]):not([type="checkbox"]):not([type="hidden"])').val('');
        }
        else
        {
          action += '<input type="hidden" value="'+$(this).data('id')+'" name="id"/>';
          var index = $(this).closest("tr").index();
          var rows = oTable.rows( index ).data();
          $('input[name="name"]').val(rows[0].name);
          $('input[name="person"]').val(rows[0].contact_person);
          $('input[name="phone"]').val(rows[0].phone);
          $('textarea[name="address"]').val(rows[0].address);
        }
        $('#modal_action .flexi_form #append').html(action);
      });
<?php endif ?>

</script>
