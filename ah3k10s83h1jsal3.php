<?php
// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
/*
	INFO : 
		Stage 2 of Round 3 of White | Hat Competition 2013

	PROCEDURE :
		-> The page contains a Password field where the candidate is required to enter the password for the next round.
		-> The Password "Form" is submitted to "pass.php"
		-> Candidate is required to manually navigate to pass.php, following which a text file will be downloaded.
		-> The downloaded file contains the password for the next round. 

*/
	session_start();
	include_once("scripts/login_backend.php");
	$stgComp = 1;
	$isLoggedIn = false;
	$sessUserName = "";
	if(isset($_SESSION['user'])) {
		$isLoggedIn = true;
		$sessUserName = $_SESSION['user'];
		$whLoginObj = new whSQLLogin();
		if(isset($_SESSION['time_start'])) {
			$whLoginObj->updateLevels($stgComp, $_SESSION['user_id'], $_SESSION['time_start']);
		}
		else {
			header('Location:index.php');
		}
	}
	else {
		header("Location:login.php");
	}
?>

<!DOCTYPE html>
<html>

<head>
	<title>DECRYPTION | Ubertech</title>
	<link rel='stylesheet' type='text/css' href='styles/mainStyle.css' />
	<link rel='stylesheet' type='text/css' href='styles/reset.css' />
	<script type='text/javascript' src='scripts/jquery.js'></script>
	<script type='text/javascript' src='scripts/jquery-ui.js'></script>
	<script type='text/javascript' src='scripts/mainUi.js'></script>
	<script type='text/javascript' src='scripts/timeCountDown.js'></script>
</head>
<body>
	<div class='header'>
		<h1 class='logo'> <a href='index.php'>WHITE | <strong>HAT</strong></a> </h1>
		<div class='timer'><strong>Timer </strong>&nbsp;
			<span id='timeVal'>
				Loading &nbsp;
			</span>
		 </div>		
		<img src='images/srmlogo.png' alt='SRM University' height='45px' width='89px' >
		<ul class='navbar'>
			<li> <a href='index.php'>Home</a> </li>
			<li> <a href='signout.php'>Signout</a> </li> 
		</ul>			
	</div>
	<div class='billboard'>
		Good job on the last round
		<br />
		<strong>Stage - 2</strong>
		<br />
	</div>	
	<div class='container'>
		<div class='instructions'>
			<br />
			<h1>Stage-2 <strong>Instructions</strong></h1>
			<hr />
			<ul>
				<li> The authentication script checks your password with a file on the server </li>
				<li> Like always, find the password for the next round </li>
				<li> <strong>Warning</strong> : This stage may look easier than it is </li>
				<li> <strong>Hint :</strong> There is more to a website than what you can see. </li>
			</ul>
		</div>
		<div class='content'>
			<h2><strong>Stage 2</strong></h2>
			<hr />
			<br />
			<!--Stage 2-->
			<form action='pass.php' method='POST'>
				<label for='inpPass'> Password :  </label>
				<input type='text' name='inpPass' id='inpPass' />
				<br />
				<br />
				<button type='submit'> Submit </button>
			</form>
			<br />
			<?php
				if(isset($_GET['error'])) {
					echo "<div class='loginErr'>";
					echo "Sorry, that password won't get you to the next round";
					echo "</div><br /><br />";
				}
			?>
		</div>
	</div>
	<div class='footer'>

	</div>
</body>
</html>
