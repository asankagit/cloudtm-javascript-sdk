        <div id="loginbox">
            <?php $attributes = array('class' => 'form-vertical', 'id' => 'loginform', "method"=>"POST");
                    echo form_open(base_url().'login', $attributes); ?>          
            
                <div class="control-group normal_text"> <h3><img src="<?php echo base_url(); ?>resources/img/logo.png" width="100" alt="Logo" />Universal Tag Manager Portal Signin</h3></div>
                <?php echo (isset($msg)&&!empty($msg))?$msg:'';  ?>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><?php echo form_input('uname','', 'required placeholder="Username"'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><?php echo form_password('password','', 'required placeholder="Password"'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="<?php echo base_url()."signup"; ?>" class="flip-link btn btn-warning">Signup</a></span>
<!--                    <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-recover">Lost password?</a></span>-->
                    <span class="pull-right"><input type="submit" class="btn btn-success" name="login" value="Login" /></span>
                </div>
            <?php echo form_close(); ?>
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

