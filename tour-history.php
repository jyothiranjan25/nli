<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['bkid'])) {
		$bid = intval($_GET['bkid']);
		$email = $_SESSION['login'];
		// $sqlz = mysqli_query($con, "SELECT FromDate FROM tblbooking WHERE UserEmail='$email' and BookingId='$bid'");
		// $count = mysqli_num_rows($sqlz);
		// if ($count > 0) {
		// 	while ($row = mysqli_fetch_array($sqlz)) {

		// $fdate = $row['FromDate'];
		// $a = explode("/", $fdate);
		// $val = array_reverse($a);
		// $mydate = implode("/", $val);
		// $cdate = date('Y/m/d');
		// $date1 = date_create("$cdate");
		// $date2 = date_create("$fdate");
		// $diff = date_diff($date1, $date2);
		// echo $df = $diff->format("%a");
		// if ($df > 1) {
		$status = 2;
		$cancelby = 'u';
		$sqly = mysqli_query($con, "UPDATE tblbooking SET status='$status',CancelledBy='$cancelby' WHERE UserEmail='$email' AND BookingId='$bid'");
		if ($sqly) {
			echo "<script>alert(' ---Booking Cancelled successfully---');</script>";
		} else {
			echo '<script>alert("You cant cancel booking just before 24 hours :(");</script>';
		}

		// }
	}
	// }

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Travel History</title>
		<style>
			a {
				background-color: #FF6347;
				color: black;
				padding: 0.3em 1em;
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

			.clearfix {
				overflow: auto;
			}

			table {
				border-collapse: collapse;
				width: 100%;
			}

			th,
			td {
				text-align: left;
				padding: 10px;
			}

			tr:nth-child(even) {
				background-color: #f2f2f2
			}

			th {
				background-color: #4CAF50;
				color: white;
			}
		</style>
	</head>

	<body>

		<?php include('includes/header.php'); ?>

		<div class="privacy">
			<div class="container">
				<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">My Travel History:</h3>
				<form name="chngpwd" method="post">

					<p>
					<table border="1" width="100%">
						<tr align="center">
							<th>#</th>
							<th>Booking Id</th>
							<th>Package Name</th>
							<th>From</th>
							<th>To</th>
							<th>Comment</th>
							<th>Status</th>
							<th>Booking Date</th>
							<th>Action</th>
						</tr>
						<?php

						$uemail = $_SESSION['login'];;
						$sql = mysqli_query($con, "SELECT tblbooking.BookingId as bookid,tblbooking.PackageId as pkgid,tbltourpackages.PackageName as packagename,tblbooking.FromDate as fromdate,tblbooking.ToDate as todate,tblbooking.Comment as comment,tblbooking.status as status,tblbooking.RegDate as regdate,tblbooking.CancelledBy as cancelby,tblbooking.UpdationDate as upddate from tblbooking join tbltourpackages on tbltourpackages.PackageId=tblbooking.PackageId WHERE UserEmail='$uemail'");

						$cnt = 1;
						$count = mysqli_num_rows($sql);
						if ($count > 0) {
							while ($row = mysqli_fetch_array($sql)) {


						?>
								<tr align="center">
									<td><?php echo htmlentities($cnt); ?></td>
									<td>#BK<?php echo htmlentities($row['bookid']); ?></td>
									<td><a href="package-details.php?pkgid=<?php echo htmlentities($row['pkgid']); ?>"><?php echo htmlentities($row['packagename']); ?></a></td>
									<td><?php echo htmlentities(date("jS-M-Y", strtotime($row['fromdate']))); ?></td>
									<td><?php echo htmlentities(date("jS-M-Y", strtotime($row['todate']))); ?></td>
									<td><?php echo htmlentities($row['comment']); ?></td>
									<td><?php if ($row['status'] == 0) {
											echo "Pending";
										}
										if ($row['status'] == 1) {
											echo "Confirmed";
										}
										if ($row['status'] == 2 and  $row['cancelby'] == "u") {
											echo "Cancelled by you on " .  date("jS-M-Y G:i", strtotime($row['upddate']));
										}
										if ($row['status'] == 2 and $row['cancelby'] == "a") {
											echo "Cancelled by admin on " .  date("jS-M-Y  G:i", strtotime($row['upddate']));
										}
										?></td>
									<td><?php echo htmlentities(date("jS-M-Y", strtotime($row['regdate']))); ?></td>
									<?php if ($row['status'] == 2) {
									?><td>Cancelled</td>
									<?php } else { ?>
										<td><a href="tour-history.php?bkid=<?php echo htmlentities($row['bookid']); ?>" onclick="return confirm('Do you really want to cancel booking')">Cancel</a></td>
									<?php } ?>
								</tr>
						<?php $cnt = $cnt + 1;
							}
						} ?>
					</table>

					</p>
				</form>


			</div>
		</div>

	</body>

	</html>
<?php } ?>