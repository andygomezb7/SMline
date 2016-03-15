<?php
$smarty_page = 'account';
$page['css'] = array('profile', 'account', 'img_area_select/imgareaselect');
$page['js'] = array('account', 'jquery.imgareaselect');
$page['title'] = $web['title'].' - '.$web['slogan'];
if(empty($user->uid)){
	$smarty->assign('error', array('Opps!', 'Necesitas una cuenta en '.$web['title'].' para acceder', 'Crear cuenta', '/registro'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}
require'PHP/libs/datos.php';
require'PHP/class/account.class.php';
$account = new account;
$smarty->assign('acc_data', $array_data);
$smarty->assign('r_year', date('Y'));
$smarty->assign('u_info', $account->get_info());
$smarty->assign('page', $page);
?>