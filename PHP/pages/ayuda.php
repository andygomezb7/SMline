<?php
$smarty_page = 'ayuda';
$page['title'] = $web['title'].' - Ayuda';
$page['css'] = 'help';

$domain = str_ireplace(array('http://', 'https://', 'www.'), '', $web['url']);
$smarty->assign('domain', $domain);

$smarty->assign('page', $page);
?>