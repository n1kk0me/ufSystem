<?php
	session_start();

	include('_includes/thisConnect.php');

	if (!isset($_SESSION['userSession'])) {
		header("Location: login.php");
	} else {
		header("Location: news.php");
	}

	$query = $thisDB->query("SELECT * FROM apptable WHERE userID=".$_SESSION['userSession']);
	$userRow = $query->fetch_array();
	$thisDB->close();
?>