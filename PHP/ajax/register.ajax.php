<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
if($user->uid) die('0: Ya eres miembro');
require'PHP/class/register.class.php';
$reg = new reg;
switch($action){
	case 'check':
		$nick = secure($_POST['r_nick']);
		$email = secure($_POST['r_email']);
		echo $reg->check($nick, $email);
	break;
	case 'send':
		echo $reg->send();
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>