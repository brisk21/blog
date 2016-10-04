<?php
include("../start.php");
include('./start.adm.php');
include('../lib/page.class.php');
//删除
switch($input->get('do')){
	case "delete":
	$bid = (int)$input->get('bid');
	if($bid < 1){
		exit('没有正确传递auid的参数');
	}
	
	$db->query("delete  from blog where bid = '{$bid}'");
	header("location:blog.php");
	break;
}
//当前页数
$p = (int)$input->get('p');
if($p<1){
	$p=1;
}
//每页显示数（从系统配置中取）
$blog_num = C('adm_blog_page');

$offset = $blog_num*($p-1);
$blogs_count = $db->get("select count(*) as total from blog")[0];//高版本（5.4x)用
$page = new page($blogs_count,$blog_num,$p,ADM_URL_PATH.'/admin/blog.php');
//$blogs_count = $db->get("select count(*) as total from blog");

//读取blog的数据
$blogs = $db->gets("select * from blog order by bid desc limit {$offset},{$blog_num}");

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
				<div class="page-header">
					<h1>日志管理 
						<small style='float:right;margin-right:30px;'>		
							<a href="./blog.add.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 添加</a>
						</small>
					</h1>
				</div>
				<div class="table-responsive ">
					<table class="table">
						<thead>
							<tr>
								<th>bid</th>
								<th>标题</th>
								<th>作者</th>
								<th>时间</th>
								<th>管理功能</th>
							</tr>
						</thead>
						<tbody>						
							 <?php foreach($blogs as $bblog): ?>
							<tr>
								<td><?php echo $bblog['bid'];?></td>
								<td><?php echo $bblog['title'];?></td>
								<td><?php echo $bblog['author'];?></td>								
								<td><?php echo date("Y-m-d H:i:s",$bblog['intime']) ;?></td>
								<td>
								<a href="blog.add.php?bid=<?php echo $bblog['bid']; ?>" class="btn btn-primary btn-xs">编辑</a>
								
								<a href="blog.php?do=delete&bid=<?php echo $bblog['bid']; ?>" class="btn btn-danger btn-xs">删除</a>
						
								</td>
							</tr>
							<?php 	endforeach ; ?>
						</tbody>
					</table>
				</div>
				<nav class="pull-right">
					<ul class="pagination">
						<?php echo $page->showPage(); ?>							
					</ul>
				</nav>
			</div>		
		</div>
	</div>
</body>
</html>