<?php

  session_start();

  if (isset($_SESSION['userSession'])!="") {
    header("Location: news.php");
  }

  //include database info
  include("_includes/thisConnect.php"); 

  $msg = "";

  if(isset($_POST["btnReg"])) {
    $regNo = $_POST["regNo"];
    $regEmail = $_POST["regEmail"];
    $regPass = $_POST["regPass"];

    $regNo = mysqli_real_escape_string($thisDB, $regNo);
    $regEmail = mysqli_real_escape_string($thisDB, $regEmail);
    $regPass = mysqli_real_escape_string($thisDB, $regPass);
    $regPass = md5($regPass);

    $sql = "SELECT userEmail FROM apptable WHERE userEmail='$regEmail'";
    $result = mysqli_query($thisDB,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1) {
      $msg = "<center><span class='label label-danger'>Email already exists!</span></center>";
    } else {
      $query = mysqli_query($thisDB, "INSERT INTO apptable (userNo, userEmail, userPass) VALUES ('$regNo', '$regEmail', '$regPass')");
      if($query) {
        $msg = "<center><span class='label label-success'>Registered!</span></center>";
        header("location: news.php");
      }
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd" data-herp="derp" data-yolo="swag" meme="nice">
<html lang="en">
    <head> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

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
                  <input type="number" class="form-control" name="regNo" id="number" maxlength="11"  placeholder="Please type number" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Your Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="regEmail" id="email"  placeholder="Please type email" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="regPass" id="password"  placeholder="Please type password" required />
                </div>
              </div>
            </div>

            <div class="form-group ">
              <input type="submit" name="btnReg" class="btn btn-primary btn-lg btn-block login-button" value="Register">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="_assets/js/bootstrap.js"></script>
  </body>
</html>