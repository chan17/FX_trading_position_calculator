<!DOCTYPE html>
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="author" content="">

<title>
  
    外汇计算器
  
</title>

<!-- Bootstrap core CSS -->
<style class="anchorjs">
	#ui-input-data{
		/*width: 80%;
		max-width: 500px;*/
	}

</style>

<link href="./css/bootstrap.min.css" rel="stylesheet">

<!-- Documentation extras -->

<link href="../assets/css/docs.min.css" rel="stylesheet">

<!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="./js/bootstrap.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Favicons -->

<script>
  var _hmt = _hmt || [];
</script>
  </head>

<body>

<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="../" class="navbar-brand">外汇计算器</a>
    </div>
    <nav id="bs-navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <a href="../getting-started/">aaa</a>
        </li>

      </ul>

    </nav>
  </div>
</header>
<article class="ui-user">
	<div class="container">
		<?php
      	include("conn.php");
      	include("check_login.php");
      	$sql = $conn->query('SELECT * FROM user WHERE id = "' . $_SESSION['id'] . '"');
		$result=$sql->fetch_array();
        ?> 
        <br/>
        <br/>
		<form class="form-inline" method="post" action="calculator.php?routing=setUserData">
			<div class="form-group">
		    <label for="">当前本金</label>
		    $
		    <input type="text" class="form-control" id="" placeholder="本金" name="deposit" value="<?php echo $result['deposit']; ?>">
		  </div>
(单位 美元)
&nbsp;&nbsp;&nbsp;&nbsp;
        

			<div class="form-group">
		    <label for="">总仓位</label>
		    
		    <input type="text" class="form-control" id="" placeholder="本金" name="position" value="<?php echo $result['position']; ?>">
		  </div>
(两位小数，不大于1)
&nbsp;&nbsp;&nbsp;&nbsp;
		  <button type="submit" class="btn btn-default">设置</button>
		</form>
		
	</div>
</article>

        <br/>
<br/>

<article class="ui-content">
	<div id="ui-input-data" class="container">
		
		<form class="form-horizontal" method="post" action="calculator.php?routing=adddata">
		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">价格</label>
		    <div class="col-sm-10">
		      <input type="text" name="price" class="form-control" id="" placeholder="价格">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">仓位</label>
		    <div class="col-sm-10">
		      <input type="text" name="position" class="form-control" id="" placeholder="仓位">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">手数</label>
		    <div class="col-sm-10">
		      <input type="text" name="round_lot" class="form-control" id="" placeholder="仓位">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">杠杆</label>
		    <div class="col-sm-10">
		      <input type="text" name="leverage" class="form-control" id="" placeholder="杠杆">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">占用保证金</label>
		    <div class="col-sm-10">
		      <input type="text" name="deposits_occupied" class="form-control" id="" placeholder="占用保证金">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">盈利</label>
		    <div class="col-sm-10">
		      <input type="text" name="earnings" class="form-control" id="" placeholder="盈利">
		    </div>
		  </div>
		  

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">计算</button>
		    </div>
		  </div>
		</form>	
	</div>

	<hr/>

	<div id="ui-view-data" class="container">
		<table class="table table-striped">
	      <thead>
	        <tr>
	          <th>#</th>
	          <th>价格</th>
	          <th>仓位</th>
	          <th>本金</th>
	          <th>杠杆</th>
	          <th>盈利</th>
	        </tr>
	      </thead>
	      <tbody>
	        <tr>
	          <th >fffffffffff</th>
	          <th >fffffffffff</th>
	          <th >fffffffffff</th>
	          <th >fffffffffff</th>
	          <th >fffffffffff</th>
	          <th >fffffffffff</th>

	        </tr>
	      </tbody>
	    </table>
	</div>

</article>
<?php 
	$conn->close();

 ?>
</body>
</html>