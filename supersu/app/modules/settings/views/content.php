  <div class="content">
    <div class="container">
      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <h4 class="pull-left page-title"><?php echo $title; ?></h4>
          <ol class="breadcrumb pull-right">
            <li><a href="<?php echo site_url(''); ?>">Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="panel panel-default">
            <div class="panel-heading"> 
              <h3 class="panel-title">Incremental</h3> 
            </div>
            <form data-url="<?php echo base_url('').$controller.'/update' ?>" method="POST" class="flexi_form" data-clear="y"  data-target=".flexi_form">
            <input type="hidden" name="type" value="incremental"/>
            <div class="panel-body"> 
              <ul class="list-unstyled">
                <?php 
                for ($i = 0; $i < 7; $i++) :
                 $day =  date('l', strtotime("Sunday +{$i} days"));
               ?>
               <?php if($this->general->mod_access('settings', 'alter')): ?>
                <li>
                 <div class="form-group row">
                  <div class="col-sm-3">
                    <label for="<?php echo $day; ?>">  <?php echo $day; ?></label>  
                  </div>
                  <div class="col-sm-9">
                    <input type="text" name="<?php echo strtolower($day); ?>" value="<?php echo $this->general->get_table('settings', ['name' => 'incremental' , 'data_keys' => $day])->row()->data;  ?>" class="form-control" maxlength="9" >
                  </div>
                </div>
              </li>
            <?php endif ?>
          <?php endfor; ?>
        </ul>
        <button type="submit" class="btn waves-effect waves-light btn-primary pull-right" data-name="filetype">Update</button> 
      </div> 
    </div>
    </form>
  </div>
</div>
</div>
</div>
</div>


<?php echo $this->load->view('ui/footer.php') ?>