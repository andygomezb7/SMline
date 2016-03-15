<?php
$smarty_page = 'agregar-post';
$page['css'] = 'add';
$page['js'] = 'agregar-post';
$page['title'] = $web['title'].' - Agregar post';

if(empty($user->uid)){
	header('location: /');
	$smarty->assign('error', array('Oops!', 'Solo usuarios registrados pueden postear', 'Ir al inicio', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$pid = intval($_GET['pid']);
$bid = intval($_GET['bid']);
if($pid){
	require'PHP/class/posts.class.php';
	$posts = new posts;
	$post = $posts->get_edit_post($pid);
	if(is_array($post)){
		$smarty->assign('post', $post);
		$smarty_page = 'editar-post';
	}else{
		$smarty->assign('error', array('Oops!', $post, 'Ir al inicio', '/'));
		$smarty->assign('page', array('title' => $web['title'].' - Error'));
		$smarty->display('error.tpl');
		die;
	}
}elseif($bid){
	require'PHP/class/posts.class.php';
	$posts = new posts;
	$post = $posts->get_edit_post($bid, true);
	if(is_array($post)){
		$post['b_id'] = $post['p_id'];
		$post['p_id'] = 0;
		$smarty->assign('post', $post);
		$smarty_page = 'editar-post';
	}else{
		$smarty->assign('error', array('Oops!', $post, 'Ir al inicio', '/'));
		$smarty->assign('page', array('title' => $web['title'].' - Error'));
		$smarty->display('error.tpl');
		die;
	}
}

$query['cats'] = $mysqli->query('SELECT c_id, c_name FROM posts_cats ORDER BY c_name ASC');
while($row = $query['cats']->fetch_assoc()) $cdata['cats'][] = $row;
$smarty->assign('cats_list', $cdata['cats']);
$smarty->assign('page', $page);
?>