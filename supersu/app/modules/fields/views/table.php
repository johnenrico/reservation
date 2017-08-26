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
                      <button class="btn btn-default pull-right modal_actions" data-toggle="modal" data-target="#modal_action" data-type="create" data-header="Create User"><i class="ion-plus-round"></i> Create</button>
                    </div>
                  </div>
                </div> 
                <div class="panel-body"> 
                  <table class="table table-striped table-bordered">
                    <thead>
                      <th>Field</th>
                      <th>Branch Name</th>
                      <th>Status</th>
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
                      <div class="col-sm-11">
                        <label for="username">Enter Field Name</label>
                        <input type="text" class="form-control" id="name" name="name" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="hr-line-dashed"></div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-8">
                        <label for="phone">Select Branch</label>
                        <select class="form-control">
                          <option value="">Selct Branch</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="hr-line-dashed"></div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                      <label for="status">Status</label>
                        <select class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
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