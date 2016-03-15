<?php
// VARIABLES PRINCIPALES
$page['css'] = array();
$page['js'] = array();
$page['title'] = $web['title'].' - '.$web['slogan'];
$do = secure($_GET['do']);

// PAGE
$smarty_page = 'pages/'.$do;

// NO EXISTE EL TEMPLATE?
if(!$smarty->templateExists($smarty_page.'.tpl')) header('Location: /');

// ASIGNAMOS VARIABLES
switch($do){
	case 'ejemplo':
		$page['title'] = $web['title'].' - Ejemplo';
	break;
}

$smarty->assign('page', $page);
?>