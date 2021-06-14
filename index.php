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
    <h2>上海高中生家教目录</h2>
    <h4>这里有关于上海的高中毕业生的家教信息</h4>
    <p>(主要是上海中学的学生)</p>
    <div class="container">
      <a class="btn btn-primary" href="/list.php">查看所有教师列表<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/> <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/></svg></a>
    </div>
  </div>

  <br>

  <div class="container p-2 border-top">
    <br>
    <h2> 找到适合你的家教</h2>
    <h4>根据你希望学习的学科进行筛选</h4>
    <div class="container" style="line-height: 50px;">
      <form action="/list.php" method="get">
	 <h5> 你希望学习的学科:</h5>
         <div class=" " data-toggle="buttons">
           <?php
           require_once "subject.php";
           for ($iter = 0;$iter < $subject_count;$iter++) {
	     echo '<label class="btn btn-sm btn-outline-info ml-1 mr-1">';
	     echo '<input type="radio" name="subject_mask" autocomplete="off" value="'.strval(1 << $iter).'">';
	     echo '&nbsp;'.$subject[$iter].'</label>';
           }
           ?>
	 </div>
	 <h5> 你所在的年级:</h5>
         <div class=" " data-toggle="buttons">
           <?php
           require_once "subject.php";
           for ($iter = 0;$iter < $grade_count;$iter++) {
	     echo '<label class="btn btn-sm btn-outline-success ml-1 mr-1">';
	     echo '<input type="radio" name="grade_mask" autocomplete="off" value="'.strval(1 << $iter).'">';
	     echo '&nbsp;'.$grade[$iter].'</label>';
           }
           ?>
	 <br>
	 <button type="submit" class="btn btn-primary">查询符合条件的教师
	 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/> <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/></svg>
	 </button>
      </form>
    </div>
  </div>


<?php require 'footer.php';?>

<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
