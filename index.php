<?php
// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
/*
        INFO :
                Index page for the "White | Hat" website.
                Contains instructions for the competition.
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
</head>
<body>
	<div class='header'>
		<h1 class='logo'> <a href='index.php'>WHITE | <strong>HAT</strong></a> </h1>
		<div class='timer'><strong>Timer </strong>&nbsp;
			<span id='timeVal'>
				M : SS &nbsp;
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
		</div>
		<div class='content'>
			<h2> Hi <strong><?php echo $sessUserName ?> </strong>, </h2>
			<hr />
			<br />
			<p>
				Congratulations on reaching the final round.
			</p>
			<br />
			<p>
				This round will consist of <strong>5 stages</strong>
			</p>
			<br />
			<p>
				Your task is simple.<br />
				Each level is going to require you to enter a password which will be hidden in and around the website in all forms of crazy ways.
			</p>
			<br />
			<p>
				This is a race , the time is running. <br />
				The team which finishes the most rounds the fastest will be titled the <br /><strong>True</strong> White | <strong>Hat</strong>
			</p>
			<br />
			<p>
				<ul>
					<li> Be quick </li>
					<li> Be alert </li>
					<li> Think out of the box </li>
				</ul>
			</p>
			<br />
			<p>
				<strong>Important :</strong> Be careful not to <strong>Navigate back</strong> or <strong>Refresh</strong> the page when<br />
				the contest is going on because the <strong>timer</strong> will still keep running.
			</p>
			<br />
			<br />
			<button onclick='document.location.href="st1.php";'>Start</button>
		</div>
	</div>
	<div class='footer'> 
	</div>
</body>

</html>
