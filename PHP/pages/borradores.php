<?php
$smarty_page = 'borradores';
$page['title'] = $web['title'].' - Borradores';
require'PHP/class/posts.class.php';
$posts = new posts;
	
	if(empty($user->uid)){
		$smarty->assign('error', array('Opps!', 'Necesitas una cuenta en '.$web['title'].' para acceder', 'Crear cuenta', '/registro'));
		$smarty->assign('page', array('title' => $web['title'].' - Error'));
		$smarty->display('error.tpl');
		die;
	}
	
	$page['js'] = 'favorites';
	$page['css'] = 'favorites';
	
	$smarty->assign('do', secure($_GET['do']));
	$smarty->assign('get_borradores', $posts->get_borradores());

$smarty->assign('page', $page);
?>