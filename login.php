<!--<meta charset="utf8"> -->
<?php
session_start();
//引用数据库
include ("conn.php");

//登陆时判断字段是否为空。。
// if (!isset($_POST['submit2'])) {
//   exit("请输入用户名or密码。");
//}
if (!isset($_POST['user_id'])) {
	echo "没有用户名<br>";
}
if (!isset($_POST['passw'])) {
	echo '没有密码<br>';
}

$user_name = @$_POST['user_id'];
$user_password = @$_POST['passw'];
//获取账号密码
$sql = $conn->query('SELECT * FROM user WHERE username = "' . $user_name . '"');
// $sql = $conn->query('SELECT * FROM user WHERE `username` = zhang');
// var_dump($conn->error);
// var_dump($sql->fetch_array());exit();
$row=$sql->fetch_array();

if ($user_password == $row['password']) {
// var_dump($row);exit();
	$_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $row['username'];

	echo $row['username']."欢迎登陆**网！<br/><br>";
	//exit;
	$conn->close();
	header("location:index.php");
}else{
	$conn->close();
	echo "登陆失败,请重新登陆。<br>";
	header("location:login.html");
}

// //检测是否登陆？
// if (!isset($_SESSION['user_name'])){
// 	header("location:login.php");
//}

?>

