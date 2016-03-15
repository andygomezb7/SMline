<?php
$smarty_page = 'terminos';
$page['title'] = $web['title'].' - T&eacute;rminos y condiciones';
$page['css'] = 'help';

$domain = str_ireplace(array('http://', 'https://', 'www.'), '', $web['url']);
$smarty->assign('domain', $domain);

$smarty->assign('page', $page);
?>