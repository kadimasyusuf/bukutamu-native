<?php
error_reporting(E_ALL);
session_start();
date_default_timezone_set('Asia/Jakarta');
function base_url()
{
	$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$base_url .= "://" . $_SERVER['HTTP_HOST'];
	$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
	return $base_url;
}
function convert_img_to_base64($path)
{
	$type = pathinfo($path,PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	return 'data:image/'.$type.';base64,'.base64_encode($data);
}
function only_level_access($level)
{
	if(is_array($level)){
		if(!in_array(@$_SESSION['level'], $level)) exit(header('location:../login.php'));
	}else{
		if(@$_SESSION['level'] != $level) exit(header('location:../login.php'));
	}
}
function check_session()
{
	if(@$_SESSION['id_pengguna'] == '') exit(header('location:../login.php'));
}