     
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

                  <select class="form-control" name="fields" id="fields">
                    <?php foreach ($fields->result() as $vals): ?>
                      <option value="<?php echo $vals->id; ?>"  <?php echo $vals->id === $data->field_id ? 'selected="selected"' : null; ?>
                      ><?php echo $vals->name; ?></option>
                   <?php endforeach ?>
                 </select>

               </td>
               <td width="35%">

                <select class="form-control" name="time" id="time">
                    <?php foreach ($time->result() as $vals): ?>
                      <option value="<?php echo $vals->id; ?>"  <?php echo $vals->id === $data->time_slot ? 'selected="selected"' : null; ?>
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
          <h3 class="text-right"><?php echo number_format($data->amount); ?></h3>
        </div>
      </div>
      <hr>
      <div class="hidden-print">
        <div class="pull-right">
            <form class="flexi_form" data-url="<?php echo base_url('').$controller.'/cancel' ?>" method="POST" class="flexi_form" data-target=".panel-default">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-danger waves-effect waves-light">Cancel Reservation</button>
            </form>
          <form class="flexi_form" data-url="<?php echo base_url('').$controller.'/update' ?>" method="POST" class="flexi_form" data-reload="y" data-target=".panel-default">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="field_id" class="field_id" value="<?php echo $data->field_id; ?>">
              <input type="hidden" name="time_slot" class="time_slot" value="<?php echo $data->time_slot; ?>">
             <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- container -->

</div> <!-- content -->



<?php echo $this->load->view('ui/footer.php') ?>

<script type="text/javascript">
$(document).on('change', 'select[name="fields"]', function(){

  $('.field_id').val($(this).val());
  var date = '<?php echo $data->date_reserved; ?>';
  var customer = '<?php echo $data->username; ?>';
  var trans_id = '<?php echo $id; ?>';
  var time = ajax_wrap('<?php echo $mod_alias; ?>/get_time_available',{fields: $(this).val(), date : date, id: trans_id}, '#time');
  var data = JSON.parse(time).message;
  var html = '';

  $('#time').html('');
  $.each(data, function(r, v)
  {
    html += '<option value="'+v.id+'">'+v.start+' to '+v.end+'</option>';
  })
   $('#time').html(html);

})
$(document).on('change', '.time', function()
{
   $('.time_slot').val($(this).val());
})


</script>