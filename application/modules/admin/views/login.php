<div class="login-box">

	<div class="login-logo"><b><?php echo $site_name; ?></b></div>

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<?php echo $form->open(); ?>
			<?php echo $form->messages(); ?>
			<?php echo $form->bs3_text('Username', 'username', ENVIRONMENT==='development' ? '' : ''); ?>
			<?php echo $form->bs3_password('Password', 'password', ENVIRONMENT==='development' ? '' : ''); ?>
			<div class="row">
				<div class="col-xs-6">
					<div class="checkbox">
						<label><input type="checkbox" name="remember"> Remember Me</label>
					</div>
				</div>
				<div class="col-xs-6">
					<?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat'); ?>
				</div>
			</div>
<!-- 			<div class="row">
				<div class="col-xs-12 text-center">
					<br>
					<a href="../" class="btn btn-success btn-block btn-flat" role="button">Frontend</a>
				</div>
				
			</div> -->
		<?php echo $form->close(); ?>
	</div>

</div>