<div id="loginbox">
            <?php $attributes = array('class' => 'form-vertical', 'id' => 'loginform', "method"=>"POST");
                    echo form_open(base_url().'signup', $attributes); ?>          
            
                <div class="control-group normal_text"> <h3><img src="<?php echo base_url(); ?>resources/img/logo.png" width="100" alt="Logo" />Universal Tag Manager Portal Signup</h3></div>
                <?php echo (isset($msg)&&!empty($msg))?$msg:'';  ?>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><?php echo form_input('uname','', 'required placeholder="User Name"'); ?>
                            <?php if(isset($errors['uname'])&&!empty($errors['uname'])){ ?><div class="alert alert-danger texterror"><?php echo $errors['uname']; ?></div><?php } ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><?php echo form_input('email','', 'required placeholder="User Email"'); ?>
                            <?php if(isset($errors['email'])&&!empty($errors['email'])){ ?><div class="alert alert-danger texterror"><?php echo $errors['email']; ?></div><?php } ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><?php echo form_password('password','', 'required placeholder="Password"'); ?>
                            <?php if(isset($errors['password'])&&!empty($errors['password'])){ ?><div class="alert alert-danger texterror"><?php echo $errors['password']; ?></div><?php } ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><?php echo form_password('repassword','', 'required placeholder="Retype Password"'); ?>
                            <?php if(isset($errors['repassword'])&&!empty($errors['repassword'])){ ?><div class="alert alert-danger texterror"><?php echo $errors['repassword']; ?></div><?php } ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="<?php echo base_url()."login"; ?>" class="flip-link btn btn-warning">Signin</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-success" name="signup" value="Singup" /></span>
                </div>
            <?php echo form_close(); ?>
        </div>