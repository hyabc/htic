<?php 
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}
$uid = $_SESSION["uid"];

require_once "db.php";
if ($_POST) {
	if (isset($_POST["pwd"]) && !empty(trim($_POST["pwd"]))) {
		$hash = password_hash(trim($_POST["pwd"]), PASSWORD_DEFAULT);
		$con->query("UPDATE ".$DB_TABLE." SET pwd='".$hash."' WHERE uid=".$uid);
	}
	if (isset($_POST["name"]) && !empty(trim($_POST["name"]))) {
		$con->query("UPDATE ".$DB_TABLE." SET name='".trim($_POST["name"])."' WHERE uid=".$uid);
	}
	if (isset($_POST["des"]) && !empty($_POST["des"])) {
		$con->query("UPDATE ".$DB_TABLE." SET des='".$_POST["des"]."' WHERE uid=".$uid);
	}
	if (isset($_POST["display"]) && !empty(trim($_POST["display"]))) {
		$con->query("UPDATE ".$DB_TABLE." SET display='".trim($_POST["display"])."' WHERE uid=".$uid);
	}
	if (isset($_POST["subject_mask"]) && !empty($_POST["subject_mask"])) {
		$con->query("UPDATE ".$DB_TABLE." SET subject_mask='".$_POST["subject_mask"]."' WHERE uid=".$uid);
	}
	if (isset($_POST["grade_mask"]) && !empty($_POST["grade_mask"])) {
		$con->query("UPDATE ".$DB_TABLE." SET grade_mask='".$_POST["grade_mask"]."' WHERE uid=".$uid);
	}
	$info = "修改成功!";
}
mysqli_close($con);
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
  <h2> 显示信息</h2>
  <p> 当前用户ID: <?php echo $uid;?> 
  <a class="btn btn-sm btn-outline-primary ml-4" href="/logout.php">&nbsp;退出&nbsp;</a>
  <a class="btn btn-sm btn-outline-primary ml-4" href="/detail.php?uid=<?php echo $uid;?>">&nbsp;查看个人页面&nbsp;</a>
  </p>
  <?php if (isset($err) && !empty($err)) echo '<div class="alert alert-warning" role="alert">发生错误: '.$err.'</div>';?>
  <?php if (isset($info) && !empty($info)) echo '<div class="alert alert-success" role="alert">'.$info.'</div>';?>
</div>

<div class="container p-2 border-top row justify-content-md-center">
  <form method="post" action="/profile.php" class="col-md-9">
    <h3> 修改信息 </h3>
    <p>留空则不做修改</p>
    <div class="form-group">
      <p>修改密码</p>
      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="输入新的密码">
    </div>
    <div class="form-group">
      <p>修改名字</p>
      <input type="text" class="form-control" id="name" name="name" placeholder="输入新的名字">
    </div>
<!--    <div class="form-group">
      <p>修改班级</p>
      <input type="text" class="form-control" id="class" name="class" placeholder="输入新的班级">
    </div>-->
    <div class="form-group">
      <p>修改简介</p>
      <textarea type="text" class="form-control" id="des" name="des" placeholder="输入新的教师简介"></textarea>
    </div>
    <div class="form-group">
      <p>修改学科代码</p>
      <input type="text" class="form-control" id="subject_mask" name="subject_mask" placeholder="输入新的学科代码">
    </div>
    <div class="form-group">
      <p>修改年级代码</p>
      <input type="text" class="form-control" id="grade_mask" name="grade_mask" placeholder="输入新的年级代码">
    </div>
    <div class="form-group">
      <p>不在网站中显示</p>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="display" id="display" value="true"> 允许显示
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="display" id="display" value="false"> 禁止显示
      </div>
    </div>
    <button type="submit" value="submit" class="btn btn-primary">&nbsp;提交&nbsp;</button>
  </form>
</div>




<?php require 'footer.php';?>


</body>

</html>

