<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	header("location: profile.php");
	exit;
}
require_once "db.php";
$uid = $pwd = $err = "";
if ($_POST) {
	if(empty(trim($_POST["uid"]))){
		$err = "UID为空";
	} else{
		$uid = trim($_POST["uid"]);
	}
	if(empty(trim($_POST["pwd"]))){
		$err = "密码为空";
	} else{
		$pwd = trim($_POST["pwd"]);
	}
	if (empty($err)) {
#		$result = $con->query("SELECT pwd FROM ".$DB_TABLE." WHERE uid=".$uid);
		$stmt = $dbConnection->prepare("SELECT pwd FROM ".$DB_TABLE." WHERE uid= ?");
		$stmt->bind_param('s', $uid);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$resultpwd = $row["pwd"];
			if (password_verify($pwd, $resultpwd)) {
				session_start();
				$_SESSION["loggedin"] = true;
				$_SESSION["uid"] = $uid;
				header("location: profile.php");
				exit;
			} else 
				$err = "错误的用户名或密码";
		} else
			$err = "错误的用户名或密码";
	}
	mysqli_close($con);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>高中生家教互联网目录 - HTIC</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">


</head>
<body>

<?php require 'nav.php';?>



  <div class="container p-2">
    <div class="row justify-content-md-center">
    <form class="col-md-6" method="post" action="/login.php">
      <h2>登录</h2>
      <?php if (isset($err) && !empty($err)) echo '<div class="alert alert-warning" role="alert">发生错误: '.$err.'</div>';?>
      <div class="form-group">
        <p>UID</p>
        <input type="value" class="form-control" id="uid" name="uid" placeholder="输入你的用户ID">
      </div>
      <div class="form-group">
        <p> 密码</p>
        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="输入你的密码">
      </div>
    <!--  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>-->
      <br>
      <button type="submit" value="submit" class="btn btn-primary">&nbsp;提交&nbsp;</button>
    </form>
    </div>
  </div>


<?php require 'footer.php';?>


</body>

</html>

