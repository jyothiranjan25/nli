<?php
error_reporting(0);

include("includes/dbconnection.php");

if (isset($_POST['login'])) {
	$email = $_POST['username'];
	$pass = $_POST['password'];
	$login_query = mysqli_query($con, "SELECT * from tblusers WHERE EmailId='$email' AND Password='$pass'");
	$count = mysqli_num_rows($login_query);
	if ($count > 0) {
		session_start();

		$_SESSION['login'] = $_POST['username'];

		echo "<script>alert('You have successfully logged in');
			window.location.href='package-list.php';</script>";
	} else {
		echo "<script>alert('Enter Correct Email/Password');
		window.location.href='signin.php';</script>";
	}
}


?>


<!doctype html>

<head>
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
				<h1 class="text-center text-bold">USER LOGIN</h1>
				<div class="well row pt-2x pb-3x bk-light">
					<div class="col-md-8 col-md-offset-2">
						<form method="post">

							<label>Username </label>
							<input type="text" placeholder="Username" name="username" class="form-control"><br>

							<label>Password</label>
							<input type="password" placeholder="Password" name="password" onmouseover="this.type='text'" onmouseout="this.type='password'" class="form-control"><br>



							<button class="btn btn-primary btn-block" name="login" style="background-color:#FF6347" type="submit">LOGIN</button><br>
							<a href="index.php" class="btn btn-default">Home</a>




						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>