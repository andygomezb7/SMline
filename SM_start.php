<?php
//=> DEFINIMOS VATIABLES E INICIAMOS CON EL SCRIPT
define('UNTARGETED', TRUE);
if(!isset($_SESSION)) session_start();
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', TRUE);
set_time_limit(300);
//=> MSYSQLI CONEXION
include'mysqli_start.php';
include'PHP/libs/QueryString.php';
require'PHP/libs/functions.php';
cleanRequest();
if($mysqli->connect_errno) die('Error al conectar con la base de datos, revisa que los datos de conexi&oacute;n sean correctos en el archivo <strong>mysqli_start.php</strong>.<br /><br /><strong>C&oacute;digo de error MySQLi:</strong> '.$mysqli->connect_errno);
//=> CONFIGURACIONES
$query['web_settings'] = $mysqli->query('SELECT web.* FROM web_settings AS web WHERE web.w_type = \'GLO\'');
$web = $query['web_settings']->fetch_assoc();
$web['css'] = $web['url'].'/themes/'.$web['theme'].'/css';
$web['js'] = $web['url'].'/themes/'.$web['theme'].'/js';
$web['img'] = $web['url'].'/themes/'.$web['theme'].'/css/img';
$web['icons'] = $web['url'].'/themes/'.$web['theme'].'/css/img/icons';
$web['avatar'] = $web['url'].'/avatar';
$web['time'] = time();
//=> INCLUIR EL SMARTY
require'PHP/libs/Smarty.class.php';
$smarty = new Smarty;
$smarty->assign('web', $web);
//=> USUARIO
require'PHP/class/user.class.php';
$user = new user;
$user->read();
$user->sm_update();
$smarty->assign('user', $user);
//=> ACTIVIDAD
require'PHP/class/activity.class.php';
$activity = new activity;
//=> 
$act = secure($_GET['act'], true);
$smarty->assign('act', $act);
$pages_list = array('admin', 'mod', 'posts', 'comunidades', 'imagenes', 'miembros', 'tops', 'registro', 'cuenta', 'favoritos', 'borradores', 'monitor', 'mensajes', 'historial', 'agregar-post', 'protocolo', 'terminos-y-condiciones', 'ayuda', 'buscar', 'recover', 'pages');
// BANEADO
if($user->info['u_status'] == 3){
	$query_ban = $mysqli->query('SELECT ub_id, ub_user, ub_reason, ub_mod, ub_date, ub_end FROM users_bans WHERE ub_user = \''.$user->uid.'\' LIMIT 1');
	$data_ban = $query_ban->fetch_assoc();
	
	if($data_ban['ub_end'] > 0 && $data_ban['ub_end'] < time()){
		$mysqli->query('UPDATE users SET u_status = \'1\' WHERE u_id = \''.$user->uid.'\'');
		$mysqli->query('DELETE FROM users_bans WHERE ub_user = \''.$user->uid.'\'');
	}
	
	$end_ban = $data_ban['ub_end'] == 0 ? '<b>indefinida</b>' : '<b>'.date('d/m/Y h:i:s A',  $data_ban['ub_end']).'</b>';
	$smarty->assign('error', array('Cuenta suspendida', 'Raz&oacuten: <b>'.$data_ban['ub_reason'].'</b><br />Fecha de rehabilitaci&oacute;n: '.$end_ban, 'Comprobar de nuevo', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}
// MANTENIMIENTO
if($web['offline'] && !$user->permits['goadmin']){
	$smarty->assign('error', array('Mantenimiento', $web['offline_message'], 'Comprobar de nuevo', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Mantenimiento'));
	$smarty->display('error.tpl');
	die;
}
// INCLUIR PAGE

if(in_array(strtolower($act), $pages_list)) include'PHP/pages/'.$act.'.php';
else if(empty($sistemapx)) include'PHP/pages/perfil.php';
if($smarty->templateExists($smarty_page.'.tpl')){
	$smarty->assign('sm_page', $smarty_page);
	$smarty->display($smarty_page.'.tpl');
}else if(empty($sistemapx)) die('El archivo que buscas no existe');

?>