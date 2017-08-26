         <div class="content">
          <div class="container">
            <div class="col-sm-12">
              <h4 class="pull-left page-title"><?php echo $title; ?></h4>
              <ol class="breadcrumb pull-right">
                <li><a href="#">Home</a></li>

                <li class="active"><?php echo $title; ?></li>
              </ol>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="input-group input-group-lg">
                      <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button type="button" class="btn-lg btn waves-effect waves-light btn-primary w-md"><i class="fa fa-search"></i></button>
                         <button type="button" class="btn-lg btn waves-effect waves-light btn-success w-md"><i class="fa fa-plus"></i> Create</button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
            <?php for ($i=0; $i <= 9; $i++) : ?>
            
              <div class="col-sm-6 col-lg-4">
                <div class="panel">
                  <div class="panel-body">
                    <div class="media-main">
                      <a class="pull-left" href="#">
                        <img class="thumb-lg img-circle" src="assets/images/users/avatar-2.jpg" alt="">
                      </a>
                      <div class="pull-right btn-group-sm">
                        <a href="#" class="btn btn-success waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-danger waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                          <i class="fa fa-close"></i>
                        </a>
                      </div>
                      <div class="info">
                        <h4>Jonathan Smith</h4>
                        <p class="text-muted">Graphics Designer</p>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="social-links list-inline">
                      <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                      </li>
                      <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                      </li>
                      <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                      </li>
                      <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                      </li>
                      <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                      </li>
                    </ul>
                  </div> <!-- panel-body -->
                </div> <!-- panel -->
              </div> <!-- end col -->
            <?php endfor ?>



            </div>
            </div>
            </div>

            </div>



            <?php echo $this->load->view('ui/footer.php') ?>