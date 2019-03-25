<!DOCTYPE html>
<html>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top" style="position: static">
	<div class="w3-bar w3-white w3-wide w3-padding w3-card">
		<a href="#" class="w3-bar-item w3-button"><b></b> Speculative Explorer </a>
		<a href="/admin" class="w3-bar-item w3-button"><b></b> Admin </a>
		<!-- Float links to the right. Hide them on small screens -->
		<div class="w3-right w3-hide-small">
			<a href="/admin/index.php/auth/login" class="w3-bar-item w3-button">Log in</a>
		</div>
	</div>
</div>

<div class="w3-container">

	<h1><?php echo lang('forgot_password_heading');?></h1>
	<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

	<!-- The Modal -->
	<div id="infoMessage" class="w3-modal" style="display: <?php echo $message == null?  'none' : 'block'; ?>">
		<div class="w3-modal-content">
			<div class="w3-container">
      			<span onclick="document.getElementById('infoMessage').style.display='none'"
					  class="w3-button w3-display-topright">&times;</span>
				<p><?php echo $message;?></p>
			</div>
		</div>
	</div>


	<div class="w3-card w3-half w3-margin-top" style="padding: 2vh 5vh;">

		<?php echo form_open("auth/forgot_password");?>

		<p>
			<label for="identity"><?php echo (($type=='email')
					? sprintf(lang('forgot_password_email_label'), $identity_label)
					: sprintf(lang('forgot_password_identity_label'), $identity_label));?>
			</label>
			<br />
			<?php echo form_input($identity, '','class="w3-input"');?>
		</p>

		<p><?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="w3-button w3-section w3-light-gray w3-ripple"');?></p>

		<?php echo form_close();?>


	</div>
</div>



</body>
</html>



