<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['submit1'])) {
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobileno'];
	$subject = $_POST['subject'];
	$description = $_POST['description'];


	$sql = mysqli_query($con, "INSERT INTO  tblenquiry(FullName,EmailId,MobileNumber,Subject,Description) VALUES('$fname','$email','$mobile','$subject','$description')");
	if ($sql) {

		echo '<script>alert(" ---Thankyou we will get back to u ASAP---");</script>';
	} else {
		echo '<script>alert("Not successful:( SOMETHING GONE WRONG");</script>';
	}
}


?>
<!DOCTYPE HTML>
<html>

<head>

	<title>Enquiry</title>

	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
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
			width: 40%;
			border: 3px solid #FF6347;
			padding: 25px;
			margin-top: 35px;
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



	<div class="center">

		<form name="enquiry" method="post">

			<p style="width: 350px;">
				<b>Full name</b> <input type="text" name="fname" class="form-control" id="fname" placeholder="Full Name" required="">
			</p>

			<p style="width: 350px;">
				<b>Email</b> <input type="email" name="email" class="form-control" id="email" placeholder="Valid Email id" required="">
			</p>

			<p style="width: 350px;">
				<b>Mobile No</b> <input type="number" name="mobileno" class="form-control" id="mobileno" maxlength="10" placeholder="10 Digit mobile No" required="">
			</p>

			<p style="width: 350px;">
				<b>Subject</b> <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required="">
			</p>
			<p style="width: 350px;">
				<b>Description</b> <textarea name="description" class="form-control" rows="6" cols="50" id="description" placeholder="Description" required=""></textarea>
			</p>


			<button type="submit" name="submit1" class="btn-primary btn">Submit</button>

		</form>

	</div>

</body>

</html>