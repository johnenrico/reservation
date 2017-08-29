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
                        <button class="btn btn-default pull-right modal_action" data-toggle="modal" data-target="#modal_action" data-type="create" data-header="Create User"><i class="ion-plus-round"></i> Create</button>
                      <?php endif ?>
                    </div>
                  </div>
                </div> 
                <div class="panel-body"> 
                  <table class="table table-striped table-bordered" id="users_datatable">
                    <thead>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Role</th>
                      <th>Action</th>
                      <th></th>
                      <th></th>
                      <th></th>
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
                    <form role="form" data-url="<?php echo base_url('').$controller.'/save' ?>" method="POST" class="flexi_form" data-clear="y" data-datatable="#users_datatable" data-modal="#modal_action" data-target="#modal_action .flexi_form">
                     <div id="append">
                      
                     </div>
                     <div class="form-group row">
                      <div class="col-sm-11">
                        <label for="username">Enter Name</label>
                        <input type="text" class="form-control" id="name" name="name" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="hr-line-dashed"></div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-8">
                        <label for="phone">Enter Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="hr-line-dashed"></div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-8">
                        <label for="email">Enter Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" >
                      </div>
                    </div>

                    <div class="row">
                      <div class="hr-line-dashed"></div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-5">
                        <label for="role">Select Role</label>
                        <select class="form-control" id="role"  name="role" 
                        >
                        <option value="">Select Role</option>
                        <?php foreach ($roles->result() as $vals): ?>
                         <option value="<?php echo $vals->guid; ?>"><?php echo $vals->gname; ?></option>
                       <?php endforeach ?>
                     </select>
                   </div>
                 </div>

                 <div class="row">
                  <div class="hr-line-dashed"></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-5">
                    <label for="role">Select Branch</label>
                    <select class="form-control" id="branch"  name="branch" 
                    >
                    <option value="">All Branch</option>
                    <?php foreach ($branch->result() as $vals): ?>
                     <option value="<?php echo $vals->id; ?>"><?php echo $vals->name; ?></option>
                   <?php endforeach ?>
                 </select>
               </div>
             </div>


             <div class="row">
              <div class="hr-line-dashed"></div>
            </div>
            <div class="form-group row">
              <div class="col-sm-7">
                <label for="username">Enter Username</label>
                <input type="text" class="form-control" id="username" name="username" >
              </div>
            </div>
            <div class="row">
              <div class="hr-line-dashed"></div>
            </div>
            <div class="form-group row">
              <div class="col-sm-7">
                <label for="password">Enter Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="row">
              <div class="hr-line-dashed"></div>
            </div>
            <div class="form-group row">
              <div class="col-sm-7">
                <label for="rpassword">Repeat Password</label>
                <input type="password" class="form-control" id="rpassword" name="rpassword">
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
  var oTable = $('#users_datatable').DataTable({ 
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
         { data: 'name', name:  'u.name' },
         { data: 'username', name: 'u.username' },
         { data: 'password', name: 'u.password' },
         { data: 'gname', name: 'ug.gname', orderable: false, sortable: false },
         { data: 'action', name:'action', orderable: false, sortable: false },
         { data: 'phone', name:'u.phone', orderable: false, sortable: false, visible: false },
         { data: 'email', name:'u.email', orderable: false, sortable: false, visible: false },
         { data: 'guid', name:'ug.guid', orderable: false, sortable: false, visible: false },
         { data: 'branch', name:'u.branch_id', orderable: false, sortable: false, visible: false },
         ],

       });
  $('#users_datatable').on('submit', function(e) {
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
    $('input[name="email"]').val(rows[0].email);
    $('input[name="phone"]').val(rows[0].phone);
    $('select[name="role"]').val(rows[0].guid);
    $('select[name="branch"]').val(rows[0].branch);

    $('input[name="username"]').val(rows[0].username);
  }
  $('#modal_action .flexi_form #append').html(action);
});
<?php endif ?>

</script>