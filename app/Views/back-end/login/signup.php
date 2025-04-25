<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <title><?php VLang::__e('SIGN_UP_VI');?></title>
      <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/style.css');?>">
      <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/login.css');?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  <script src="<?php echo v_base_url('public/back-end/assets/vendors/js/vendor.bundle.base.js');?>"></script>
   </head>
   <body>
      <div class="login-form">
         <div class="text">
            <?php VLang::__e('SIGN_IN');?>
         </div>
         <form action="<?php echo v_base_url('admin/user/doLogin');?>" method="post">
            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="email" required="required" placeholder="<?php VLang::__e('SIGN_UP_EMAIL');?>" name="username">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" required="required" placeholder="<?php VLang::__e('SIGN_UP_PASSWORD');?>" name="password">
            </div>
            <button><?php VLang::__e('SIGN_IN_LOGIN');?></button>
         </form>
      </div>
   </body>
</html>