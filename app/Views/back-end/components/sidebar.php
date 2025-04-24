<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
	  <a class="sidebar-brand brand-logo" href="index.html"><img src="<?php echo v_base_url('public/back-end/assets/images/logo.svg');?>" alt="logo" /></a>
	  <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="<?php echo v_base_url('public/back-end/assets/images/logo-mini.svg');?>" alt="logo" /></a>
	</div>
	<ul class="nav">
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'dashboard') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/dashboard');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-view-dashboard"></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('DASHBOARD');?></span>
		</a>
	  </li>
	  <?php if (session()->get('user_type') == 1 ):?>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'user') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/users');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-account-multiple"></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('USERS');?></span>
		</a>
	  </li>
	  <?php endif;?>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'setting') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/settings');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-camera-iris"></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('SETTINGS');?></span>
		</a>
	  </li>
	</ul>
</nav>