<?php
$smarty_page = 'protocolo';
$page['title'] = $web['title'].' - Protocolo';
$page['css'] = 'help';

$domain = str_ireplace(array('http://', 'https://', 'www.'), '', $web['url']);
$smarty->assign('domain', $domain);

$smarty->assign('page', $page);
?>