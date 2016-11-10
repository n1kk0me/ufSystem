<?php
  
  session_start();

  include("_includes/thisConnect.php");

  if (isset($_SESSION['userSession'])!="") {
    header("Location: news.php");
    exit;
  }

  $error = "";

  if(isset($_POST["btnLogin"])) {
    if(empty($_POST["inputEmail"]) || empty($_POST["inputPass"])) {
      $error = "<center><span class='label label-danger'>Fields input required!</span></center>";
    } else {
      $inputEmail = $_POST['inputEmail'];
      $inputPass = $_POST['inputPass'];

      $inputEmail = stripslashes($inputEmail);
      $inputPass = stripslashes($inputPass);
      $inputEmail = mysqli_real_escape_string($thisDB, $inputEmail);
      $inputPass = mysqli_real_escape_string($thisDB, $inputPass);
      $inputPass = md5($inputPass);

      $query = $thisDB->query("SELECT userID FROM apptable WHERE userEmail='$inputEmail' AND userPass='$inputPass'");
      
      $row = $query->fetch_assoc();
      
      $count = $query->num_rows;
      
      if (password_verify($inputPass, $row['userPass']) && $count == 1) {
        $msg = "<center><span class='label label-danger'>Existing email!</span></center>";
      } else {
        $_SESSION['userSession'] = $row['userID'];
        header("Location: news.php");
      }
      $thisDB->close();
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd" data-herp="derp" data-yolo="swag" meme="nice">
<html lang="en">
    <head> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

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
            if(isset($error)) {
              echo $error;
            }
          ?>

            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Your Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="inputEmail" id="email"  placeholder="Please type email" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="inputPass" id="password"  placeholder="Please type password" required />
                </div>
              </div>
            </div>

            <div class="form-group ">
              <input type="submit" name="btnLogin" class="btn btn-primary btn-lg btn-block login-button" value="Login">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>