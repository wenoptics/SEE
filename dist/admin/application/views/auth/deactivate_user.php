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

<div class="w3-container w3-content w3-margin-top">

	<h1><?php echo lang('deactivate_heading');?></h1>
	<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>


	<div class="w3-card w3-half w3-margin-top" style="padding: 2vh 5vh;">
		<?php echo form_open("auth/deactivate/".$user->id);?>

		  <p>
			<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
			<input type="radio" name="confirm" value="yes" checked="checked" />
			<?php echo lang('deactivate_confirm_n_label', 'confirm');?>
			<input type="radio" name="confirm" value="no" />
		  </p>

		  <?php echo form_hidden($csrf); ?>
		  <?php echo form_hidden(['id' => $user->id]); ?>

		  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'));?></p>

		<?php echo form_close();?>
	</div>

</div>


</body>
</html>
