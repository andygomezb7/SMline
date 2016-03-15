<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
$can_access = array('home_page', 'top_posts', 'top_users');
if(empty($user->uid)) die('0: <a href="/registro">Reg&iacute;strate</a> para tener acceso a todas las funciones de este sitio');
require'PHP/class/account.class.php';
$account = new account;
switch($action){
	case 'save':
		echo $account->save();
	break;
	case 'import_avatar':
		$url = secure($_POST['url']);
		echo $account->import_avatar($url);
	break;
	case 'save_avatar':
		echo $account->save_avatar();
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>