<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['submit6'])) {
		$name = $_POST['name'];
		$mobileno = $_POST['mobileno'];
		$email = $_SESSION['login'];
		$sql = mysqli_query($con, "UPDATE tblusers SET FullName='$name', MobileNumber='$mobileno' WHERE EmailId='$email'");
		if ($sql) {
			echo '<script>alert(" ---Profile Updated Successfully---");</script>';
		} else {
			echo '<script>alert("Not successful:( SOMETHING GONE WRONG");</script>';
		}
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>My Profile</title>

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
				width: 60%;
				border: 3px solid #FF6347;
				padding: 25px;
				margin-top: 25px;
				box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


			}
		</style>
	</head>

	<body>

		<?php include('includes/header.php'); ?>

		<div class="center">
			<div class="container">
				<h3>Profile</h3>
				<form name="chngpwd" method="post">


					<?php
					$useremail = $_SESSION['login'];
					$query = mysqli_query($con, "SELECT * from tblusers where EmailId='$useremail'");
					while ($row = mysqli_fetch_array($query)) {


					?>
						<p style="width: 350px;">

							<b>Name:</b> <input type="text" name="name" value="<?php echo htmlentities($row['FullName']); ?>" class="form-control" id="name" required="">
						</p>

						<p style="width: 350px;">
							<b>Mobile Number:</b>
							<input type="tel" class="form-control" name="mobileno" maxlength="10" value="<?php echo htmlentities($row['MobileNumber']); ?>" id="mobileno" required="">
						</p>

						<p style="width: 350px;">
							<b>Card Number</b>
							<input type="number" class="form-control" name="bank_no" maxlength="10" value="<?php echo htmlentities($row['bank_no']); ?>" id="bank_no" readonly>
						</p>
						<p style="width: 350px;">
							<b>Balance (Rs)</b>
							<input type="number" class="form-control" name="amt" maxlength="10" value="<?php echo htmlentities($row['amt']); ?>" id="amt" readonly>
						</p>
						<p style="width: 350px;">
							<b>Email Id</b>
							<input type="email" class="form-control" name="email" value="<?php echo htmlentities($row['EmailId']); ?>" id="email" readonly>
						</p>

						<b>Last Updation Date : </b>
						<?php echo htmlentities($row['UpdationDate']); ?><br><br>



						<b>Reg Date :</b>
						<?php echo htmlentities($row['RegDate']); ?> <br><br>

					<?php }
					?>


					<button type="submit" name="submit6" class="btn-primary btn">Update</button>

				</form>


			</div>
		</div>

	</body>

	</html>
<?php } ?>