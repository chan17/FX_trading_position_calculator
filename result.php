<!DOCTYPE html>
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">

<title>
  
    外汇计算器-结果
  
</title>

<!-- Bootstrap core CSS -->
<style class="anchorjs">
	#ui-input-data{
		/*width: 80%;
		max-width: 500px;*/
	}
	#ui-view-data .table>tbody>tr>td,#ui-view-data .table>tbody>tr>th,#ui-view-data .table>tfoot>tr>td,#ui-view-data .table>tfoot>tr>th,#ui-view-data .table>thead>tr>td,#ui-view-data .table>thead>tr>th {
	    padding: 0.4em;
	}
</style>

<link href="./css/bootstrap.min.css" rel="stylesheet">

<!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="./js/bootstrap.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<![endif]-->

<!-- Favicons -->

<script>
  var _hmt = _hmt || [];
</script>
  </head>

<body >

<article>
		<a class="btn btn-primary" href="index.php" style="
    font-size: 0.95em;
">返回上一页</a>
	<div id="ui-view-data" class="container">
		<table class="table table-striped" style="
    font-size: 0.9em;
">
	      <thead>
	        <tr>
	          <th>#</th>
	          <th>价格</th>
	          <th>仓位</th>
	          <th>杠杆</th>
	          <th>占用保证金</th>
	          <th>手数量</th>
	          <th>止损</th>
	          <th>成本</th>
	          <th>盈利</th>
	        </tr>
	      </thead>
	      <tbody>
	      <?php
		    $startPrice=$_POST['price'];
			$round_lot=$_POST['round_lot'];
			$leverage=$_POST['leverage'];
			$up_amount=$_POST['up_amount'];

			$getUser = $conn->query("SELECT * FROM user WHERE id =$currentUID ");
			$rowGetUser=$getUser->fetch_array();

			if (empty($startPrice) or empty($round_lot) or empty($leverage) or empty($up_amount)) {
				tellSth('错误，请填写关键数据');
			}
		
			// var_dump($routing);
			$currentPrice=0;//行情价格
			$costPrice=0;//成本价格
			$stopPrice=0;//止损价格
			$currentRoundLot=$round_lot;
			for ($i=0; $i < 20; $i++) { 
				//可用总资金
				$maxMoney=$rowGetUser['deposit']*$rowGetUser['position'];
				//价格
				$currentPrice=$startPrice+$up_amount*$i;
				if ($i==0) {
					$costPrice=$currentPrice;
				}

				//占用保证金
				$sumMoney=$costPrice*$currentRoundLot*100;
				$deposits_occupied=$sumMoney/$leverage;//占用保证金
		/*		var_dump($sumMoney);
				var_dump($maxMoney);
				var_dump($deposits_occupied);
				exit();*/
				if ($deposits_occupied>$maxMoney) {
					tellSth('错误，累计保证金不得超过$maxMoney');
					break;
				}
				//计算仓位
				$position=$deposits_occupied/$rowGetUser['deposit'];

				if ($position>$rowGetUser['position']) {
					tellSth('错误，仓位累计已超过总仓位');
					break;
				}
				//盈利
				if ($i==0) {
					$earnings=0;
				}else{
					$earnings=($currentPrice-$costPrice)*$currentRoundLot*100;
// if ($i==2) {
// 					var_dump($currentPrice);
// 					var_dump($startPrice);
// 					var_dump($currentRoundLot);

// var_dump($earnings);
// exit();
// 	# code...
// }
					//如果盈利等于保证金，加仓相同与第一手的手数量
					if ($earnings>=$deposits_occupied and $i!=0) {
						$prevPrice=$costPrice;
						$prevRoundlot=$currentRoundLot;
						if ($stopPrice==0) {
							$stopPrice=$costPrice;
						}
// var_dump($costPrice);
						$currentRoundLot=$round_lot+$currentRoundLot;
						$costPrice=($prevRoundlot*$prevPrice+$round_lot*$currentPrice)/$currentRoundLot;
						// var_dump($currentRoundLot);
// var_dump($currentPrice);
					}
				}
				$testI=$i+1;
				$position=$position*100;
				$position=sprintf("%.2f", $position);
				$earnings=sprintf("%.2f", $earnings);
				$costPrice=sprintf("%.2f", $costPrice);
				print "<tr>
	          <th >{$testI}</th>
	          <th >{$currentPrice}点</th>
	          <th >$position%</th>
	          <th >1:$leverage</th>
	          <th >\${$deposits_occupied}</th>
	          <th >{$currentRoundLot}手</th>
	          <th >{$stopPrice}</th>
	          <th >\${$costPrice}</th>
	          <th >\${$earnings}</th>
	        </tr>";
			}/*end for*/


			function tellSth($message=''){
				// header("refresh:3;url=index.php");
				print("$message<br>三秒后自动跳转~~~");
			}

	      ?>

	      </tbody>
	    </table>
	</div>

</article>
<?php 
	$conn->close();

 ?>
</body>
</html>