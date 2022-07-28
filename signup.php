<?php
error_reporting(0);

include('includes/dbconnection.php');
if (isset($_POST['submit'])) {

	$password = $_POST['password'];
	$cpassword = $_POST['confirmpassword'];

	if ($password == $cpassword) {
		$fname = $_POST['username'];
		$mnumber = $_POST['mobilenumber'];
		$email = $_POST['email'];
		$bank_no = rand(100000, 100000000);
		$cv = rand(1111, 9999);
		$amt = rand(1000, 9999);

		$sql = mysqli_query($con, "INSERT INTO  tblusers(FullName,MobileNumber,EmailId,bank_no,cv,amt,Password) VALUES('$fname','$mnumber','$email','$bank_no','$cv','$cmt','$password')");

		if ($sql) {
			echo "<script>alert(' ---Account Registered successfully---');
		window.location.href='signin.php';</script>";
		} else {
			echo
			"<script>alert('Something Gone wrong... Please try again...');</script>";
			$_SESSION['msg'] = "";
		}
	} else {
		echo
		"<script>alert('password & confirm password do not match. please try again!');</script>";
	}
}
?>

<!doctype html>
<html>

<head>
	<title>SignUp</title>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<style>
		h1 {
			color: white;
		}
	</style>

</head>

<body style="background-color: #FF6347">
	<br><br><br>


	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-bold">No Limits India</h1>
				<div class="well row pt-2x pb-3x bk-light">
					<div class="col-md-8 col-md-offset-2">
						<form method="post">
							Fill the following details to register! <br><br>
							<label>FullName: </label>
							<input type="text" placeholder="User Name" name="username" class="form-control">
							<label>Mobile: </label>
							<input type="text" class="form-control" placeholder="Mobile number" maxlength="10" name="mobilenumber" autocomplete="off" required="">


							<label>Emailid:</label>
							<input type="email" value="" placeholder="Email id" name="email" id="email" onBlur="checkAvailability()" autocomplete="off" class="form-control" required="">
							<span id="user-availability-status" style="font-size:12px;"></span>

							<label>Password</label>
							<input type="password" placeholder="Password" name="password" onmouseover="this.type='text'" onmouseout="this.type='password'" class="form-control"><br>

							<label>Confirm Password</label>
							<input type="password" placeholder="Password" name="confirmpassword" onmouseover="this.type='text'" onmouseout="this.type='password'" class="form-control"><br>



							<button class="btn btn-primary btn-block" style="background-color: #FF6347" name="submit" id="submit" type="submit">Register </button><br>
							<a href="index.php" class="btn btn-default">Home</a>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>