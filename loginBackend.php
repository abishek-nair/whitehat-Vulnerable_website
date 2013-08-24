<?php
// Developed By : Abishek | Nair
// Copyright    : White | Hat tm

	session_start();
	if(!isset($_GET['inpPass']) or empty($_GET['inpPass'])) {
		header('Location:n1v3l4.php?error=1');
	}
	else {
		$dbUserName = 'Enter DB username';
		$dbPassword = 'Enter DB password';
		$dbName = 'Enter DB name';
		$dbHost = 'Enter DB Hostname';

		mysql_connect($dbHost, $dbUserName, $dbPassword) or die(mysql_error());
		mysql_select_db($dbName) or die(mysql_error());
		$query = 'SELECT password FROM loginTable WHERE password="'.$_GET['inpPass'].'"LIMIT 1';
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_array($result);
		print_r($row);
		if(!isset($_SESSION['lvl4_retry'])) {
			$_SESSION['lvl4_retry'] = 0;
		}
		else {
			$_SESSION['lvl4_retry'] ++;
		}
		if(!empty($row)) {
			header("Location:73rm1ne.php");
		}
		else {
			echo "Oops , that password doesn't validate against our database.<br />";
			echo "Please try again";
			if($_SESSION['lvl4_retry'] > 5) {
				echo "<br /><small style='color: #F0F0F0;'>I see you're really trying to get past this level. I admire your perseverance. Hence, i'll give you this hint. <br />";
				echo "Use SQL Injection on the password field.</small> <br />";
			}
		}
 	}

?>
