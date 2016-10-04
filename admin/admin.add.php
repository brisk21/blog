
<?php
include('../start.php');
include('./start.adm.php');

$auid = (int) $input->get('auid');
$item = array(
	'auid' => 0,
	'auname'=>'',
	'passwd'=>'',
);

if($auid > 0){
	$item = $db->get("select * from adminuser where auid='{$auid}'");
	if(!$item){
		exit("没有找到对应的用户。");
	}
}

//添加帐号
if($input->get('do')=='save'){
	$auid = (int)$input->post('auid');
	$auname = trim($input->post('auname'));
	$passwd = trim($input->post('password'));
	if(empty($auname)){
		exit('用户名不能为空');
	}
	//仅是在添加时验证
	if($auid < 1){
		if(empty($passwd)){
			exit('密码不能为空');
		}
		$usercheck = $db->get("select * from adminuser where auname='{$auname}'");
		if(is_array($usercheck)){
			exit('用户已存在');
		}
	}
	//
	if($auid < 1){
		$passwd = md5($passwd);
		$sql ="insert into adminuser (auname,passwd) value ('{$auname}','{$passwd}')";
	}else{
		if(empty($passwd)){
			$sql ="update adminuser set auname='{$auname}' where auid='{$auid}'";
		}else{
			$passwd = md5($passwd);
			$sql ="update adminuser set auname='{$auname}',passwd='{$passwd}' where auid='{$auid}'";
		}		
	}
	
	//插入数据到数据库
	$db->query($sql);
	//$db->query("insert into adminuser (auname,passwd) values('{$auname}','{$passwd}')");
	header("location:admin.php");
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
		<div class="col-md-12">
			<?php include(ADM_PATH.'/inc/nav.inc.php');?>
		</div>
		<div class="col-md-12">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="page-header">
				<h1>管理员管理 
					<small style='float:right;margin-right:30px;'>		
						<a href="<?php ADM_URL_PATH ?>/admin/admin.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> 返回</a>
					</small>
				</h1>
			</div>			
			<div class="col-md-10">
				<div class="panel-body">
					<form action="<?php echo ADM_URL_PATH;?>/admin/admin.add.php?do=save" method="post">
					<input type="hidden" name='auid' value="<?php echo $auid;?>" />
						<div class="form-group">
							<label for="auname">用户名：</label>
							<input type="text" class="form-control" name="auname" id="auname" placeholder="请输入用户名" value="<?php echo $item['auname']; ?>">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">密码：</label>
							<input type="password" class="form-control" name='password' id="exampleInputPassword1" placeholder="请输入密码">
						</div>			  
							<button type="submit" class="btn btn-default">提交</button>
					</form>
				</div>
			</div>			
			 <div class="col-md-2"></div>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>