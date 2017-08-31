<?php $this->load->view('ui/header') ?>

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">

                        <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open icon-unlock"></i>Login to your Account</div>
                        <div class="acc_content clearfix">
                            <form id="login-form" name="login-form" class="nobottommargin" action="<?php echo site_url('/login/do_login'); ?>" method="post">
                            <?php echo $this->general->flash_message(); ?>
                                <div class="col_full">
                                    <label for="login-form-username">Username:</label>
                                    <input type="text" id="login-form-username" name="username" value="<?php echo $this->session->flashdata("username"); ?>" class="form-control" placeholder="Username" />
                                </div>

                                <div class="col_full">
                                    <label for="login-form-password">Password:</label>
                                    <input type="password" id="login-form-password" name="password" class="form-control" placeholder="Password" />
                                </div>

                                <div class="col_full nobottommargin">
                                    <button class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" type="submit">Login</button>
                                    <a href="#" class="fright">Forgot Password?</a>
                                </div>
                            </form>
                        </div>
                        <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>New Signup? Register for an Account</div>
                    </div>

                </div>

            </div>

        </section><!-- #content end -->

<?php $this->load->view('ui/footer') ?>

<script type="text/javascript">
    
    $('.acctitle').on('click', function() {
        window.location.href = base_url + 'registration';
    });

</script>