<!DOCTYPE html>
<html>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top" style="position: static">
	<div class="w3-bar w3-white w3-wide w3-padding w3-card">
		<a href="/" class="w3-bar-item w3-button"><b></b> Speculative Explorer </a>
		<a href="/admin" class="w3-bar-item w3-button"><b></b> Admin </a>
		<!-- Float links to the right. Hide them on small screens -->
		<div class="w3-right w3-hide-small">
			<a href="/admin/index.php/auth/login" class="w3-bar-item w3-button">Log in</a>
		</div>
	</div>
</div>

<div class="w3-container w3-content w3-margin-top">

	<p><?php echo lang('login_subheading');?></p>

	<div class="w3-panel w3-border w3-light-grey w3-round-large" style="display: <?php echo $message == null?  'none' : 'block'; ?>">
		<p><?php echo $message;?></p>
	</div>


	<div class="w3-container w3-half w3-margin-top">


		<?php echo form_open("auth/login", array('class'=>'w3-container w3-card-4'));?>

		<p>
			<?php echo lang('login_identity_label', 'identity');?>
			<?php echo form_input($identity, '', 'class="w3-input"');?>
		</p>

		<p>
			<?php echo lang('login_password_label', 'password');?>
			<?php echo form_input($password, '','class="w3-input"');?>
		</p>

		<p>
			<?php echo lang('login_remember_label', 'remember');?>
			<?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="w3-check"');?>
		</p>

		<p><?php echo form_submit('submit', lang('login_submit_btn'), 'class="w3-button w3-section w3-light-gray w3-ripple"');?></p>
		<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

		<?php echo form_close();?>


	</div>
</div>



</body>
</html>




