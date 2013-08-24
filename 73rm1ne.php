<?php
// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
/*
	END of the Competition
*/
	session_start();
	include_once("scripts/login_backend.php");
	$stgComp = 5;
	$isLoggedIn = false;
	$sessUserName = "";
	if(isset($_SESSION['user'])) {
		$isLoggedIn = true;
		$sessUserName = $_SESSION['user'];
		$whLoginObj = new whSQLLogin();
		$whLoginObj->updateLevels($stgComp, $_SESSION['user_id'], $_SESSION['time_start']);
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
		Congratulations on completing the
		<br />
		<strong>Final Round</strong>
		<br />
	</div>	
	<div class='container'>
		<div class='instructions'>
			<br />
		</div>
		<div class='content'>
			<h1><strong>Awesomeee</strong></h1>
			<br />
			<!--Stage 3-->
		</div>
	</div>
	<div class='footer'>

	</div>
</body>
</html>
