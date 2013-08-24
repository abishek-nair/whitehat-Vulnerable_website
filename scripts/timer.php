// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
<?php
	session_start();

	if(!isset($_SESSION['time_start'])) {
		$_SESSION['time_start'] = time();
	}
	echo json_encode(array("SECOND" => time() - $_SESSION['time_start']));
?>
