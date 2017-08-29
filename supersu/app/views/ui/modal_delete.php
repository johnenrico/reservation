  <div id="modal_delete" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-danger">
                <div class="panel-heading"> 
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                  <h3 class="panel-title">Dlete Confirmation</h3> 
              </div> 
              <div class="panel-body"> 
                  <form role="form" data-url="<?php echo base_url('').$controller.'/delete' ?>" method="POST" class="flexi_form" data-clear="y" data-modal="#modal_delete" data-target="#modal_delete .flexi_form">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    <br/>
                    <br/>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <label for="name">Enter Confirmation</label>
                            <input type="hidden"  name="id" />
                          <input type="text" class="form-control" id="confirmation" name="confirmation" >
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

