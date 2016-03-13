<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册 - 陈一七BBS</title>
</head>

<body>
<p>欢迎注册账号！！<a href='index.php'>回到首页</a></p>
<p>陈一七的论坛  欢迎你！！</p>

<hr>
<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="sname"></label>
    用户名：
    <input type="text" name="sname" id="sname" />
  </p>
  <p>
    <label for="spassword"></label>
    密码 ：
    <input type="password" name="spassword" id="spassword" />
  </p>
  <p>
  再输入一遍密码嘛： <br>
  <input type="password" name="spassword2" id="spassword" />
  </P>
  <p>
    <input type="submit" name="ssub" id="ssub" value="注册" />
  </p>
</form>
<?php
include ("conn.php");
if ($_SERVER['REQUEST_METHOD']=='POST') {
  if (empty($_POST['ssub'])){
		echo "讨厌啊~ 就输入一下账号、密码嘛！";
  }
      if ($_POST['spassword']==$_POST['spassword2']) {
    		$name = $conn->real_escape_string($_POST['sname']);
    		$password = $conn->real_escape_string($_POST['spassword']);
        
        $sqlCheck = $conn->query('SELECT * FROM user WHERE username = "' . $_POST['sname'] . '"');
        $rowCheck=$sqlCheck->fetch_array();
        
        if (!empty($rowCheck)) {
          echo '用户已存在,换一个用户名';
          exit();
        }

    		$sql=$conn->query("INSERT INTO user(`username`,`password`) VALUES ('".$name."','".$password."')"); 
    		echo "陈一七说： 恭喜！用户创建成功.灭哈哈";
        $sqlGET = $conn->query('SELECT * FROM user WHERE username = "' . $_POST['sname'] . '"');
        $rowGET=$sqlGET->fetch_array();
    		
        //session记录
    		session_start();
    		$_SESSION['username'] = $rowGET['username'];
    		$_SESSION['id'] = $rowGET['id'];

        $conn->close();
        header("location:index.php");  
  		}else{
        echo "陈一七说：啊哦，两次输入的密码不一样哦。。";
      }
}
?>
</body>
</html>
