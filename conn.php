<meta charset="utf8">
<?php
// $conn = mysqli_connect("localhost","root","","fx_trading");
$conn = mysqli_connect("localhost","root","root","fx_trading");
if (!$conn) {
  exit("链接数据库失败！");
}
//连接到chan17
if (!$conn) {
	die("没有连接到chan17:".mysql_error());
}
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    // printf("Current character set: %s\n", $conn->character_set_name());
}

?>
