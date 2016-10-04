<?php 
//include('../start.php');

session_start();

$session_auid = (int)$input->session('auid');

$user = $db->get("select * from adminuser where auid='{$session_auid}'");

//验证登录
if($session_auid<1 && defined('NOT_LOGIN')==false){
	header('location:'.ADM_URL_PATH.'/admin/login.php');
	exit;
}

?>