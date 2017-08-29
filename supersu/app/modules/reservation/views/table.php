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
                       
                            </div>
                        </div> 
                        <div class="panel-body"> 
                            <div class="row">
                            <form id="show_grids">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                      <label for="date">Select Date</label>
                                      <input class="datepicker form-control" name="date" id="date_filter" value="<?php echo isset($_GET['date']) ? date('F d, Y', strtotime($_GET['date'] )) : NULL; ?>" />
                                  </div>
                              </div>  
                              <div class="col-sm-6 col-lg-3">
                                  <div class="form-group">
                                    <label for="branch_filter">Select Branch</label>
                                    <select class="form-control" name="branch" id="branch_filter">
                                      <option value="">Select Branch</option>
                                      <?php foreach ($branches->result() as $vals): ?>
                                      <option value="<?php echo $vals->id; ?>"><?php echo $vals->name; ?></option>
                                  <?php endforeach ?>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <input class="btn btn-default" value="Generate" type="submit" style="margin-top:1.7em"/>
                    </div>
                    </form>
                    <div class="col-lg-12">
                      <div class="hr-line-dashed"></div>
                    </div>
                    <div class="col-lg-12" id="field_grids">
                        
                    </div>  
                </div>  
            </div>

        </div> 
    </div>
</div>

</div> <!-- container -->

</div> <!-- content -->

    <?php if($this->general->mod_access($mod_alias,'create')): ?>
        <div id="modal_action" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
              <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title">Book Appointment</h3> 
                </div> 
                <div class="panel-body"> 
                  <form role="form" data-url="<?php echo base_url('').$controller.'/save' ?>" method="POST" class="flexi_form" data-clear="y" data-modal="#modal_action" data-target="#modal_action .flexi_form">
                   <div id="append">
                   </div>
                   <div class="form-group row">
                    <div class="col-sm-12">
                      <label for="name">Enter Passport ID or Username</label>
                      <input type="text" class="form-control" id="name" name="name" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="hr-line-dashed"></div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="passport_id">Time Slot</label>
                      <select class="form-control" name="time" id="time" readonly="true" disabled="true">
                        <?php foreach ($slots->result() as $vals): ?>
                         <option value="<?php echo $vals->id ?>"><?php echo date('h:i a', strtotime($vals->start)).' to '.date('h:i a', strtotime($vals->end)) ?></option>  
                        <?php endforeach ?>
                      </select>
                  
                      <input type="hidden" name="date">
                      <input type="hidden" name="timeslot">
                      <input type="hidden" name="field">
                    </div>
                  </div>
                  <div class="row">
                    <div class="hr-line-dashed"></div>
                  </div>
                    <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="date">Date</label>
                      <input type="text" class="form-control" id="date_2" name="date_2" readonly="true">
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




<?php echo $this->load->view('ui/footer.php') ?>

<script type="text/javascript">

$('#show_grids').submit(function(e)
{
    e.preventDefault();
    var grids = ajax_wrap('<?php echo $mod_alias; ?>/get_grids',{date: $('#show_grids').find('#date_filter').val(), branch_id : $('#show_grids').find('select[name="branch"]').val()}, '.panel-body');

    var data = JSON.parse(grids).message;
    var html = '';
    $.each(data, function(r,b){
         html += '<div class="col-lg-6 col-sm-12">';
         html += '<table class="table table-bordered table-hover table-responsive" width="100%"><caption><h2 class="page-title text-center">'+b.fields+'</h2></caption>';
         html += '<thead><tr><th>Time</th><th>Amount</th><th></th></tr></thead>'
         html += '<tbody>'
         $.each(b.sub, function(x,y){
            html += '<tr data-id="'+y.time_id+'" data-field="'+b.fields+'" data-fieldid="'+b.id+'" data-attr="'+b.fields+y.time_id+'">';
            html += '<td width="50%"><span '+(y.status == 0 ? '' : 'style="text-decoration:line-through;"')+'>'+y.time+'</span></td>';
            html += '<td>'+y.amount+'</td>';
            html += '<td width="20%">'+(y.status == 0 ? '<button class="btn btn-default btn-sm modal_action" data-toggle="modal" data-target="#modal_action">Book</button>' : '<label class="label label-sm label-warning cursor" data-id="'+y.reservation_id+'" data-href="'+base_url+'<?php echo $controller; ?>/view/'+y.reservation_id+'">Reserved</label>')+'</td>';
            html += '</tr>';
         });
         html += '</tbody></table>'
     
        html += '</div>';
    });
    
    $('#field_grids').html(html);
});

$(document).on('click', '.modal_action', function(){
    var time = $(this).parent().parent().attr('data-id');
    var field = $(this).parent().parent().attr('data-fieldid');
    var $form = $('.flexi_form');
    $form.find('input[name="date"], input[name="date_2"]').val($('#date_filter').val())
    $form.find('input[name="timeslot"]').val(time)
    $form.find('input[name="field"]').val(field) 

    $('.flexi_form').attr('data-callback', 'reserve_tr')
    $('.flexi_form').attr('data-params',$(this).parent().parent().data("attr"));
})

function reserve_tr(target)
{

   var id = ajax_wrap('<?php echo $mod_alias; ?>/latest_appointment',{}, '');
   var ids = JSON.parse(id).message;
   $('[data-attr="'+target+'"] td:nth-child(3)').html('<label class="label label-sm label-warning cursor" data-id="'+ids+'" data-href="'+base_url+'<?php echo $controller; ?>/view/'+ids+'">Reserved</label>');
   $('[data-attr="'+target+'"] td:nth-child(1) span').css('text-decoration', 'line-through');
}

    
</script>