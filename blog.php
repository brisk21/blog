<?php
include('./start.php');
include(APP_PATH.'/lib/page.class.php');

$bid = (int) $input->get('bid');
if($bid < 1){
	exit('不是有效的参数');
}
$blog = $db->get("select * from blog where bid ='{$bid}'");
if(!$blog){
	exit("不存在对应的数据");
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php include('inc/header.inc.php'); ?>
	
</head>
<body>
	<div class="container-fluid" >
		<?php include('inc/nav.inc.php') ;?>
		<div class="col-md-9">
			<ol class="breadcrumb">
				<li><a href="<?php echo URL_PATH;?>"><span class="glyphicon glyphicon-home"></span>博客首页</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-book"></span><?php echo $blog['title'];?></a></li>				
			</ol>		
			<div class="page-header ">
				<h1 >				
					<?php echo $blog['title'];?>
					<small style="font-size:16px">
						作者：<?php echo $blog['author'];?>	&nbsp;
						发表时间：<?php echo date("Y-m-d",$blog['intime']);?>
					</small>									
				</h1>
			</div>					
			<div class="well" style="line-height:2em;">
				<?php echo $blog['content'];?>
			</div>			
		</div>
		<div class="col-md-3" >
			<?php include('inc/sidebar.inc.php');	?>	
		</div>
	</div>
	<div class="  pager" >			
		<?php include('inc/foot.inc.php');?>
	</div>
</body>
</html>