<?php echo showMessages(); ?>
<div class="col-12 grid-margin stretch-card">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title">
		<?php VLang::__e('SETTINGS');?>
		</h4>

		<form class="forms-sample" method="post" action="<?php echo v_base_url('admin/settings');?>">
		  <div class="form-group">
			<label for="system_language"><?php VLang::__e('SETTING_SYSTEMLANGUAGE');?></label>
			<select class="form-control" name="system_language" id="system_language">
				<option value="en-GB" <?php if( $this->data['details']->system_language == 'en-GB'){ echo 'selected="selected"';}?>><?php VLang::__e('SETTING_SYSTEMLANGUAGE_ENGLISH');?></option>
				<option value="French" <?php if( $this->data['details']->system_language == 'French'){ echo 'selected="selected"';}?>>French</option>
				<option value="Russian" <?php if( $this->data['details']->system_language == 'Russian'){ echo 'selected="selected"';}?>>Russian</option>
				<option value="Spanish" <?php if( $this->data['details']->system_language == 'Spanish'){ echo 'selected="selected"';}?>>Spanish</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="mailfrom"><?php VLang::__e('SETTING_MAILFROM');?></label>
			<input type="text" class="form-control" id="mailfrom" placeholder="<?php VLang::__e('SETTING_MAILFROM');?>" name="mailfrom" value="<?php echo $this->data['details']->mailfrom;?>">
		  </div>
		  <div class="form-group">
			<label for="google_app_password"><?php VLang::__e('SETTING_GOOGLE_APP_PASSWORD');?></label>
			<input type="text" class="form-control" id="google_app_password" placeholder="<?php VLang::__e('SETTING_GOOGLE_APP_PASSWORD');?>" name="google_app_password" value="<?php echo $this->data['details']->google_app_password;?>">
		  </div>


		  <input type="submit" name="submit" class="btn btn-primary mr-2" value="<?php VLang::__e('SETTING_SUBMIT');?>" />
		  <a class="btn btn-dark" href="<?php echo v_base_url('admin/dashboard');?>"><?php VLang::__e('SETTING_CANCEL');?></a>
		</form>
	  </div>
	</div>
  </div>