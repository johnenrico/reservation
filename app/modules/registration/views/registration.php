<?php $this->load->view('ui/header') ?>

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">

                        <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>New Signup? Register for an Account</div>
                        <div class="acc_content clearfix">
                            <form id="register-form" name="register-form" class="nobottommargin">
                                <div class="col_full">
                                    <label for="register-form-name">Name:</label>
                                    <input type="text" id="register-form-name" name="name" class="form-control" />
                                    <small class="help-block"></small>
                                </div>

                                <div class="col_full">
                                    <label for="register-form-email">Email Address:</label>
                                    <input type="text" id="register-form-email" name="email" class="form-control" />
                                    <small class="help-block"></small>
                                </div>

                                <div class="col_full">
                                    <label for="register-form-email">Passport ID:</label>
                                    <input type="text" id="register-form-email" name="passport_id" data-mask="000000-00-0000" placeholder="000000-00-0000" class="form-control" />
                                    <small class="help-block"></small>
                                </div>

                                <div class="col_full">
                                    <label for="register-form-username">Choose a Username:</label>
                                    <input type="text" id="register-form-username" name="username" class="form-control" />
                                    <small class="help-block"></small>
                                </div>

                                <div class="col_full">
                                    <label for="register-form-phone">Phone:</label>
                                    <input type="text" id="register-form-phone" name="phone" class="form-control" />
                                    <small class="help-block"></small>
                                </div>

                                <div class="col_full">
                                    <label for="register-form-password">Choose Password:</label>
                                    <input type="password" id="register-form-password" name="password" value="" class="form-control" />
                                    <small class="help-block"></small>
                                </div>

                                <div class="col_full">
                                    <label for="register-form-repassword">Re-enter Password:</label>
                                    <input type="password" id="register-form-repassword" name="rpassword" value="" class="form-control" />
                                    <small class="help-block"></small>
                                </div>

                                <div class="col_full nobottommargin">
                                    <a href="javascript:;" class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit">Register Now</a>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- #content end -->

<?php $this->load->view('ui/footer') ?>

<script type="text/javascript">
    
    $(function() {

        $('input').change(function(){
            $(this).closest('.col_full').removeClass('has-error');
            $(this).siblings('small.help-block').empty();
        });

    });


    $('#register-form-submit').on('click', function (e) {

              $.ajax({
                url : base_url + 'registration/do_register',
                type: "POST",
                data: $('#register-form').serialize(),
                dataType: "JSON",
                success: function(data)
                {

                  if(data.status)
                  {
                    window.location.href = base_url + 'activation';
                  }
                  else
                  {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').closest('.col_full').addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').siblings('small.help-block').text(data.error_string[i]);
                    }
                  }


              }
          });


    });


</script>