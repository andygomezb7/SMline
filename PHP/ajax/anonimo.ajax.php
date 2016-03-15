<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
if($user->uid) die('0: Ya eres miembro');
switch($action){
	case 'load_login':
		$smarty_page = 't_ajax/load_login';
	break;
	case 'login':
		require'PHP/class/anonimo.class.php';
		$anon = new anon;
		$nick = secure($_POST['nick']);
		$pass = secure($_POST['pass']);
		echo $anon->login($nick, $pass, 1);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>