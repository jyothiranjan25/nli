<?php
session_start();
include('includes/config.php');

// error_reporting(0);
$booking_id = intval($_GET['booking_id']);

if (isset($_POST['submit'])) {
	$user_email = $_SESSION['login'];
	$card_number = $_POST['card_number'];
	$transaction_id = $_POST['transaction_id'];
	$amount = $_POST['amount'];
	$sql = "INSERT INTO payments(booking_id,user_email,card_number,transaction_id,amount) VALUES(:booking_id,:user_email,:card_number,:transaction_id,:amount)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':booking_id', $booking_id, PDO::PARAM_STR);
	$query->bindParam(':user_email', $user_email, PDO::PARAM_STR);
	$query->bindParam(':card_number', $card_number, PDO::PARAM_STR);
	$query->bindParam(':transaction_id', $transaction_id, PDO::PARAM_STR);
	$query->bindParam(':amount', $amount, PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if ($lastInsertId) {
		$msg = "Payment successful.";
		echo "<script> alert('$msg') </script>";
		echo "<script type='text/javascript'>document.location = 'tour-history.php'; </script>";
	} else {
		$error = "Something went wrong. Please try again";
	}
}

$sql = "SELECT tb.*, tp.PackageName,tp.PackageDetails from tblbooking tb LEFT JOIN tbltourpackages tp ON tb.PackageId=tp.PackageId where BookingId=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $booking_id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0) {
	foreach ($results as $result) {
		$amount =	$result->amount;
		$package =	$result->PackageName;
		$dates =	Date("jS-M-Y", strtotime($result->FromDate)) . " - " . Date("jS-M-Y", strtotime($result->ToDate));
	}
}
?>

<!doctype html>
<html lang="en">

<head>
	<title>Payment Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-4">
				<div class="card p-3">
					<p class="mb-0 fw-bold h4">Payment Gateway</p>
				</div>
			</div>


			<div class="col-12">
				<div class="card p-3">
					<div class="card-body border p-0">
						<p>
							<a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
								<span class="fw-bold">Credit Card / Debit card</span>
								<span class="">

								</span>
							</a>
						</p>
						<div class="collapse show p-3 pt-0" id="collapseExample">
							<div class="row">
								<div class="col-lg-5 mb-lg-0 mb-3"><br>
									<p class="h4 mb-0">Summary</p><br>


									<p class="mb-0">
										<span class="fw-bold">Price:</span>
										<span class="c-green"><?= $amount ?></span>
									</p>
									<br>
									<p class="mb-0">
										<span class="fw-bold">Selected Dates:</span>
										<span class="c-green"><?= $dates ?></span>
									</p>
									<br>
									<p class="mb-0"><span class="fw-bold">Tour Package:</span><span class="c-green"> <?= $package ?></span>
									</p>
									<br>
									<p class="mb-0"><?php echo htmlentities($result->PackageDetails); ?></p>
									<br>
								</div>
								<div class="col-lg-7">
									<form action="" name="form" class="form" method="POST"><br>
										<div class="row">
											<div class="col-12">
												<div class="form__div">
													<input type="text" maxlength="16" pattern="^[0-9]{16}$" title="16 digits" class="form-control" id="cardNumber" name="card_number" required>
													<label for="" class="form__label">Card Number</label>
												</div>
											</div>

											<div class="col-6">
												<div class="form__div">

													<input type="text" name="month" class="form-control" pattern="^((0[1-9])|(1[0-2]))\/(\d{2})$" required>

													<label for="" class="form__label">mm / yy</label>
												</div>
											</div>
											<input type="hidden" name="transaction_id" title="MM / YY" class="form-control" value="<?= rand(10, 100) ?>1234<?= rand(10, 100) ?>" required>
											<input type="hidden" name="amount" value="<?= $amount ?>" required>

											<div class="col-6">
												<div class="form__div">
													<input type="text" minlength="3" maxlength="3" class="form-control" pattern="^[0-9]{3}$" name="cvv" title="3 digits" id="cvv" required>
													<label for="" class="form__label">cvv code</label>
												</div>
											</div>
											<div class="col-12">
												<div class="form__div">
													<input type="text" class="form-control" pattern="[a-zA-Z'-'\s]*" oninvalid="setCustomValidity('Please enter Alphabets.')" placeholder="" required>
													<label for="" class="form__label">name on the card</label>
												</div>
											</div>

										</div>
										<div class="col-12">
											<button type="submit" name="submit" class="btn btn-primary payment">
												Make Payment
											</button>
										</div>
									</form>
									<a href="tour-history.php">Cancel Payment </a>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/bootstrap.min1.js"></script>
	<script src="js/main.js"></script>

</body>

</html>