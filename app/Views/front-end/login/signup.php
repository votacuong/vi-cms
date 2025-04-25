<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <title><?php VLang::__e('SIGN_UP_SIGNUP');?></title>
      <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/style.css');?>">
      <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/login.css');?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="login-form">
         <div class="text">
            <?php VLang::__e('SIGN_UP_UPPER');?>
         </div>
		 <?= \Config\Services::validation()->listErrors(); ?>
         <form action="<?php echo v_base_url('user/store');?>" method="post">
			<div class="field">
				<div class="fas fa-user"></div>
				<select class="form-control" id="user_type" name="user_type">
				  <option value="2" <?php if ($this->data['details']['user_type'] == 2){ echo 'selected="selected"';}?>><?php VLang::__e('USER_EDITUSER_USERTYPE_OWNER');?></option>
				  <option value="3" <?php if ($this->data['details']['user_type'] == 3){ echo 'selected="selected"';}?>><?php VLang::__e('USER_EDITUSER_USERTYPE_CUSTOMER');?></option>
				</select>
			  </div>
            <div class="field">
               <div class="fas fa-user"></div>
               <input type="text" required="required" placeholder="<?php VLang::__e('SIGN_UP_FIRSTNAME');?>" name="firstname" value="<?php echo $this->data['details']['firstname'];?>" >
            </div>
			<div class="field">
               <div class="fas fa-user"></div>
               <input type="text" required="required" placeholder="<?php VLang::__e('SIGN_UP_LASTNAME');?>" name="lastname" value="<?php echo $this->data['details']['lastname'];?>" >
            </div>
			<div class="field">
               <div class="fas fa-phone"></div>
               <input type="text" required="required" placeholder="<?php VLang::__e('SIGN_UP_PHONE');?>" name="phone" value="<?php echo $this->data['details']['phone'];?>" >
            </div>
			<div class="field">
               <div class="fas fa-user"></div>
               <input type="text" required="required" placeholder="<?php VLang::__e('SIGN_UP_USERNAME');?>" name="username" value="<?php echo $this->data['details']['username'];?>" >
            </div>
			<div class="field">
               <div class="fas fa-envelope"></div>
               <input type="email" required="required" placeholder="<?php VLang::__e('SIGN_UP_EMAIL');?>" name="email" value="<?php echo $this->data['details']['email'];?>" >
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" required="required" placeholder="<?php VLang::__e('SIGN_UP_PASSWORD');?>" name="password" value="" >
            </div>
			<div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" required="required" placeholder="<?php VLang::__e('SIGN_UP_RETYPEPASSWORD');?> " name="retypePassword" value="" >
            </div>
            <button type="submit" name="submit" value="submit"><?php VLang::__e('SIGN_UP_SUBMIT');?></button>
            <div class="link">
				<a href="<?php echo v_base_url('user/login');?>"><?php VLang::__e('SIGN_IN');?></a>
            </div>
         </form>
      </div>
   </body>
</html>