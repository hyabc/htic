<?php
if (!$_GET || !isset($_GET["uid"]) || empty($_GET["uid"])) {
	die("需要指定查看的用户ID");
}
$uid = $_GET["uid"];
require_once "db.php";
require_once "subject.php";
$result = $con->query("SELECT display, name, des,subject_mask,grade_mask FROM ".$DB_TABLE." WHERE uid=".$uid);
if($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$display = $row["display"];
	if ($display === "false") {
		die("该用户暂时没有发布");
	}
	$name = $row["name"];
	$des = nl2br(addslashes(htmlspecialchars($row["des"])));
	$subject_mask=$row["subject_mask"];
	$grade_mask=$row["grade_mask"];
} else {
	die("不存在该用户");
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
    <h2><?php echo $name;?></h2>
    <p class='text-muted'>UID: <?php echo $uid?></p>
    <?php
    	  echo '<p class="text-muted">学科: ';
	  for ($iter = 0;$iter < $subject_count;$iter++) {
  		if ((int)($subject_mask) & (1 << $iter)) {
			echo $subject[$iter];
			echo "&nbsp;";
		}
	  }
    	  echo '<br>接受学生年级: ';
	  for ($iter = 0;$iter < $grade_count;$iter++) {
  		if ((int)($grade_mask) & (1 << $iter)) {
			echo $grade[$iter];
			echo "&nbsp;";
		}
	  }
	  echo "</p>";
    ?>

    <p><?php echo $des;?></p>
  </div>


<?php require 'footer.php';?>


</body>

</html>

