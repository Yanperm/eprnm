<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo-fav.png">
    <title>Nutmor - Electronic Patient Record</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css" type="text/css"/>
</head>
<body class="be-splash-screen">
<div class="be-wrapper be-login">
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header"><img class="logo-img" src="<?php echo base_url();?>assets/img/logo2.png" alt="logo" width="90" height="90"><span class="splash-description">Nutmor EPR Log in</span></div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('message')) { ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('message') ?>
                            </div>
                        <?php } ?>
                        <?php echo form_open(base_url('login'), array('id' => 'loginForm')) ?>
                            <div class="form-group">
                                <input class="form-control" id="username" type="text" name="email" placeholder="email" autocomplete="off">
                                <?php echo form_error('email', '<div class="error">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                                <?php echo form_error('password', '<div class="error">', '</div>') ?>
                            </div>
                            <div class="form-group row login-tools">
                                <div class="col-6 login-remember">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="checkbox1">
                                        <label class="custom-control-label" for="checkbox1">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 login-forgot-password"><a href="pages-forgot-password.html">Forgot Password?</a></div>
                            </div>

                            <div class="form-group login-submit"><button type="submit" class="btn btn-primary btn-xl" href="index.html" data-dismiss="modal">Sign me in</button></div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="splash-footer"><span>Don't have an account? <a href="pages-sign-up.html">Sign Up</a></span></div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/app.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //-initialize the javascript
        App.init();
    });

</script>
</body>
</html>