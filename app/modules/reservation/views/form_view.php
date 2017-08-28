     
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

      <div class="panel-body">
        <div class="clearfix">

          <div class="pull-left">
            <h4>Transaction No # <br>
              <strong><?php echo $id; ?></strong>
            </h4>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">

            <div class="pull-left m-t-30">
              <address>

                <strong><?php echo $data->name; ?> | <small><?php echo $data->username; ?></small></strong><br>
                <?php echo $data->phone; ?><br>
                <?php echo $data->email; ?><br>
                <b>PID</b>: <?php echo $data->passport_id; ?>
              </address>
            </div>
            <div class="pull-right m-t-30">
              <p><strong>Date Booked: </strong> <?php echo date('F d, Y', strtotime($data->date_reserved));  ?>
              </p>
              <p class="m-t-10"><strong>Book Status: </strong> <span class="label label-success">Success</span></p>
              <p class="m-t-10"><strong>Transaction  ID: </strong> #<?php echo $id; ?></p>
            </div>
          </div>
        </div>
        <div class="m-h-50"></div>
        <div class="row">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Branch</th>
                <th>Field</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <td width="35%">
                  <?php echo $data->branch_name; ?>
               </td>
               <td width="35%">

                  <select class="form-control" name="branch" id="branch">
                    <option value="">Select Fields</option>
                    <?php foreach ($fields->result() as $vals): ?>
                      <option value="<?php echo $vals->id; ?>"  <?php echo $vals->id === $data->field_id ? 'selected="selected"' : null; ?>
                      ><?php echo $vals->name; ?></option>
                   <?php endforeach ?>
                 </select>

               </td>
               <td width="35%">

                <select class="form-control" name="time" id="time">
                    <option value="">Select TimeSlot</option>
                    <?php foreach ($time->result() as $vals): ?>
                      <option value="<?php echo $vals->id; ?>"  <?php echo $vals->id === $data->field_id ? 'selected="selected"' : null; ?>
                      ><?php echo date('h:i a',strtotime($vals->start)).' to '.date('h:i a',strtotime($vals->end)); ?></option>
                   <?php endforeach ?>
                 </select>

               </td>
             </tr>
           </tbody>
         </table>
       </div>
       <div class="row" style="border-radius: 0px">
        <div class="col-md-3 col-md-offset-9">

          <hr>
          <h3 class="text-right">2930.00</h3>
        </div>
      </div>
      <hr>
      <div class="hidden-print">
        <div class="pull-right">
            <a href="#" class="btn btn-danger waves-effect waves-light">Cancel Reservation</a>
          <a href="#" class="btn btn-primary waves-effect waves-light">Update</a>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- container -->

</div> <!-- content -->



<?php echo $this->load->view('ui/footer.php') ?>

<script type="text/javascript">


</script>