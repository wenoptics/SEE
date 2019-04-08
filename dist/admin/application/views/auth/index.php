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


	<h1><?php echo lang('index_heading');?></h1>
	<p><?php echo lang('index_subheading');?></p>

	<div class="w3-panel w3-border w3-light-grey w3-round-large" style="display: <?php echo $message == null?  'none' : 'block'; ?>">
		<p><?php echo $message;?></p>
	</div>


	<div class="w3-container w3-half w3-margin-top">


		<table cellpadding=0 cellspacing=10 class="w3-table-all">
			<tr>
				<!--<th><?php /*echo lang('index_fname_th');*/?></th>
				<th><?php /*echo lang('index_lname_th');*/?></th>-->
				<th><?php echo lang('index_email_th');?></th>
				<th><?php echo lang('index_groups_th');?></th>
				<th><?php echo lang('index_status_th');?></th>
				<th><?php echo lang('index_action_th');?></th>
			</tr>
			<?php foreach ($users as $user):?>
				<tr>
					<!--<td><?php /*echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');*/?></td>
					<td><?php /*echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');*/?></td>
					-->
					<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
					<td>
						<?php foreach ($user->groups as $group):?>
							<?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ;?><br />
						<?php endforeach?>
					</td>
					<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
					<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
				</tr>
			<?php endforeach;?>
		</table>

		<p><?php echo anchor('auth/create_user', lang('index_create_user_link'));?>
			<!--|
			<?php /*echo anchor('auth/create_group', lang('index_create_group_link'))*/?>
			-->
		</p>
	</div>
</div>



</body>
</html>
