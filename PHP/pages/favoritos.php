<?php
$smarty_page = 'favorites';
$page['css'] = array('search', 'favorites');
$page['js'] = 'favorites';
$page['title'] = $web['title'].' - Favoritos';
// CLASE
require'PHP/class/posts.class.php';
$posts = new posts;

if(empty($user->uid)){
	$smarty->assign('error', array('Oops!', 'Solo usuarios registrados pueden agregar favoritos', 'Registrarme gratis', '/registro'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$f_action = secure($_GET['do']);

switch($f_action){
	case 'posts':
	case '':
	break;
	case 'temas':
	break;
	case 'imagenes':
	break;
	default:
		$smarty->assign('error', array('Oops!', 'Lo que buscas no se encuentra por aqu&iacute;', 'Volver a favoritos', '/favoritos'));
		$smarty->assign('page', array('title' => $web['title'].' - Error'));
		$smarty->display('error.tpl');
		die;
	break;
}

$smarty->assign('favorites', $posts->favorites($f_action));
$smarty->assign('f_action', $f_action);

// ARRAY VARS
$smarty->assign('page', $page);
?>