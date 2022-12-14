<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit2'])) {
	$pid = intval($_GET['pkgid']);
	$useremail = $_SESSION['login'];
	$fromdate = $_POST['fromdate'];
	$todate = $_POST['todate'];
	$amount = $_POST['amount'];
	$perperson = $_POST['persons'];
	$comment = $_POST['comment'];
	$status = 1;
	$sql = "INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,amount,persons,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:amount, :persons,:comment,:status)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':pid', $pid, PDO::PARAM_STR);
	$query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
	$query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
	$query->bindParam(':todate', $todate, PDO::PARAM_STR);
	$query->bindParam(':amount', $amount, PDO::PARAM_STR);
	$query->bindParam(':persons', $perperson, PDO::PARAM_STR);
	$query->bindParam(':comment', $comment, PDO::PARAM_STR);
	$query->bindParam(':status', $status, PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if ($lastInsertId) {
		$msg = "Booking successful, Please complete payment.";
		echo "<script> alert('$msg') </script>";

		echo "<script> alert('$msg') </script>";
		echo "<script type='text/javascript'>document.location = 'payment-page.php?booking_id=$lastInsertId'; </script>";
	} else {
		$error = "Something went wrong. Please try again";
		echo $dbh->error;
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>NLI | Package Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- Custom Theme files -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!--animate-->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		new WOW().init();
	</script>
	<script src="js/jquery-ui.js"></script>
	<script>
		$(function() {
			$("#datepicker,#datepicker1").datepicker();
		});
	</script>
	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}

		.succWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}
	</style>
</head>

<body>
	<!-- top-header -->
	<?php include('includes/header.php'); ?>
	<div class="banner-3">
		<div class="container">
			<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> NLI -Package Details</h1>
		</div>
	</div>
	<!--- /banner ---->
	<!--- selectroom ---->
	<div class="selectroom">
		<div class="container">
			<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
			<?php
			$pid = intval($_GET['pkgid']);
			$sql = "SELECT * from tbltourpackages where PackageId=:pid";
			$query = $dbh->prepare($sql);
			$query->bindParam(':pid', $pid, PDO::PARAM_STR);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$cnt = 1;
			if ($query->rowCount() > 0) {
				foreach ($results as $result) {	?>



					<form name="book" method="post">
						<div class="selectroom_top">
							<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
								<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="">
							</div>
							<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
								<h2><?php echo htmlentities($result->PackageName); ?></h2>
								<p class="dow">#PKG-<?php echo htmlentities($result->PackageId); ?></p>
								<p><b>Package Type :</b> <?php echo htmlentities($result->PackageType); ?></p>
								<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation); ?></p>
								<p><b>Features</b> <?php echo htmlentities($result->PackageFetures); ?> </p>
								<div class="ban-bottom">
									<div class="bnr-right">
										<label class="inputLabel">From</label>
										<input class="form-control" id="dateInput1" type="date" min="<?= date('Y-m-d'); ?>" name="fromdate" required="">
									</div>
									<div class="bnr-right">
										<label class="inputLabel">To</label>
										<input class="form-control" class="form-control" id="dateInput2" type="date" min="<?= date('Y-m-d'); ?>" name="todate" onchange="daysDifference()" required="">

										<input type="hidden" name="amount" id="amount" value="">
									</div>
								</div><br><br>
								<div class="ban-bottom">
									<div class="bnr-right">
										<label class="inputLabel">No of persons</label>
										<input class="form-control" id="personInput1" type="number" name="persons" min="1" value="1" onchange="daysDifference()" required="">
									</div>
								</div>
								<br>
								<div class="clearfix"></div>
								<br>
								<div class="clearfix"></div>
								<div class="grand">
									<p>Grand Total</p>
									<h3>Rs.<span id="result"><?php echo htmlentities($result->PackagePrice); ?></span></h3>
								</div>
							</div>
							<h3>Package Details</h3>
							<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails); ?> </p>
							<div class="clearfix"></div>
						</div>
						<div class="selectroom_top">
							<h2>Travels</h2>
							<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
								<ul>

									<li class="spe">
										<label class="inputLabel">Comment</label>
										<input class="form-control" type="text" name="comment" required="">
									</li>
									<?php if ($_SESSION['login']) { ?>
										<li class="spe" align="center">
											<button type="submit" name="submit2" class="btn btn-primary" style="background-color:green; color:white">Book</button>
										</li>
									<?php } else { ?>
										<li class="sigi" align="center" style="margin-top: 1%">
											<a href="#" data-toggle="modal" data-target="#myModal4" class="btn btn-success"> Book</a>
										</li>
									<?php } ?>
									<div class="clearfix"></div>
								</ul>
							</div>

						</div>
					</form>
			<?php }
			} ?>


		</div>
	</div>
	<script>
		function daysDifference() {
			//define two variables and fetch the input from HTML form  
			var dateI1 = document.getElementById("dateInput1").value;
			var dateI2 = document.getElementById("dateInput2").value;
			var personI1 = document.getElementById("personInput1").value;
			if (dateI1 > dateI2) {
				alert('invalid dates');
				return;
			}
			//define two date object variables to store the date values  
			var date1 = new Date(dateI1);
			var date2 = new Date(dateI2);
			var person1 = new Number(personI1);
			// To calculate the time difference of two dates
			var Difference_In_Time = date2.getTime() - date1.getTime();

			// To calculate the no. of days between two dates
			var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

			// console.log(Difference_In_Days);


			if (<?php echo htmlentities($result->perday); ?> > 0 && Difference_In_Days >= 0 && personI1 >= 0) {
				var increased = Difference_In_Days * <?php echo htmlentities($result->perday); ?>;
				var increased = increased + ((personI1 - 1) * <?php echo htmlentities($result->perperson); ?>);

				var result = increased + <?php echo htmlentities($result->PackagePrice); ?>;
			} else {
				var result = <?php echo htmlentities($result->PackagePrice); ?>;

			}

			document.getElementById("amount").value = (result).toFixed(0);

			return document.getElementById("result").innerHTML =
				(result).toFixed(0);
		}
	</script>
	<!--- /selectroom ---->
	<<!--- /footer-top ---->
		<?php include('includes/footer.php'); ?>
		<!-- signup -->
		<?php include('includes/signup.php'); ?>
		<!-- //signu -->
		<!-- signin -->
		<?php include('includes/signin.php'); ?>
		<!-- //signin -->
		<!-- write us -->
		<?php include('includes/write-us.php'); ?>
</body>

</html>