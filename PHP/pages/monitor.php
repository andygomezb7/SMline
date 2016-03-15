<?php
$smarty_page = 'monitor';
$page['css'] = array('monitor', 'search');
$page['js'] = 'monitor';
$page['title'] = $web['title'].' - Monitor de noficaciones';
// CLASE
require'PHP/class/notifica.class.php';
$notifica = new notifica;

if(empty($user->uid)){
	$smarty->assign('error', array('Oops!', 'Solo usuarios registrados pueden tener acceso al monitor', 'Registrarme', '/registro'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$limit = 20;
$start = 0;
$smarty->assign('limit', $limit);
$smarty->assign('notifications', $notifica->generate($start, $limit, false));

$smarty->assign('page', $page);
?>