<?php
define('DB_SERVER', 'localhost');
$DB_TABLE='**table name**';
define('DB_USERNAME', '******');
define('DB_PASSWORD', '******');
define('DB_NAME', '**db name**');
 
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($con === false) {
	die("MYSQL connection error " . mysqli_connect_error());
}
$con->query("set names 'utf8' ");
$con->query("set character_set_client=utf8");
$con->query("set character_set_results=utf8");

?>
