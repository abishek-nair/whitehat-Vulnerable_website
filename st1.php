<?php
// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
/*
	INFO : 
		Stage 1 of Round 3 of "White | Hat".

	PROCEDURE :
		-> This page contains an Input where contestant is required to enter the password for the next round.
		-> The user is taken to the filenam whichever he/she enters in the input.
		-> Example: 
               		    ------------------
		Password : | exampleString    | ------> www.crackme.com/exampleString.php
			    ------------------                          -----------------  
				
		-> The password is hidden inside a Custom 404 Error page.
		-> The password is the filename for the next Stage.
		 
*/
	session_start();
	$isLoggedIn = false;
	$sessUserName = "";
	if(isset($_SESSION['user'])) {
		$isLoggedIn = true;
		$sessUserName = $_SESSION['user'];
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
		<?php
			if($isLoggedIn) {
				?>
				Welcome, <strong>
						<?php
							echo $sessUserName;
						?>
						</strong>
				<?php
			}
		?>
		<br />
		Congratulations on reaching the <strong>Final round.</strong>
		<br />
	</div>	
	<div class='container'>
		<div class='instructions'>
			<br />
			<h1>Stage-1 <strong>Instructions</strong></h1>
			<hr />
			<br />
			<ul>
				<li> The objective is simple. Find the password, and proceed to the next round </li>
				<li> The password can be anywhere. So , be on the lookout. </li>
			</ul>
		</div>
		<div class='content'>
			<h2><strong>Stage 1</strong></h2>
			<hr />
			<br />
			<!--Stage 1-->
			<p>
				Enter the correct password in the field below. <br /><br />
			</p>
			<form name='form1' id='form1' method='POST' action=''>
				<label for='pass'>Password : </label>
				<input name='pass' id='pass' type='text' autofocus/>
				<br />
				<br />
				<button name='btnSubmit' id='btnSubmit'>Submit</button>
			</form>
		</div>
	</div>
	<div class='footer'>

	</div>
</body>

</html>
