<?php
	session_start();
	if(isset($_SESSION['admin_user'])) {
		unset($_SESSION['admin_user']);
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
			<li> <a href='login.php'>Signin</a> </li>
		</ul>						
	</div>
	<div class='billboard'>
		<strong>Sign out</strong>
		<br />
	</div>	
	<div class='container'>
		<div class='instructions'>
			<br />
		</div>
		<div class='content'>
			<?php
				if(isset($_SESSION['user'])) {
					$_SESSION = array();
					if (ini_get("session.use_cookies")) {
					    $params = session_get_cookie_params();
					    setcookie(session_name(), '', time() - 42000,
					        $params["path"], $params["domain"],
					        $params["secure"], $params["httponly"]
					    );
					}
					session_destroy();
					?>
					You are now <strong>logged out</strong> of White | <strong>Hat</strong>.
					<?php
				}
				else {
					?>
					You are already logged out. Please log in to start <strong>Hacking</strong>.
					<?php
				}
			?>
		</div>
	</div>
	<div class='footer'>

	</div>
</body>

</html>