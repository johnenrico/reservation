
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <link rel="shortcut icon" href="images/favicon_1.ico">

        <title></title>

        <!-- Base Css Files -->
          <?php echo $this->load->view('/ui/header.php') ?>
        
    </head>
    <body>


        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Sign In to <strong>IDN</strong> </h3>
                </div> 

 

                <div class="panel-body">
                <?php echo $this->general->flash_message(); ?>
                <form class="form-horizontal m-t-20" action="<?php echo site_url('/login'); ?>" method="POST">
                    
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control input-lg " type="text" name="username" placeholder="Username" value="<?php echo $this->session->flashdata("username"); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="password" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox-signup" type="checkbox" name="remember" <?php echo ($this->session->flashdata("remember") ? 'checked="true"' : null); ?>>
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-success btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

            
                </form> 
                </div>                                 
                
            </div>
        </div>

        
      <script>
            var resizefunc = [];
        </script>
     <?php echo $this->load->view('/ui/footer.php') ?>
  
  </body>
</html>