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

<body>

<article>

	<div id="ui-view-data" class="container">
		<table class="table table-striped">
	      <thead>
	        <tr>
	          <th>#</th>
	          <th>价格</th>
	          <th>仓位</th>
	          <th>杠杆</th>
	          <th>占用保证金</th>
	          <th>手数量</th>
	          <th>止损</th>
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
			$currentPrice=0;
			$currentRoundLot=$round_lot;
			for ($i=0; $i < 20; $i++) { 
				//可用总资金
				$maxMoney=$rowGetUser['deposit']*$rowGetUser['position'];
				//价格
				$currentPrice=$startPrice+$up_amount*$i;

				//占用保证金
				$sumMoney=$startPrice*$currentRoundLot*100;
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
					$earnings=($currentPrice-$startPrice)*$currentRoundLot*100;
					//如果盈利等于保证金，加仓相同与第一手的手数量
					if ($earnings>=$deposits_occupied and $i!=0) {
						$currentRoundLot=$round_lot+$currentRoundLot;
					}
				}
				$testI=$i+1;
				print "<tr>
	          <th >第{$testI}手</th>
	          <th >$currentPrice</th>
	          <th >$position</th>
	          <th >$leverage</th>
	          <th >$deposits_occupied</th>
	          <th >$currentRoundLot</th>
	          <th >aaa</th>
	          <th >$earnings</th>
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