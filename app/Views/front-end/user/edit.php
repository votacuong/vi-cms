<?php echo showMessages(); ?>
	<div class="card h-100 thecup-container">
	  <div class="card-body">
		<?= \Config\Services::validation()->listErrors(); ?>
		<h4 class="card-title">
		<?php if ( $this->data['details']['id'] > 0 ):?>
		<?php VLang::__e('USER_EDITUSER'); echo $this->data['details']['firstname'].' '.$this->data['details']['lastname'];?>
		<?php else:?>
		<?php VLang::__e('USER_NEWUSER');?>
		<?php endif;?>
		</h4>
		<form class="forms-sample" method="post" action="<?php echo v_base_url('user/edit');?>" enctype="multipart/form-data" >
		  <div class="col-auto">
			<label for="Firstname"><?php VLang::__e('USER_EDITUSER_FIRSTNAME');?></label>
			<input type="text" class="form-control" id="Firstname" placeholder="Firstname" name="firstname" value="<?php echo $this->data['details']['firstname'];?>">
		  </div>
		  <div class="col-auto">
			<label for="Lastname"><?php VLang::__e('USER_EDITUSER_LASTNAME');?></label>
			<input type="text" class="form-control" id="Lastname" placeholder="Lastname" name="lastname" value="<?php echo $this->data['details']['lastname'];?>">
		  </div>
		  <div class="col-auto">
			<label for="Phone"><?php VLang::__e('USER_EDITUSER_PHONE');?></label>
			<input type="text" class="form-control" id="Phone" placeholder="Phone" name="phone" value="<?php echo $this->data['details']['phone'];?>">
		  </div>
		  <div class="col-auto">
			<label for="email"><?php VLang::__e('USER_EDITUSER_EMAIL');?></label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email" <?php if ($this->data['details']['id'] > 0){ echo 'disabled="disabled"';}?> value="<?php echo $this->data['details']['email'];?>">
		  </div>
		  <div class="col-auto">
			<label for="username"><?php VLang::__e('USER_EDITUSER_USERNAME');?></label>
			<input type="text" class="form-control" id="username" placeholder="username" name="username" <?php if ($this->data['details']['id'] > 0){ echo 'disabled="disabled"';}?> value="<?php echo $this->data['details']['username'];?>">
		  </div>
		  <div class="form-group" style="display: none;">
			<label for="user_type"><?php VLang::__e('USER_EDITUSER_USERTYPE');?></label>
			<select class="form-control" id="user_type" name="user_type">
			  <option value="1" <?php if ($this->data['details']['user_type'] == 1){ echo 'selected="selected"';}?>><?php VLang::__e('USER_EDITUSER_USERTYPE_ADMINISTRATOR');?></option>
			  <option value="2" <?php if ($this->data['details']['user_type'] == 2){ echo 'selected="selected"';}?>><?php VLang::__e('USER_EDITUSER_USERTYPE_OWNER');?></option>
			  <option value="3" <?php if ($this->data['details']['user_type'] == 3){ echo 'selected="selected"';}?>><?php VLang::__e('USER_EDITUSER_USERTYPE_CUSTOMER');?></option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="language"><?php VLang::__e('USER_LANGUAGE');?></label>
			<select class="form-control" name="language" id="language">
				<option value="en-GB" <?php if( $this->data['details']['language'] == 'en-GB'){ echo 'selected="selected"';}?>>English</option>
				<option value="Arabic" <?php if( $this->data['details']['language'] == 'Arabic'){ echo 'selected="selected"';}?>>Arabic</option>
				<option value="Chinese" <?php if( $this->data['details']['language'] == 'Chinese'){ echo 'selected="selected"';}?>>Chinese</option>
				<option value="French" <?php if( $this->data['details']['language'] == 'French'){ echo 'selected="selected"';}?>>French</option>
				<option value="Russian" <?php if( $this->data['details']['language'] == 'Russian'){ echo 'selected="selected"';}?>>Russian</option>
				<option value="Spanish" <?php if( $this->data['details']['language'] == 'Spanish'){ echo 'selected="selected"';}?>>Spanish</option>
			</select>
		  </div>
		  <div class="col-auto">
			<label><?php VLang::__e('USER_EDIT_PHOTO');?></label>
			<input type="file" name="photo" class="file-upload-default" id="photo" style="display:none;" />
			<div class="input-group col-xs-12">
			  <input type="text" class="form-control file-upload-info" disabled="" placeholder="<?php VLang::__e('USER_EDIT_UPLOAD_PHOTO');?>">
			  <span class="input-group-append">
				<button class="file-upload-browse btn btn-primary" type="button" onCLick="jQuery('#photo').click();"><?php VLang::__e('USER_EDIT_UPLOAD_PHOTO');?></button>
			  </span>
			</div>
		  </div>
		  <div class="col-auto">
			<label for="password"><?php VLang::__e('USER_EDITUSER_PASSWORD');?></label>
			<input type="password" class="form-control" id="password" placeholder="Password" name="password" value="">
		  </div>
		  <div class="col-auto">
			<label for="retypePassword"><?php VLang::__e('USER_EDITUSER_RETYPEPASSWORD');?></label>
			<input type="password" class="form-control" id="retypePassword" placeholder="retypePassword" name="retypePassword" value="">
		  </div>
		  <div class="col-auto form-bottom">
		  <input type="submit" name="submit" class="btn btn-primary mr-2" value="<?php VLang::__e('USER_EDITUSER_SUBMIT');?>" />
		  <a class="btn btn-dark" href="<?php echo v_base_url('');?>"><?php VLang::__e('USER_EDITUSER_CANCEL');?></a>
		  </div>
		</form>
	  </div>
	</div>