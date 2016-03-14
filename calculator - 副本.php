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

		$getUser = $conn->query("SELECT * FROM user WHERE username =$currentUID ");
		$rowGetUser=$getUser->fetch_array();

		$getPrevPosition = $conn->query("SELECT * FROM positions WHERE uid=$currentUID order by id DESC LIMIT 1;");
		$rowGetPrevPosition=$getPrevPosition->fetch_array();
		if (empty($rowGetPrevPosition)) {
			if (empty($price) or empty($round_lot) or empty($leverage)) {
				tellSth('错误，请填写关键数据');
			}
		}else{
			if (empty($price)) {
				tellSth('错误，请填写价格');
			}
			$round_lot=$rowGetPrevPosition['round_lot'];
			$leverage=$rowGetPrevPosition['leverage'];
		}
// var_dump($rowGetPrevPosition);exit();
		//可用总资金
		$maxMoney=$rowGetUser['deposit']*$rowGetUser['position'];

		//占用保证金
		$sumMoney=$price*$round_lot*100;
		$deposits_occupied=$sumMoney/$leverage;
		if ($deposits_occupied>$maxMoney) {
			tellSth('错误，累计保证金不得超过$deposits_occupied');
		}
		//计算仓位
		$position=$deposits_occupied/$rowGetUser['deposit'];
		$SumPosition = $conn->query("SELECT sum(`position`) FROM `positions` where uid=22 limit 1");
		$rowSumPosition=$SumPosition->fetch_row()[0];
		//当前总仓位
		$allPosition=$rowSumPosition+$position;
		if ($sumMoney>$getUser['position']) {
			tellSth('错误，仓位累计已超过总仓位');
		}

		//盈利
		if (empty($rowGetPrevPosition)) {
			$earnings=0;
		}else{
			
		}
		$resultAddData = $conn->query("INSERT INTO `positions` (`id`, `price`, `position`, `leverage`, `deposits_occupied`, `earnings`, `round_lot`, `stops`, `uid`) VALUES (NULL, '10.00', '0.05', '10', '0.20', '0.00', '2', '0', '22');");
		if ($resultAddData) {
			header("location:index.php?ms=数据存入失败");
		}


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