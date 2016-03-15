<?php
$smarty_page = 'search';
$page['css'] = 'search';
$page['js'] = 'search';
$page['title'] = $web['title'].' - '.$web['slogan'];
$q = urldecode(secure($_GET['q']));
$smarty->assign('q', $q);
if(empty($q)){
	$smarty->assign('error', array('Opps!', 'Ingresa un filtro a buscar v&aacute;lido', 'Inicio', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}
require'PHP/class/search.class.php';
$search = new search;

// DATOS
$get_data = array(
	'q' => urldecode(secure($_GET['q'])),
	'type' => secure($_GET['type']),
	'cat' => intval($_GET['cat']),
	'as' => secure($_GET['as']),
	'author' => secure($_GET['author']),
	'order' => secure($_GET['order']),
);

$smarty->assign('s_filtros', $search->buscar($q, $get_data));
$smarty->assign('s_data', $get_data);
// POSTS
require'PHP/class/posts.class.php';
$posts = new posts;
$smarty->assign('cats', $posts->cats());

$smarty->assign('page', $page);
?>