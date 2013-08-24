<?php

	if(isset($_POST['inpPass'])) {
		if($_POST['inpPass'] === "PASSWORD") {
			header("Location: 13v31thr33.php");
		}
		else {
			header("Location: ah3k10s83h1jsal3.php?error=1");
		}
	}
	else {
		header('Content-type: application/txt');
		header('Content-Disposition: attachment; filename="pass.txt"');
		readfile('admin/pass.txt');
	}
?>