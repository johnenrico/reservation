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
                                    <button class="btn btn-default pull-right modal_actions" data-toggle="modal" data-target="#modal_action" data-type="create" data-header="Create Branch"><i class="ion-plus-round"></i> Create</button>
                                </div>
                            </div>
                        </div> 
                        <div class="panel-body"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Time Start</th>
                                    <th>Time End</th>
                                    <th>Price</th>
                                </thead>
                            </table>
                        </div> 
                    </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->


        <div id="modal_action" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
              <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title">Test</h3> 
              </div> 
              <div class="panel-body"> 
                  <form role="form">
                      <div class="form-group row">
                        <div class="col-sm-5">
                            <label for="start">Time Start</label>
                            <input type="text" class="form-control" id="start" name="start" >
                        </div>
                    </div>
                    <div class="row">
                      <div class="hr-line-dashed"></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="end">Time End</label>
                        <input type="text" class="form-control" id="end" name="end" >
                    </div>
                </div>
                <div class="row">
                  <div class="hr-line-dashed"></div>
              </div>

              <div class="form-group row">
                <div class="col-sm-8">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" >
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


<?php echo $this->load->view('ui/footer.php') ?>