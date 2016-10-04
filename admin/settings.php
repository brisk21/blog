<?php

include('../start.php');
include('./start.adm.php');

$config = $db->gets("select * from settings order by sid ASC");

if($input->get('do')=='save'){
	$v = $input->post('v',false);
	foreach($v as $key=>$val){
		$sql = "update settings set v='{$val}' where k='{$key}'";
		$db->query($sql);
	}
	header("location:".ADM_URL_PATH."/admin/settings.php");
	exit;
}
//var_dump($config);
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php include(ADM_PATH.'/inc/header.inc.php');?>			
<body>
<div class="container-fluid">
	<div class="col-md-12">
		<?php include(ADM_PATH.'/inc/nav.inc.php');?>
	</div>
	<div class="col-md-12">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="page-header">
				<h1>基本设置 
					<small style='margin-right:30px;font-size:18px;'>		
						设置网站的功能开关
					</small>
				</h1>
			</div>							
			<div class="col-md-10">
				<div class="panel-body">
					<form action="<?php echo ADM_URL_PATH;?>/admin/settings.php?do=save" method="post">	
					<?php foreach( $config as $item ):?>					
						<div class="form-group">
							<label for="title"><?php echo $item['kname']; ?></label>							
							<input type="text" class="form-control" name="v[<?php echo $item['k']; ?>]"  placeholder="请输入配置" value="<?php echo $item['v']; ?>" >
							<p style="color:#6699cc;margin-top:5px;"><?php echo $item['intro']; ?>(<?php echo $item['k']; ?>)</p>
						</div>						
					<?php endforeach; ?>
							<button type="submit" class="btn btn-default">提交</button>	
					</form>						
				</div>
			</div>			
		 <div class="col-md-2"></div>
		</div>
	<div class="col-md-3"></div>
	</div>
</div>

	

</body>