<?php

error_reporting(E_ALL^E_NOTICE);

define('URL_PATH','http://localhost/blog');

define('APP_PATH',dirname(__FILE__));

define('ADM_PATH',APP_PATH.'/admin');
define('ADM_URL_PATH','http://localhost/blog');

include(APP_PATH.'/config.php');

include(APP_PATH.'/lib/db.class.php');
$db = new db('127.0.0.1','root','wbs123','blog');

include(APP_PATH.'/lib/input.class.php');
$input = new input();

include(APP_PATH.'/lib/function.php');