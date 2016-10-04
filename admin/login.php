<?php
include('../start.php');

define("NOT_LOGIN",1);//此页面不需要进行登录效验
include(ADM_PATH.'./start.adm.php');
$_SESSION['auid'] = 0;

//session_start();

if($input->get('do') == 'checkuser'){
	$auname = $input->post('username');
	$passwd = MD5($input->post('password'));
	$sql = "SELECT * FROM adminuser WHERE auname='{$auname}' and passwd='{$passwd}'";
	$res = $db->query($sql);
	$row = $db->get($sql);
	if(!$row){
		echo "帐号或密码错误，请重新输入.";
	}else{		
		$_SESSION['auid'] = $row['auid'];
		header("location:index.php");
		exit;
	}		
}
if($input->get('do') == 'out'){
	$_SESSION['auid'] ==0;
	header('location:login.php');
	exit;
}


?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php include(ADM_PATH.'/inc/header.inc.php');?>
</head>
<body>
	<div class="container-fluid">
		<div class="col-md-4"></div>
		<div class="col-md-4">
		  <div class="panel panel-success">
			  <div class="panel-heading">管理员登陆</div>
			  <div class="panel-body">
				<form action="<?php echo ADM_URL_PATH;?>/admin/login.php?do=checkuser" method="post">
					<div class="form-group">
						<label for="exampleInputEmail1">用户名：</label>
						<input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="请输入用户名">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">密码：</label>
						<input type="password" class="form-control" name='password' id="exampleInputPassword1" placeholder="请输入密码">
					</div>			  
						<button type="submit" class="btn btn-default">登陆</button>
				</form>
			  </div>
		 </div>			
		</div>
		<div class="col-md-4"></div>
		
	</div>
</body>
</html>