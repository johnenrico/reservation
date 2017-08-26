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
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Address</th>
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
                        <div class="col-sm-8">
                            <label for="name">Branch Name</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Branch Name">
                        </div>
                    </div>
                    <div class="row">
                      <div class="hr-line-dashed"></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-8">
                        <label for="person">Contact Person</label>
                        <input type="text" class="form-control" id="person" name="person"  placeholder="Enter Contact Person">
                    </div>
                </div>
                <div class="row">
                  <div class="hr-line-dashed"></div>
              </div>

              <div class="form-group row">
                <div class="col-sm-8">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"  placeholder="Enter Phone Number">
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


<?php echo $this->load->view('ui/footer.php') ?>