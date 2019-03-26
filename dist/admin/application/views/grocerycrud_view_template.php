<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<title>SEE - Admin Page</title>

	<?php
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>

		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

	<style type='text/css'>
		body
		{
			font-family: Arial;
			font-size: 14px;
		}
		a {
			color: blue;
			text-decoration: none;
			font-size: 14px;
		}
		a:hover
		{
			text-decoration: underline;
		}

		.tooltip {
			position: relative;
			display: inline-block;
			border-bottom: 1px dotted black;
		}

		.tooltip .tooltiptext {
			visibility: hidden;
			width: 120px;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;

			/* Position the tooltip */
			position: absolute;
			z-index: 100;
			width: 120px;
			bottom: 100%;
			left: 50%;
			margin-left: -60px; /* Use half of the width (120/2 = 60), to center the tooltip */
		}

		.tooltip:hover .tooltiptext {
			visibility: visible;
		}
	</style>
</head>
<body>
<!-- Beginning header -->

<!-- Navbar (sit on top) -->
<div class="w3-top" style="position: static">
	<div class="w3-bar w3-white w3-wide w3-padding w3-card">
		<a href="#" class="w3-bar-item w3-button"><b></b> Speculative Explorer </a>
		<a href="/admin" class="w3-bar-item w3-button"><b></b> Admin </a>
		<!-- Float links to the right. Hide them on small screens -->
		<div class="w3-right w3-hide-small">
			<a href="<?php echo site_url('auth/logout')?>" class="w3-bar-item w3-button">Log OUT</a>
		</div>
	</div>
</div>

<!-- End of header-->

<div class="w3-container">

	<div class="w3-margin-top">

		<a href='<?php echo site_url('management/ecosystem')?>'>View All Ecosystems</a> |
		<a href='<?php echo site_url('management/node')?>'>View All Nodes</a>

	</div>
	<div style='height:20px;'></div>

	<div>
		<?php echo $output; ?>
	</div>
</div>

<!-- Beginning footer -->
<!--<div>Footer</div>-->
<!-- End of Footer -->
</body>
</html>

