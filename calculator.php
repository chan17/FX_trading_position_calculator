<?php
@session_start();
include("conn.php");
// var_dump($_SESSION);
if (empty($_SESSION['id'])) {
	exit();
}
$currentUID=$_SESSION['id'];

$routing=$_GET['routing'];

switch ($routing) {
	case 'setUserData':
		$result = $conn->query("UPDATE `user` SET `deposit` = {$_POST['deposit']},`position` = {$_POST['position']} WHERE `id` = {$currentUID}");
		break;
	case 'adddata':
		$price=$_POST['price'];
		$round_lot=$_POST['round_lot'];
		$leverage=$_POST['leverage'];
		$up_amount=$_POST['up_amount'];

		$getUser = $conn->query("SELECT * FROM user WHERE username =$currentUID ");
		$rowGetUser=$getUser->fetch_array();

		if (empty($price) or empty($round_lot) or empty($leverage) or empty($up_amount)) {
			tellSth('错误，请填写关键数据');
		}
	

// var_dump($rowGetPrevPosition);exit();
		

		for ($i=0; $i < 20; $i++) { 
			//可用总资金
			$maxMoney=$rowGetUser['deposit']*$rowGetUser['position'];
			//价格
			$price=$up_amount*$i;

			//占用保证金
			$sumMoney=$price*$round_lot*100;
			$deposits_occupied=$sumMoney/$leverage;
			if ($deposits_occupied>$maxMoney) {
				tellSth('错误，累计保证金不得超过$maxMoney');
			}
			//计算仓位
			$position=$deposits_occupied/$rowGetUser['deposit'];

			if ($sumMoney>$getUser['position']) {
				tellSth('错误，仓位累计已超过总仓位');
			}

			//盈利
			if ($i==0) {
				$earnings=0;
			}else{

			}

		}/*end for*/
	


		break;
	default:
		# code...
		break;
}


tellSth();
function tellSth($message=''){
	$conn->close();
	header("location:index.php?ms=$message");
}
?>