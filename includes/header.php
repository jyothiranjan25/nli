<div style="background-color:#D3D3D3;padding:19px;">
	<center>

		<?php if ($_SESSION['login']) { ?>
			<span style="float:left">
				<a href="profile.php">My Profile</a>
				<a href="change-password.php">Change Password</a>
				<a href="tour-history.php">My Tour History</a>

				<a href="Wallet.php">Wallet</a>
			</span>


			<span style="color:white;float:right"> Welcome : <?php echo htmlentities($_SESSION['login']); ?>
				<a href="logout.php">Logout</a> </span><?php } else { ?>

	</center> <a href="admin/index.php">Admin Login</a>
	<center>
		</ul>

		<a href="signup.php">Sign Up</a>
		<a href="signin.php">Sign In</a>



	<?php } ?>

	<br> <br>

	<h1 style="color: black;">--- No Limits India ---</h1>

	<br>



	<a href="index.php">Home</a>
	<a href="page.php">About</a>
	<a href="package-list.php">Tour Packages</a>

	<?php if ($_SESSION['login']) { ?>

	<?php } else { ?>
		<a href="enquiry.php"> Enquiry </a>
	<?php } ?>




	</center>
</div>