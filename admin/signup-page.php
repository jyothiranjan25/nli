<?php
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$mnumber = $_POST['mobilenumber'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':fname', $fname, PDO::PARAM_STR);
	$query->bindParam(':mnumber', $mnumber, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if ($lastInsertId) {
		$_SESSION['msg'] = "You are Scuccessfully registered. Now you can login ";
		header('location:../thankyou.php');
	} else {
		$_SESSION['msg'] = "Something went wrong. Please try again.";
		header('location:../thankyou.php');
	}
}
?>
<!--Javascript for check email availabilty-->
<script>
	function checkAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "../check_availability.php",
			data: 'emailid=' + $("#email").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>

<!doctype html>
<html lang="en">

<head>
	<title>Signin Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style1.css">
</head>

<body>
	<div>
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-7 col-lg-5">
						<div class="wrap">
							<div class="img" style="background-image: url(images/bg-1.jpg);"></div>
							<div class="login-wrap p-4 p-md-5">
								<div class="d-flex">
									<div class="w-100">
										<h3 class="mb-4">Register</h3>
									</div>
								</div>
								<form action="#" class="signin-form" method="post">
									<div class="form-group mt-3">
										<label>Full name</label>
										<input type="text" name="fname" id="name" pattern="[a-zA-Z'-'\s]*" oninvalid="setCustomValidity('Please enter Alphabets.')" class="form-control" required>
									</div>
									<div class="form-group mt-3">
										<label>Mobile No</label>
										<input type="number" name="mobilenumber" id="number" minlength="10" maxlength="10" class="form-control" required>
									</div>
									<div class="form-group mt-3">
										<label>Email Id</label>
										<input type="email" name="email" id="email" onBlur="checkAvailability()" class="form-control" required>
										<span id="user-availability-status" style="font-size:12px;"></span>
									</div>
									<div class="form-group mt-3">
										<label>Password</label>
										<div class="form-group">
											<input id="password-field" name="password" type="password" minlength="5" class="form-control" required>
											<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" name="submit" id="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
									</div>
								</form>
								<p class="text-center">Already a member?<br>
									<a href="login-page.php">Sign in</a>
								<p class="text-center"><a href="../index.php">Back to Home</a></p>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src="js/jquery.min.js"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.min1.js"></script>
		<script src="js/main.js"></script>
	</div>
</body>

</html>