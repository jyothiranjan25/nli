<?php
session_start();
// error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['submit6'])) {
		$bank_no = $_POST['bank_no'];
		$cv = $_POST['cv'];
		$amt = $_POST['amt'];
		$email = $_SESSION['login'];

		$sql = mysqli_query($con, "UPDATE tblusers set bank_no='$bank_no',cv='$cv',amt='$amt' WHERE EmailId='$email'");
		if ($sql) {
			echo "<script>alert(' ---Wallet Updated successfully---');</script>";
		} else {
			echo '<script>alert("Something Gone Wrong :(");</script>';
		}
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>My Wallet</title>

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

		<?php include('includes/header.php'); ?>

		<div class="center">
			<div class="container">
				<h3>Wallet</h3>
				<form name="wallet" method="post">



					<?php
					$useremail = $_SESSION['login'];
					$query = mysqli_query($con, "SELECT * from tblusers where EmailId='$useremail'");
					while ($row = mysqli_fetch_array($query)) {


					?>

						<p style="width: 350px;">
							<b>Card Number</b>
							<input type="tel" class="form-control" name="bank_no" maxlength="16" tit value="<?php echo htmlentities($row['bank_no']); ?>" id="mobileno" required="">
						</p>
						<p style="width: 350px;">
							<b>CVV</b>
							<input type="text" class="form-control" name="cv" maxlength="3" minlength="3" value="<?php echo htmlentities($row['cv']); ?>" id="mobileno" required="">
						</p>
						<p style="width: 350px;">
							<b>Amount</b>
							<input type="number" class="form-control" name="amt" maxlength="10" value="<?php echo htmlentities($row['amt']); ?>" id="mobileno" required="">
						</p>
						<p style="width: 350px;">
							<b>Email Id</b>
							<input type="email" class="form-control" name="email" value="<?php echo htmlentities($row['EmailId']); ?>" id="email" readonly>
						</p>

						<b>Last Updation Date : </b>
						<?php echo htmlentities(date("jS-M-Y", strtotime($row['UpdationDate']))); ?> <br><br>




						<b>Reg Date :</b>
						<?php echo htmlentities(date("jS-M-Y", strtotime($row['RegDate']))); ?><br><br>

					<?php
					} ?>

					<p style="width: 350px;">
						<button type="submit" name="submit6" class="btn-primary btn">Update</button>
					</p>
				</form>


			</div>
		</div>

	</body>

	</html>
<?php } ?>