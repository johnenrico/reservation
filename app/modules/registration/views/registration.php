<?php $this->load->view('ui/header') ?>

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">

                        <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>New Signup? Register for an Account</div>
                        <div class="acc_content clearfix">
                            <form id="register-form" name="register-form" class="nobottommargin" action="<?php echo site_url("registration/do_register") ?>" method="post">
                            <?php echo $this->general->flash_message(); ?>
                                <div class="col_full">
                                    <label for="register-form-name">Name:</label>
                                    <input type="text" id="register-form-name" name="name" value="<?php echo $this->session->name; ?>" class="form-control" />
                                </div>

                                <div class="col_full">
                                    <label for="register-form-email">Email Address:</label>
                                    <input type="text" id="register-form-email" name="email" value="<?php echo $this->session->email; ?>" class="form-control" />
                                </div>

                                <div class="col_full">
                                    <label for="register-form-email">Passport ID:</label>
                                    <input type="text" id="register-form-email" name="passport_id" value="<?php echo $this->session->passport_id; ?>" class="form-control" />
                                </div>

                                <div class="col_full">
                                    <label for="register-form-username">Choose a Username:</label>
                                    <input type="text" id="register-form-username" name="username" value="<?php echo $this->session->username; ?>" class="form-control" />
                                </div>

                                <div class="col_full">
                                    <label for="register-form-phone">Phone:</label>
                                    <input type="text" id="register-form-phone" data-mask="+639999999999" name="number" value="<?php echo $this->session->number; ?>" class="form-control" />
                                </div>

                                <div class="col_full">
                                    <label for="register-form-password">Choose Password:</label>
                                    <input type="password" id="register-form-password" name="password" value="" class="form-control" />
                                </div>

                                <div class="col_full">
                                    <label for="register-form-repassword">Re-enter Password:</label>
                                    <input type="password" id="register-form-repassword" name="password_again" value="" class="form-control" />
                                </div>

                                <div class="col_full nobottommargin">
                                    <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" type="submit">Register Now</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- #content end -->

<?php $this->load->view('ui/footer') ?>