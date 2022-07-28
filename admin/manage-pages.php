<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if ($_POST['submit'] == "Update") {

		$pagedetails = $_POST['pgedetails'];
		$sql = "UPDATE tblpages SET detail=:pagedetails WHERE id=1";
		$query = $dbh->prepare($sql);

		$query->bindParam(':pagedetails', $pagedetails, PDO::PARAM_STR);
		$query->execute();
		$msg = "Page data updated  successfully";
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>No Limits India | Admin Package Creation</title>



		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />





	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="mother-grid-inner">
					<!--header start here-->
					<?php include('includes/header.php'); ?>

					<div class="clearfix"> </div>
				</div>
				<!--heder end here-->

				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Update About Page</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">
								<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
									<div class="form-group">






										<div class="form-group">
											<label for="focusedinput" class="col-sm-2 control-label">Page Details</label>
											<div class="col-sm-8">

												<?php
												$pagetype = $_GET['type'];
												$sql = "SELECT detail from tblpages where id=1";
												$query = $dbh->prepare($sql);
												$query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {

												?>
														<textarea class="form-control" rows="10" cols="50" name="pgedetails" placeholder="Page Details" required><?php echo $result->detail; ?></textarea>
												<?php }
												} ?>
											</div>
										</div>


										<div class="row">
											<div class="col-sm-8 col-sm-offset-2">
												<button type="submit" name="submit" value="Update" id="submit" class="btn-primary btn">Update</button>


											</div>
										</div>





									</div>

								</form>

								<?php include('includes/sidebarmenu.php'); ?>



	</body>

	</html>
<?php } ?>