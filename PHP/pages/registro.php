<?php
$smarty_page = 'registro';
$page['css'] = 'registro';
$page['js'] = 'registro';
$page['title'] = $web['title'].' - Registro';
require'PHP/libs/datos.php';
if($user->uid){
	header('location: /');
	$smarty->assign('error', array('Oops!', 'Ya estas registrado', 'Ir al inicio', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

if(empty($web['reg_active'])){
	$smarty->assign('error', array('Oops!', 'El registro de cuentas nuevas en '. $web['title'].' se encuentra inhabilitado temporalmente.', 'Ir al inicio', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$smarty->assign('register_data', $array_data);
$smarty->assign('r_year', date('Y'));
$smarty->assign('page', $page);

$query['web_stats'] = $mysqli->query('SELECT web.* FROM web_stats AS web WHERE web.w_type = \'GLO\'');
$stats = $query['web_stats']->fetch_assoc();
$smarty->assign('stats', $stats);

?>