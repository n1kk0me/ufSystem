<?php
	session_start();

	include('_includes/thisConnect.php');

	if (!isset($_SESSION['userSession'])) {
		header("Location: login.php");
	}

	$query = $thisDB->query("SELECT * FROM apptable WHERE userID=".$_SESSION['userSession']);
	$userRow=$query->fetch_array();
	$thisDB->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd" data-herp="derp" data-yolo="swag" meme="nice">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<title>Document</title>

	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="_assets/css/table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <script type="text/javascript" src="_assets/js/autoRefresh.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
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
									<a href="logout.php?logout" type="button" class="btn btn-danger btn-filter">Logout</a>
								</div>
							</div>
							<?php
								error_reporting(0);

								$xmlTarget=("http://www.gmanetwork.com/news/rss/scitech/weather");

								$thisXMLDoc = new DOMDocument();
								$thisXMLDoc->load($xmlTarget);

								$x=$thisXMLDoc->getElementsByTagName('item');
								for ($i = 0; $i <= 15; $i++) {
									$thisItemTitle = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
									$thisItemDescription = $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
									$thisItemDate = $x->item($i)->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue;

									$thisItemDate = str_replace("+0800", "", $thisItemDate);

									if (strpos($thisItemTitle, 'Visayas') !== false) {
								?>									
							<div class="table-container">
								<table class="table table-filter">
									<tbody>
										<tr>
											<td>
												<div class="media">
													<div class="media-body">
														<span class="media-meta pull-right"><span class="label label-default"><?php echo $thisItemDate ?></span></span>
														<h4 class="title">
															<?php echo $thisItemTitle ?>
														</h4>
														<p class="summary"><?php echo $thisItemDescription ?></p>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>