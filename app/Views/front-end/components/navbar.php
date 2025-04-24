<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar-shadow">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="<?php echo v_base_url('');?>"><?php VLang::__e('VI_LOGON');?></a></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo v_base_url('');?>"><?php VLang::__e('VI_HOME');?></a></li>
				<li class="nav-item"><a class="nav-link" href="<?php echo v_base_url('about');?>"><?php VLang::__e('VI_ABOUT');?></a></li>
			</ul>
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 profile-button">
			<li class="nav-item dropdown">
			<?php $UserModel = new \App\Models\UserModel();?>
			<?php if ($UserModel->isLogin()):?>
			<a class="dropdown-item"  href="<?php echo v_base_url('user/logout');?>"><?php VLang::__e('VI_PROFILE_LOGOUT');?></a>
			<?php else:?>
			<a class="dropdown-item"  href="<?php echo v_base_url('user/login');?>"><?php VLang::__e('VI_PROFILE_LOGIN');?></a>
			<?php endif;?>
			</li>
			</ul>
		</div>
	</div>
</nav>
<header class="bg-dark py-5">
	<div class="container px-4 px-lg-5 my-5">
		<div class="text-center text-white">
			<h1 class="display-4 fw-bolder"><?php VLang::__e('VI_BANNER');?></h1>
			<p class="lead fw-normal text-white-50 mb-0"><?php VLang::__e('VI_BANNER_DESCRIPTION');?></p>
		</div>
	</div>
</header>