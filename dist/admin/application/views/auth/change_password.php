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
			<a href="<?php echo site_url('auth/logout')?>" class="w3-bar-item w3-button">Log OUT</a>
		</div>
	</div>
</div>

<div class="w3-container w3-content w3-margin-top">

	<h1><?php echo lang('change_password_heading');?></h1>


	<div class="w3-panel w3-border w3-light-grey w3-round-large" style="display: <?php echo $message == null?  'none' : 'block'; ?>">
		<div id="infoMessage"><?php echo $message;?></div>
	</div>

	<div class="w3-card w3-half w3-margin-top" style="padding: 2vh 5vh;">

		<?php echo form_open("auth/change_password");?>

			  <p>
					<?php echo lang('change_password_old_password_label', 'old_password');?> <br />
					<?php echo form_input($old_password, '', 'class="w3-input"');?>
			  </p>

			  <p>
					<label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
					<?php echo form_input($new_password, '','class="w3-input"');?>
			  </p>

			  <p>
					<?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
					<?php echo form_input($new_password_confirm, '','class="w3-input"');?>
			  </p>

			  <?php echo form_input($user_id);?>
			  <p><?php echo form_submit('submit', lang('change_password_submit_btn'), 'class="w3-button w3-section w3-light-gray w3-ripple"');?></p>

		<?php echo form_close();?>
	</div>

</div>
</body>
</html>
