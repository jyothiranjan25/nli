<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['submit5'])) {
		$password = $_POST['password'];
		$newpassword = $_POST['newpassword'];
		$confirmpassword = $_POST['confirmpassword'];
		$email = $_SESSION['login'];
		if ($newpassword == $confirmpassword) {

			$sql = mysqli_query($con, "SELECT Password FROM tblusers WHERE EmailId='$email' and Password='$password'");
			$count = mysqli_num_rows($sql);
			if ($count > 0) {

				$query = mysqli_query($con, "UPDATE tblusers set Password='$newpassword' where EmailId='$email'");
				if ($query) {
					echo '<script>alert("--Your Password succesfully changed--");</script>';
				}
			} else {
				$error = "";
				echo '<script>alert("Your current password is wrong :(");</script>';
			}
		} else {

			echo '<script>alert("New password and Confirm password do not match :(");</script>';
		}
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Change Password</title>
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

		<div class="center">
			<div class="container">
				<h3>Change Password</h3>
				<form name="chngpwd" method="post">

					<p style="width: 350px;">

						<b>Current Password</b> <input type="password" name="password" class="form-control" id="exampleInputPassword1" onmouseover="this.type='text'" onmouseout="this.type='password'" placeholder="Current Password" required="">
					</p><br>

					<p style="width: 350px;">
						<b>New Password</b>
						<input type="password" class="form-control" name="newpassword" id="newpassword" onmouseover="this.type='text'" onmouseout="this.type='password'" placeholder="New Password" required="">
					</p><br>

					<p style="width: 350px;">
						<b>Confirm Password</b>
						<input type="password" class="form-control" onmouseover="this.type='text'" onmouseout="this.type='password'" name="confirmpassword" id="confirmpassword" placeholder="Confrim Password" required="">
					</p><br>

					<p style="width: 350px;">
						<button type="submit" name="submit5" class="btn-primary btn">Change</button>
					</p>
				</form>


			</div>
		</div>
	</body>

	</html>
<?php } ?>