<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

?>
<!DOCTYPE HTML>
<html>

<head>
	<title> No Limits India</title>
	<style>
		a {
			background-color: #FF6347;
			color: black;
			padding: 0.5em 1em;
			text-decoration: none;
			text-transform: uppercase;

		}

		a:hover {
			background-color: #555;
			cursor: pointer;

		}

		.center {
			margin: auto;
			width: 70%;

			border: 3px solid #FF6347;
			padding: 25px;
			margin-top: 75px;
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


		}

		.clearfix {
			overflow: auto;
		}
	</style>

</head>

<body>
	<!-- top-header -->

	<?php include('includes/header.php'); ?>

	<h3>About us:</h3>

	<div class="center">

		<?php
		$query = mysqli_query($con, "SELECT detail from tblpages where id=1");
		while ($row = mysqli_fetch_array($query)) {
			$result = $row['detail'];
		}

		?>

		<pre><?php echo $result; ?></pre>

	</div>
</body>

</html>