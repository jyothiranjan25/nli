<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (isset($_POST['submit50'])) {
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$newpassword = md5($_POST['newpassword']);
	$sql = "SELECT EmailId FROM tblusers WHERE EmailId=:email and MobileNumber=:mobile";
	$query = $dbh->prepare($sql);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		$con = "update tblusers set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
		$chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		$msg = "Your Password succesfully changed";
	} else {
		$error = "Email id or Mobile no is invalid";
	}
}

?>
<!doctype html>
<html lang="en">

<head>
	<title>Recovery password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link rel="stylesheet" href="css/style1.css">

	<script>
		new WOW().init();
	</script>
	<script type="text/javascript">
		function valid() {
			if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
				alert("New Password and Confirm Password Field do not match  !!");
				document.chngpwd.confirmpassword.focus();
				return false;
			}
			return true;
		}
	</script>

</head>

<body>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(images/bg-1.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Recovery password</h3>
								</div>
							</div>
							<form action="#" class="signin-form" method="post">
								<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
								<div class="form-group mt-3">
									<input type="email" name="email" id="email" class="form-control" required>
									<label class="form-control-placeholder" for="username">Email id</label>
								</div>
								<div class="form-group mt-3">
									<input type="text" name="mobile" id="mobile" class="form-control" required>
									<label class="form-control-placeholder" for="username">Mobile no</label>
								</div>
								<div class="form-group">
									<input id="password-field" name="newpassword" type="password" value="" class="form-control" required>
									<label class="form-control-placeholder" for="password">New Password</label>
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<div class="form-group">
									<input id="password-field" name="confirmpassword" type="password" value="" class="form-control" required>
									<label class="form-control-placeholder" for="password">Confirm Password</label>
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<div class="form-group">
									<button type="submit" name="submit50" class="form-control btn btn-primary rounded submit px-3">Change</button>
								</div>
							</form>
							<p class="text-center"><a href="../index.php">Back to Home</a></p>
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

</body>

</html>