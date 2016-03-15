<?php
$smarty_page = 'mod-history';
$page['title'] = $web['title'].' - Historial de moderaci&oacute;n';
$page['css'] = array('favorites', 'history');

require'PHP/class/posts.class.php';
$posts = new posts;

$smarty->assign('get_history', $posts->get_history());


$smarty->assign('page', $page);
?>