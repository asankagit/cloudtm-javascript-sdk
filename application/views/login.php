<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Universal Tag Manager Portal</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/maruti-login.css" />
        <link rel="icon" href="<?php echo base_url(); ?>resources/img/logosmall.png" sizes="192x192" />
    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="index.html">
                <div class="control-group normal_text"> <h3><img src="<?php echo base_url(); ?>resources/img/logo.png" width="100" alt="Logo" />Universal Tag Manager Portal</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
                <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                    </div>
                </div>

                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-info" value="Recover" /></span>
                </div>
            </form>
        </div>

        <script src="<?php echo base_url(); ?>resources/js/jquery.min.js"></script>  
        <script src="<?php echo base_url(); ?>resources/js/maruti.login.js"></script> 
    </body>

</html>
