<?php
include('../start.php');
include('./start.adm.php');

//读取adminuser的数据
$users = $db->gets("select * from adminuser");

//删除操作
switch($input->get('do')){
	case "delete":
	$auid = (int)$input->get('auid');
	if($auid < 1){
		exit('没有正确传递auid的参数');
	}
	if($user['auid'] == $auid){
		exit("干嘛要自杀，不可以这样哦。");
	}
	$db->query("delete  from adminuser where auid = '{$auid}'");
	header("location:admin.php");
	break;
	
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
						<a href="./admin.add.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 添加</a>
					</small>
				</h1>
			</div>
			<div class="table-responsive ">
				<table class="table">
					<thead>
						<tr>
							<th>auid</th>
							<th>auname</th>
							<th>
								管理功能
							</th>
						</tr>
					</thead>
					<tbody>
						
						 <?php foreach($users as $item): ?>

						<tr>
							<td><?php echo $item['auid'];?></td>
							<td><?php echo $item['auname'];?></td>
							<td>
							<a href="admin.add.php?auid=<?php echo $item['auid']; ?>" class="btn btn-primary btn-xs">编辑</a>
							<?php if( $user['auid'] != $item['auid']): ?>
							<a href="admin.php?do=delete&auid=<?php echo $item['auid']; ?>" class="btn btn-danger btn-xs">删除</a>
							<?php endif;?>
							</td>
						</tr>
						<?php 	endforeach ; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>