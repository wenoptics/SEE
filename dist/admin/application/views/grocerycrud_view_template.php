<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />

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
<div>
	<a href='<?php echo site_url('examples/offices_management')?>'>Offices</a> |
	<a href='<?php echo site_url('examples/employees_management')?>'>Employees</a> |
	<a href='<?php echo site_url('examples/customers_management')?>'>Customers</a> |
	<a href='<?php echo site_url('examples/orders_management')?>'>Orders</a> |
	<a href='<?php echo site_url('examples/products_management')?>'>Products</a> |
	<a href='<?php echo site_url('examples/film_management')?>'>Films</a> -
	<a href='<?php echo site_url('auth/logout')?>'>Log out</a>

</div>
<!-- End of header-->
<div style='height:20px;'></div>

<div>
	<?php echo $output; ?>
</div>

<!-- Beginning footer -->
<div>Footer</div>
<!-- End of Footer -->
</body>
</html>

