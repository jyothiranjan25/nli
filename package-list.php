<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Package List</title>



	<style>
		a {
			background-color: #FF6347;
			color: black;
			padding: 0.5em 1em;
			text-decoration: none;
			text-transform: uppercase;
			border-radius: 10px;

		}

		a:hover {
			background-color: #555;
			cursor: pointer;

		}

		.center {
			margin: auto;
			width: 60%;
			border: 3px solid #FF6347;
			padding: 5px;
			margin-top: 25px;
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;


		}

		.clearfix {
			overflow: auto;
		}

		img {
			height: 290px;
			width: 40%;
			float: left;
			margin-right: 20px;

		}
	</style>
</head>

<body>
	<?php include('includes/header.php'); ?>
	<!--- banner ---->


	<h3>All Packages:</h3>



	<?php $query = mysqli_query($con, "SELECT * from tbltourpackages");
	$count = mysqli_num_rows($query);
	$cnt = 1;
	if ($count > 0) {
		while ($row = mysqli_fetch_array($query)) {


	?>
			<div class="center">
				<div class="clearfix">

					<img src="admin/pacakgeimages/<?php echo htmlentities($row['PackageImage']); ?>">
					<h4>Package Name: <?php echo htmlentities($row['PackageName']); ?></h4>
					<h6>Package Type : <?php echo htmlentities($row['PackageType']); ?></h6>
					<p><b>Package Location :</b> <?php echo htmlentities($row['PackageLocation']); ?></p>
					<p><b>Features</b> <?php echo htmlentities($row['PackageFetures']); ?></p>


					<h5>Rs. <?php echo htmlentities($row['PackagePrice']); ?> /-</h5>
					<a href="package-details.php?pkgid=<?php echo htmlentities($row['PackageId']); ?>" class="view">Details</a>
				</div>
				<br>
			</div>

	<?php }
	} ?>




	</div>
	</div>
	</div>

	<?php include('includes/write-us.php'); ?>
	<!-- //write us -->
</body>

</html>