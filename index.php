<?php
include('./start.php');
include(APP_PATH.'/lib/page.class.php');

$bid = (int) $input->get('bid');
$blog = $db->get("select * from blog where bid ='{$bid}'");
//当前页数
$p = (int)$input->get('p');
if($p<1){
	$p=1;
}
//每页显示数（从系统配置中取）
$blog_num = C('blog_page');
$offset = $blog_num*($p-1);

$blogs_count = $db->get("select count(*) as total from blog")[0];//高版本（5.4x)用
$page = new page($blogs_count,$blog_num,$p,URL_PATH.'/index.php');
//$blogs_count = $db->get("select count(*) as total from blog");//低版本用，顺序不变
//读取blog的数据
$blogs = $db->gets("select * from blog order by bid desc limit {$offset},{$blog_num}");
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
				<li><a href="<?php echo URL_PATH;?>"><span class="glyphicon glyphicon-home"></span>首页</a></li>				
			</ol>
			<?php foreach( $blogs as $blog):?>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">
						<span class="glyphicon glyphicon-tags" style="color:#666666;"></span>
						<a href="<?php echo URL_PATH;?>/blog.php?bid=<?php echo $blog['bid'];?>"><?php echo $blog['title'];?></a>
					</h3>
				</div>
				<div class="panel-body  ">
					<?php echo mb_substr(strip_tags($blog['content']),0,120);?>……
				</div>	
			</div>
			<?php endforeach;?>
			<nav class="pull-right">
				<ul class="pagination">
					<?php echo $page->showPage(); ?>							
				</ul>
			</nav>
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