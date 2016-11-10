<?php
	session_start();

	if (!isset($_SESSION['userSession'])) {
		header("Location: login.php");
	}

$userID= $_GET['id'];
$userNumber = $_GET['no'];
$userEmail = $_GET['e'];

include("_includes/thisConnect.php");

$msg = "";

//bugged edit
if(isset($_POST["btnEdit"])) {
	$eNo = $_POST["eNo"];
	$eEmail = $_POST["eEmail"];
	$ePass = $_POST["ePass"];

	$eNo = mysqli_real_escape_string($thisDB, $eNo);
	$eEmail = mysqli_real_escape_string($thisDB, $eEmail);
	$ePass = mysqli_real_escape_string($thisDB, $ePass);
	$ePass = md5($ePass);

    $sql = "SELECT userPass FROM apptable WHERE userPass='$ePass'";
    $result = mysqli_query($thisDB, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1) {
      $msg = "<center><span class='label label-danger'>Password same as before!</span></center>";
    } else {
      $query = mysqli_query($thisDB, "UPDATE apptable SET userNo='$eNo' WHERE userEmail='$eEmail' AND userPass='$ePass' AND userID=$userID");
      if($query) {
        $msg = "<center><span class='label label-success'>Saved!</span></center>";
        header("location: news.php");
      }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd" data-herp="derp" data-yolo="swag" meme="nice">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<title>Document</title>

	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="_assets/css/general.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row main">
        <div class="main-login main-center">
          <form class="form-horizontal" method="post" action="">

          <?php
            if(isset($msg)) {
              echo $msg;
            }
          ?>

            <div class="form-group">
              <label for="name" class="cols-sm-2 control-label">Your Number</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="number" class="form-control" name="eNo" id="number" maxlength="11" value="<?php echo $userNumber ?>"  placeholder="Please type number" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Your Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="eEmail" id="email" value="<?php echo $userEmail ?>"  placeholder="Please type email" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="ePass" id="password"  placeholder="Please type password" required />
                </div>
              </div>
            </div>

            <div class="form-group ">
              <input type="submit" name="btnEdit" class="btn btn-primary btn-lg btn-block login-button" value="Save Settings">
            </div>
            <div class="form-group ">
              <a href="accounts.php" class="btn btn-warning btn-lg btn-block login-button">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>