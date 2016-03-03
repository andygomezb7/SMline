<?php
define('UNTARGETED', TRUE);
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', TRUE);
//=> NOS CONECTAMOS CON MYSQL
include'mysqli_start.php';
include'PHP/libs/QueryString.php';
cleanRequest();
//=> FUNCIONES PRINCIPALES
require'PHP/libs/functions.php';
//=> CONFIGURACIONES
$query['web_settings'] = $mysqli->query('SELECT web.* FROM web_settings AS web WHERE web.w_type = \'GLO\'');
$web = $query['web_settings']->fetch_assoc();
$web['css'] = $web['url'].'/themes/'.$web['theme'].'/css';
$web['js'] = $web['url'].'/themes/'.$web['theme'].'/js';
$web['img'] = $web['url'].'/themes/'.$web['theme'].'/css/img';
$web['icons'] = $web['url'].'/themes/'.$web['theme'].'/css/img/icons';
$web['avatar'] = $web['url'].'/avatar';
$web['time'] = time();
define('PRIVATE_KEY', '6LdHQvASAAAAADBKFRROyYyN58FkXluGPm1Nb-7o');
//=> USUARIO
require'PHP/class/user.class.php';
$user = new user;
$user->read();
//=> ACTIVIDAD
require'PHP/class/activity.class.php';
$activity = new activity;
//=> NOTIFICACIONES
require_once'PHP/class/notifica.class.php';
$notifica = new notifica;
//=> 
$act = secure($_GET['act'], true);
$action = secure($_GET['action'], true);
$tpl = secure($_GET['tpl'], true);
$php = 'PHP/ajax/'.$act.'.ajax.php';
// BANEADO
if($user->info['u_status'] == 3) die('0: Cuenta suspendida');
// MANTENIMIENTO
if($web['offline'] && !$user->permits['goadmin'] && $action != 'load_login' && $action != 'login'){
	die('0: '.$web['offline_message']);
}
if(file_exists($php)){
	if($tpl == 1){
		require'PHP/libs/Smarty.class.php';
		$smarty = new Smarty;
	}
	include''.$php.'';
}else die('0: El archivo que buscas no existe');
if($tpl == 1){
	if($smarty->templateExists($smarty_page.'.tpl')){
		$smarty->assign('web', $web);
		$smarty->assign('user', $user);
		$smarty->assign('sm_page', $smarty_page);
		$smarty->display($smarty_page.'.tpl');
	}else die('0: El archivo que buscas no existe');
}
?>