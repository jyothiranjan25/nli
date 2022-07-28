<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {
	$pid = intval($_GET['pkgid']);
	$present_date = date("Y-m-d");
	$useremail = $_SESSION['login'];
	$fromdate = $_POST['fromdate'];
	$to_date = 0;
	$package_price = 0;
	$useramt = 0;

	$sql = "SELECT * from tbltourpackages  WHERE PackageId=:id";
	$query = $dbh->prepare($sql);
	$query->bindParam(':id', $pid, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		foreach ($results as $result) {
			$to_date = $result->no_of_days;
			$package_price = $result->PackagePrice;
		}
	}
	//user price
	$sqluser = "SELECT * from tblusers  WHERE EmailId=:useremail";
	$queryuser = $dbh->prepare($sqluser);
	$queryuser->bindParam(':useremail', $useremail, PDO::PARAM_STR);
	$queryuser->execute();
	$results = $queryuser->fetchAll(PDO::FETCH_OBJ);
	if ($queryuser->rowCount() > 0) {
		foreach ($results as $result) {
			$useramt = $result->amt;
		}
	}


	$date = $fromdate;
	$str = "+" . $to_date . "days";
	$todate = date('Y-m-d', strtotime($date . $str));


	// $newdate=strtotime("+2 days");
	// $todate=date($fromdate,$newdate);
	$comment = $_POST['comment'];
	$comment2 = $_POST['comment2'];
	$age = $_POST['age'];


	$status = 0;
	if ($present_date < $fromdate) {
		if ($useramt > $package_price) {

			$sqls = "INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,Age,comment2,status) VALUES('$pid','$useremail','$fromdate','$todate','$comment','$age','$comment2','$status')";
			$querys = $dbh->prepare($sqls);

			$lastInsert = $querys->execute();
			$lastInsertId = $dbh->lastInsertId();



			$newamt = $useramt - $package_price;
			$sqlupdate = "update tblusers set amt=:newamt where EmailId=:useremail";
			$queryupdate = $dbh->prepare($sqlupdate);
			$queryupdate->bindParam(':useremail', $useremail, PDO::PARAM_STR);
			$queryupdate->bindParam(':newamt', $newamt, PDO::PARAM_STR);
			$queryupdate->execute();


			if ($lastInsert) {
				echo "<script>alert('Booking Request sent successfully!')</script>";
			} else {

				echo "<script>alert('Something went wrong. Please try again!')</script>";
			}
		} else {
			echo "<script>alert('You Dont have Sufficient balance')</script>";
		}
	} else {
		echo "<script>alert('ENTER PROPER DATE')</script>";
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Package Details</title>

	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
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
			width: 60%;
			border: 3px solid #FF6347;
			padding: 25px;
			margin-top: 25px;
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


		}
	</style>

</head>

<body><?php include('includes/header.php'); ?><div class="selectroom">
		<div class="container"><?php
							$pid = intval($_GET['pkgid']);
							$sql = "SELECT * from tbltourpackages where PackageId=:pid";
							$query = $dbh->prepare($sql);
							$query->bindParam(':pid', $pid, PDO::PARAM_STR);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);
							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $result) {	?><form method="post">
						<div class="selectroom_top">
							<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s"><img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt=""></div>
							<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
								<h2><?php echo htmlentities($result->PackageName); ?></h2>
								<p class="dow">#PKG-<?php echo htmlentities($result->PackageId); ?></p>
								<p><b>Package Type :</b><?php echo htmlentities($result->PackageType); ?></p>
								<p><b>Package Location :</b><?php echo htmlentities($result->PackageLocation); ?></p>
								<p><b>Features</b><?php echo htmlentities($result->PackageFetures); ?></p>
								<div class="ban-bottom">
									<div class="bnr-right"><label class="inputLabel">From</label><input type="date" autocomplete="off" placeholder="dd-mm-yyyy" name="fromdate" required="" min="<?php echo date("Y-m-d"); ?>"></div>
								</div>
								<div class="clearfix"></div>
								<div class="grand">
									<p>Grand Total</p>
									<h3>Rs <?php echo htmlentities($result->PackagePrice); ?></h3>
								</div>
							</div>
							<h3>Package Details</h3>
							<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails); ?></p>
							<div class="clearfix"></div>
						</div>
						<div class="selectroom_top">
							<h2>Personal Details</h2>
							<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
								<ul>
									<li class="spe"><label class="inputLabel">Passenger 1</label><input class="special" type="text" name="comment" required=""></li>
									<li class="spe"><label class="inputLabel">Passenger 2(leave blank for solo tour)</label><input class="special" type="text" name="comment2"></li>
									<li class="spe"><label class="inputLabel">Passenger Age(Years)</label><input class="special" type="text" name="age"></li><?php if ($_SESSION['login']) { ?><li class="spe" align="center">

											<button type="submit" name="submit" class="btn-primary btn">Proceed to payment</button>
										</li><?php } else { ?><li class="sigi" align="center" style="margin-top: 1%"><a href="signin.php" class="btn-primary btn">Book</a></li><?php } ?><div class="clearfix"></div>
								</ul>
							</div>
						</div>
					</form><?php }
							} ?></div>
	</div>
</body>

</html>