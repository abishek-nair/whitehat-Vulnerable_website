<?php
// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
/*
	INFO : 
		Stage 4 of Round 3 of "White | Hat" 2013 competition.

	PROCEDURE : 
		-> This round contains an Input into which the user must enter the correct password to finish the Game.
		-> Upon entering aa wrong password, the user is hinted that a database is involved.
		-> The Login Backend is intentionally vulnerable to SQL Injection.
		-> The candidate is required to craft an input such that it manipulates the Backend into accepting the user's input.
		-> Example :
			Original Query String : "SELECT password FROM login WHERE username=".$string
				Where , $string is a variable with value from the password input on the page.
			Crafted Input : $string = '" OR "a" rlike "a'
			Vulnerable Query : "SELECT password FROM login WHERE username="" OR "a" rlike "a"
											 ----------------
												^
												|
											 -------------------
											|   True Statement  |
										 	 -------------------	
*/	
	session_start();
	include_once("scripts/login_backend.php");
	$stgComp = 3;
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
		<strong>Stage - 4</strong>
		<br />
	</div>	
	<div class='container'>
		<div class='instructions'>
			<br />
			<h1>Stage-4 <strong>Instructions</strong></h1>
			<hr />
			<ul>
				<li> Good job till now. Now comes the real deal </li>
				<li> All that stands between you and the white | <strong>hat</strong> title is this password prompt. </li>
				<li>  </li>
			</ul>
		</div>
		<div class='content'>
			<h2><strong>Stage 4</strong></h2>
			<hr />
			<br />
			<form action='loginBackend.php' method=''>
 				<label for='inpPass'> Password :  </label>
				<input type='password' name='inpPass' id='inpPass' autofocus/>
				<br />
				<br />
				<button type='submit'> Submit </button>
			</form>
			<?php
				if(isset($_GET['error'])) {
					echo "<br /><div class='loginErr'>";
					if($_GET['error']==1) {
						echo "Password missing";
					}
					echo "</div><br /><br />";
				}
			?>			
		</div>
	</div>
	<div class='footer'>

	</div>
</body>
</html>
