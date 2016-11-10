<?php
	session_start();

	if (!isset($_SESSION['userSession'])) {
		header("Location: login.php");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd" data-herp="derp" data-yolo="swag" meme="nice">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<title>Document</title>

	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="_assets/css/table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
	<img src="_assets/img/bg.jpg" id="bg" alt="">
	<div class="container">
		<div class="row">
			<section class="content" id="autoRefresh">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="pull-right">
								<div class="btn-group">
									<a href="news.php" type="button" class="btn btn-success btn-filter">News</a>
									<a href="accounts.php" type="button" class="btn btn-warning btn-filter">Accounts</a>
									<a href="logout.php" type="button" class="btn btn-danger btn-filter">Logout</a>
								</div>
							</div>						
							<div class="table-container">
								<table class="table table-filter">
									<tbody>
										<tr>
											<td>
											<?php
												include("_includes/thisConnect.php");

												$sql = "SELECT userID, userNo, userEmail, userPass FROM apptable";
												$result = $thisDB->query($sql);

												if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
											?>
												<div class="media">
													<div class="media-body">
														<a href="delete.php?id=<?php echo $row["userID"] ?>&no=<?php echo $row["userNo"] ?>"><span class="media-meta pull-right"><span class="label label-danger">X</span></span></a>
														<a href="edit.php?id=<?php echo $row["userID"] ?>&no=<?php echo $row["userNo"] ?>&e=<?php echo $row["userEmail"] ?>"><span class="media-meta pull-right"><span class="label label-default">Edit</span></span></a>
														<h4 class="title">
															<?php echo $row["userEmail"] ?>
														</h4>
														<p class="summary"><?php echo $row["userNo"] ?></p>
													</div>
												</div>
											<?php
													}
												} else {
													echo "0 results";
												}
												$thisDB->close();
											?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>