<?php
require_once "db.php";
require_once "subject.php";
$query = "SELECT uid,display, name, des, subject_mask,grade_mask FROM ".$DB_TABLE." WHERE true ";
if ($_GET && isset($_GET["subject_mask"])) {
	$query = $query." AND (subject_mask & ".$_GET["subject_mask"]." ) != 0 ";
}
if ($_GET && isset($_GET["grade_mask"])) {
	$query = $query." AND (grade_mask & ".$_GET["grade_mask"]." ) != 0 ";
}
$result = $con->query($query);
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
    <h2>教师列表</h2>

    <div class="row">

    <?php 
      if($result->num_rows === 0) {
        echo "<h3>错误: 找不到任何符合条件的教师。</h3>";
      } else {
        while ($row = $result->fetch_assoc()) {
          $display = $row["display"];
          if ($display === "false") {
  	    continue;
          }
          $name = $row["name"];
          $des = $row["des"];
          $uid = $row["uid"];
          $subject_mask = $row["subject_mask"];
          $grade_mask = $row["grade_mask"];
//	  echo '<a class="col-sm-6 col-md-4 col-xl-3 ml-2 mr-2 mb-4 p-2 border text-dark " style="text-decoration: none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" href="/detail.php?uid='.$uid.'">';
	  echo '<a class="col-sm-6 col-md-4 col-xl-3 text-dark mb-3" style="text-decoration: none;" href="/detail.php?uid='.$uid.'">';
//	  echo '<div class="border p-2" style="text-decoration: none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
	  $desres = $des;
	  if (mb_strlen($des, "UTF8") > 80) {
  		$des = mb_substr($des, 0, 80, "UTF8");
		$desres = nl2br(addslashes(htmlspecialchars($des))).'... <br><small class="text-primary">查看更多</small>';
	  } else {
	  	$desres = nl2br(addslashes(htmlspecialchars($des)));
          }
	  echo "<h5>".$name."</h5>";
	  echo '<p><span class="text-muted">';
	  for ($iter = 0;$iter < $subject_count;$iter++) {
  		if ((int)($subject_mask) & (1 << $iter)) {
			echo $subject[$iter];
			echo "&nbsp;";
		}
	  }
	  echo "<br>";
	  for ($iter = 0;$iter < $grade_count;$iter++) {
  		if ((int)($grade_mask) & (1 << $iter)) {
			echo $grade[$iter];
			echo "&nbsp;";
		}
	  }
	  echo "</span><br>".$desres."</p></a>";
        }
      }
      mysqli_close($con);
    ?>

    </div>

  </div>


<?php require 'footer.php';?>


</body>

</html>

