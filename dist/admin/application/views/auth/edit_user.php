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


	<h1><?php echo lang('edit_user_heading');?></h1>
	<p><?php echo lang('edit_user_subheading');?></p>

	<p><?php echo $user->email?></p>


	<div class="w3-panel w3-border w3-light-grey w3-round-large" style="display: <?php echo $message == null?  'none' : 'block'; ?>">
		<div id="infoMessage"><?php echo $message;?></div>
	</div>

	<div class="w3-container w3-half w3-margin-top">
		<?php echo form_open(uri_string());?>

			  <p>
					<?php echo lang('edit_user_password_label', 'password');?> <br />
					<?php echo form_input($password, '','class="w3-input"');?>
			  </p>

			  <p>
					<?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
					<?php echo form_input($password_confirm, '','class="w3-input"');?>
			  </p>

			  <?php if ($this->ion_auth->is_admin()): ?>

				  <h3><?php echo lang('edit_user_groups_heading');?></h3>
				  <?php foreach ($groups as $group):?>
					  <label class="checkbox">
					  <?php
						  $gID=$group['id'];
						  $checked = null;
						  $item = null;
						  foreach($currentGroups as $grp) {
							  if ($gID == $grp->id) {
								  $checked= ' checked="checked"';
							  break;
							  }
						  }
					  ?>
					  <input type="checkbox" name="groups[]" class="w3-check" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
					  <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
					  </label>
				  <?php endforeach?>

			  <?php endif ?>

			  <?php echo form_hidden('id', $user->id);?>
			  <?php echo form_hidden($csrf); ?>

			  <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="w3-button w3-section w3-light-gray w3-ripple"');?></p>

		<?php echo form_close();?>
	</div>

</div>



</body>
</html>
