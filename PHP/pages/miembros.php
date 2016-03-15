<?php
$smarty_page = 'members';
$page['title'] = $web['title'].' - '.$web['slogan'];
$page['css'] = 'members';

// USERS
require_once'PHP/libs/datos.php';
$smarty->assign('array_paises', $array_data['paises']);
$smarty->assign('get_users', $user->get_users());
$smarty->assign('order', secure($_GET['order']));

$smarty->assign('page', $page);
?>