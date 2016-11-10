<?php
	session_start();

	if (!isset($_SESSION['userSession'])) {
		header("Location: login.php");
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		include('_includes/thisConnect.php');

		//bugged delete..
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$no = $_GET['no'];
			$query = mysql_query("DELETE FROM `apptable` WHERE userID = $id AND userNo = $no");

			if($query) {
				header('location: accounts.php');
			}
		}
	?>
</body>
</html>