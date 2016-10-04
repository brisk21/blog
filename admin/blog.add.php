
<?php
date_default_timezone_get ( 'Asia/Shanghai' );


include('../start.php');
include('./start.adm.php');

$bid = (int) $input->get('bid');

$bblog = array(
	'bid' => 0,
	'title'=>'',
	'author'=>$user['auname'],
	'content'=>'',
	'bkeyword'=>'',
);
if($bid > 0){
	$bblog = $db->get("select * from blog where bid='{$bid}'");
	if(!$bblog){
		exit("没有找到对应的日志。");
	}
}	

if($input->get('do')=='save'){
	$bid = (int)$input->post('bid');
	$title = trim($input->post('title'));
	$author = trim($input->post('author'));	
	$content = trim($input->post('content',false));
	$bkeyword = trim($input->post('bkeyword'));
	$nowTime = time();
	
	if(empty($title) || empty($author) || empty($content)){
		exit('请填写完整表单信息');
	}
	
	if($bid>0){
		$sqlStr = "update blog set title='%s' ,author='%s',content='%s',uptime='%d',bkeyword='%s' WHERE bid='%d'";
		$sql = sprintf($sqlStr,$title,$author,$content,$nowTime,$bid,$bkeyword);
	}else{		
		$sqlStr = "INSERT INTO blog (`title`,`author`,`content`,`intime`,`uptime`,`bkeyword`) value('%s','%s','%s','%d','%d','%s')";
		$sql = sprintf($sqlStr,$title,$author,$content,$nowTime,$nowTime,$bkeyword);		
	}
	$db->query($sql);
	header("location:blog.php");
	exit;

}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php include(ADM_PATH.'/inc/header.inc.php');?>	
		<script charset="utf-8" src="../public/kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="../public/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="../public/kindeditor/lang/zh_CN.js"></script>
		<script>
		//富文本编辑器
				KindEditor.ready(function(K) {
						window.editor = K.create('#editor_id');
						// 取得HTML内容
						html = editor.html();

						// 同步数据后可以直接取得textarea的value
						editor.sync();
						html = document.getElementById('editor_id').value; // 原生API
						html = K('#editor_id').val(); // KindEditor Node API
						html = $('#editor_id').val(); // jQuery

						// 设置HTML内容
						//editor.html('HTML内容');
						// 关闭过滤模式，保留所有标签
						// K.create('#editor_id');
						 //KindEditor.options.filterMode = false;
						  
						  

				});
				
				
		</script>
<body>
	<div class="container-fluid">
		<div class="col-md-12">
			<?php include(ADM_PATH.'/inc/nav.inc.php');?>
		</div>
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-12">
				<div class="page-header">
					<h1>日志管理 
						<small style='float:right;margin-right:30px;'>		
							<a href="<?php ADM_URL_PATH ?>/admin/blog.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> 返回</a>
						</small>
					</h1>
				</div>		
					
				<div class="col-md-10">
					<div class="panel-body">
						<form action="<?php echo ADM_URL_PATH;?>/admin/blog.add.php?do=save" method="post">
						<input type="hidden" name='bid' value="<?php echo $bid;?>" />
							<div class="form-group">
								<label for="title">标题：</label>
								<input type="text" class="form-control" name="title" id="title" placeholder="请输入文章标题" value="<?php echo $bblog['title']; ?>">
							</div>
							<div class="form-group">
								<label for="author">作者：</label>								
								<input type="text" class="form-control" name="author"  id="author" value="<?php echo $bblog['author']; ?>" >
							</div>
							<div class="form-group">
								<label for="bkeyword">关键词：</label>								
								<input type="text" class="form-control" name="bkeyword"  id="bkeyword" value="<?php echo $bblog['bkeyword']; ?>" >
							</div>
							<div class="form-group">
								<label for="content">内容：</label>
								<textarea name="content"  id="editor_id" style="width:100%;height:300px;" >
									<?php echo htmlspecialchars($bblog['content']); ?>
								</textarea>								
							</div>
									  
								<button type="submit" class="btn btn-default">提交</button>	
						</form>
						<form action="upload.php" method="post"  class="pull-right" enctype="multipart/form-data">							
							<input type="file" name="file1" style="margin:15px auto;"  />
							<input type="submit" value="单独上传"  />
						
						</form>
					</div>
				</div>			
			 <div class="col-md-2"></div>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
	<!--富文本编辑器-->
	

</body>