<?php
// Developed By : Abishek | Nair
// Copyright    : White | Hat tm

/*
	INFO : 
		Stage 3 of Round 3 of "White | Hat" 2013 competition
	
	PROCEDURE : 
		-> An encrypted message is provided, whose decrypted form is the password for the next round.
		-> The first Input is for encrypting a string using the same algorithm with which the password for the next round is encrypted with.
		-> The candidate is required to enter sample strings into the first input and analyze the relation between the message and the cipher.
		-> After obtaining the relation, the candidate must attempt to decrypt the Encrypted key.
		-> The decrypted message will be the password to the next round.
*/
	session_start();
	include_once("scripts/login_backend.php");
	$stgComp = 2;
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
		<div class='timer'><strong>Time left </strong>&nbsp;
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
		<strong>Stage - 3</strong>
		<br />
	</div>	
	<div class='container'>
		<div class='instructions'>
			<br />
			<h1>Stage-3 <strong>Instructions</strong></h1>
			<hr />
			<ul>
				<li> The password is encrypted in a proprietary encryption algorithm. </li>
				<li> The encryption algorithm can be accessed by the form below. </li>
				<li> The <strong>password</strong> for this round is the <strong>decrypted message</strong>. </li>
				<li> View the <a href='images/asciifull.gif'><strong>ASCII table</strong></a> here </li>
			</ul>
		</div>
		<div class='content'>
			<h2><strong>Stage 3</strong></h2>
			<hr />
			<br />
			<p>
				Enter a string to have it encrypted <br /><br />
			</p>			
			<form action='' method='POST'>
				<label for='encrInp'>String : </label>
				<input name='encrInp' id='encrInp' type='text' autofocus='true'/>
				<br />
				<br />
				<button id='btnSubmit'>Submit</button>
			</form>
			<br />
			<?php
				if(isset($_POST['encrInp']) && !empty($_POST['encrInp'])) {
					$inpStr = $_POST['encrInp'];
					$cnt=0;
					$len = strlen($inpStr) - 1;
					while($cnt <= $len) {
						$ascii[] = chr(ord($inpStr{$cnt}) + $len - $cnt);
						$cnt++;
					}
					echo "<div class='loginErr' style='border-color: #A3D6F5'>";
					echo "<strong>Encrypted string :</strong> ";
					echo join("", $ascii);
					echo "</div>";
				}
			?>			
			<br />
			<hr />
			<br />
			<p>
				Decrypt the string <strong>|v{wmvvfr</strong> and enter the message in the form below.
			</p>			
			<br />
			<br />			
			<form action='' method='POST'>
				<label for='pass'>Message : </label>
				<input name='passStr' id='passStr' type='text'/>
				<br />
				<br />
				<button id='btnSubmit2'>Submit</button>
			</form>				
			<?php
				if(isset($_POST['passStr'])) {
					$inp = $_POST['passStr'];
					$encrStr = "tourister";
					if($inp == $encrStr) {
						header("Location:n1v3l4.php");
					}
					else {
						echo "<br /><br />";
						echo "<div class='loginErr'>";
						echo "<strong> Sorry, that string is wrong. Try again </strong> ";						
						echo "</div>";
					}
				}
			?>
		</div>
	</div>
	<div class='footer'>

	</div>
</body>
</html>
