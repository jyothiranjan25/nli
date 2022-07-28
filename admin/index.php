<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$uname = $_POST['username'];
	$password = $_POST['password'];
	$sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
	$query = $dbh->prepare($sql);
	$query->bindParam(':uname', $uname, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		$_SESSION['alogin'] = $_POST['username'];
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	} else {

		echo "<script>alert('Invalid Details');</script>";
	}
}

?>

<!DOCTYPE HTML>
<html>

<head>
	<title>No Limits India | Admin Sign in</title>

	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />


</head>

<body>
	<br><br><br>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center text-bold">ADMIN LOGIN</h1>
				<div class="well row pt-2x pb-3x bk-light">
					<div class="col-md-8 col-md-offset-2">
						<form method="post">

							<label>Username </label>
							<input type="text" placeholder="Username" name="username" class="form-control"><br>

							<label>Password</label>
							<input type="password" placeholder="Password" name="password" onmouseover="this.type='text'" onmouseout="this.type='password'" class="form-control"><br>



							<button class="btn btn-primary btn-block" name="login" style="background-color:#FF6347" type="submit">LOGIN</button><br>
							<a href="../index.php" class="btn btn-primary">Home</a>




						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>