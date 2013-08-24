<?php
	session_start();
	$isLoggedIn = false;
	if(isset($_SESSION['user'])) {
		header("Location:index.php");
	}
	if(isset($_POST['inpUserName'], $_POST['inpPassword'])) {
		include('scripts/login_backend.php');
		$whLoginObj = new whSQLLogin();
		$whLoginObj->setLoginParam($_POST['inpUserName'], $_POST['inpPassword']);
		$return = $whLoginObj->checkUserDB();
		if(isset($return['ERROR'])) {
			echo "ERROR => ".$return['ERROR'];
			die("");
		}
		elseif(isset($return['STATUS'])) {
			if($return['STATUS'] == 'LOGINSUCCESS') {
				$_SESSION['user'] = $whLoginObj->whUsername;
				$_SESSION['user_id'] = $whLoginObj->whUserID;
				$_SESSION['levels_complete'] = $whLoginObj->levelsComplete;
				header("Location:index.php");
			}
			elseif($return['STATUS'] == 'LOGINFAIL') {
				header("Location:login.php?errorno=1");
			}
			elseif($return['STATUS'] == 'NOUSERNAME') {
				header("Location:login.php?errorno=2");
			}
		}
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
		<img src='images/srmlogo.png' alt='SRM University' height='45px' width='89px' >
		<ul class='navbar'>
			<li> <a href='index.php'>Home</a> </li>
			<?php if($isLoggedIn) {?>
			<li> <a href='signout.php'>Signout</a> </li> 
			<?php } ?>
		</ul>						
	</div>
	<div class='billboard'>
		Congratulations on reaching the <strong>Final round.</strong>
		<br />
	</div>
	<div class='container'>
		<div class='instructions'>
			<br />
			<h1>You need to <strong>Sign-in</strong> before <strong>hacking</strong></h1>
			<hr />
			<br />
			<ul>
				<li> <strong>Username</strong> => Your first name (Lowercase)</li>
				<li> <strong>Password</strong> => The answer from <strong>Round 2</strong> </li>
				<li> <strong>The timer for the final round will start once you log-in </strong></li>
				<li> All the best </li>
			</ul>
		</div>
		<div class='content'>
			<h2><strong>Sign in</strong></h2>
			<hr />
			<br />
			<!-- Login -->
			<?php
				if(isset($_GET['errorno'])) {
					echo "<div class='loginErr'>";
					if($_GET['errorno']==1) {
						echo "The password is incorrect";
					}
					else {
						echo "The username doesn't exist";
					}
					echo "</div><br /><br />";
				}
			?>
			<form action='' method='POST'>
				<label for='inpUserName'>Username : </label>
				<input type='text' id='inpUserName' name='inpUserName' autofocus='true'/>
				<br />
				<br />
				<label for='inpPassword'>Password : </label>
				<input type='password' name='inpPassword' id='inpPassword'/>
				<br />
				<br />
				<button type='submit' name='btnSubmit' id='btnSubmit'>Sign in</button>
			</form>
		</div>
	</div>
	<div class='footer'>

	</div>
</body>

</html>