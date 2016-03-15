<?php
ob_start(); 
define('UNTARGETED', TRUE);
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', FALSE);

function back_paso($paso){
	$dire = urldecode($web_url."/SM/install.php?paso=".$paso);
	header("Location: $dire");
	exit();
}

// PASAR A SMLINE PRIME 1.1.2
$SM_DB = array();

$SM_DB[] = "CREATE TABLE IF NOT EXISTS  `admin_themes` (
 `t_id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
 `t_name` VARCHAR( 100 ) NOT NULL ,
 `t_seo` VARCHAR( 100 ) NOT NULL ,
 `t_author` VARCHAR( 100 ) NOT NULL ,
 `t_author_link` VARCHAR( 300 ) NOT NULL ,
PRIMARY KEY (  `t_id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT =2;";

$SM_DB[] = "INSERT INTO  `admin_themes` (  `t_id` ,  `t_name` ,  `t_seo` ,  `t_author` ,  `t_author_link`, `t_install` ) 
VALUES ( 1,  'SMline Default',  'smline',  'David077',  'https://www.facebook.com/cristian.anzola.35', '".time()."' );";

$SM_DB[] = "ALTER TABLE web_settings ADD theme VARCHAR(100) NOT NULL DEFAULT 'smline'";

$SM_DB[] = "UPDATE users_ranks SET r_image = 'padre.gif', r_permits = 'a:87:{s:7:\"goadmin\";i:1;s:5:\"gomod\";i:1;s:2:\"bp\";i:1;s:2:\"ep\";i:1;s:3:\"vpb\";i:1;s:3:\"vpr\";i:1;s:3:\"apr\";i:1;s:2:\"fp\";i:1;s:3:\"dfp\";i:1;s:2:\"bf\";i:1;s:2:\"ef\";i:1;s:3:\"vfb\";i:1;s:2:\"be\";i:1;s:2:\"ee\";i:1;s:3:\"veb\";i:1;s:3:\"scs\";i:1;s:3:\"rcs\";i:1;s:3:\"ecs\";i:1;s:4:\"vmcs\";i:1;s:2:\"bt\";i:1;s:2:\"et\";i:1;s:2:\"ft\";i:1;s:2:\"dt\";i:1;s:2:\"bc\";i:1;s:2:\"oc\";i:1;s:2:\"ec\";i:1;s:3:\"acc\";i:1;s:3:\"vcb\";i:1;s:2:\"su\";i:1;s:2:\"ru\";i:1;s:4:\"ecds\";i:1;s:4:\"etds\";i:1;s:4:\"aebn\";i:1;s:3:\"ebp\";i:1;s:5:\"aebli\";i:1;s:3:\"acp\";i:1;s:3:\"acf\";i:1;s:3:\"acm\";i:1;s:4:\"aebc\";i:1;s:3:\"aeu\";i:1;s:4:\"aebm\";i:1;s:4:\"aebr\";i:1;s:4:\"abpc\";i:1;s:4:\"abib\";i:1;s:2:\"as\";i:1;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:500;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:500;s:4:\"vpfm\";i:500;s:4:\"vnfm\";i:500;s:3:\"ptm\";i:500;s:4:\"vptm\";i:500;s:4:\"vntm\";i:500;s:4:\"ccsm\";i:50;s:3:\"pcm\";i:500;s:3:\"emm\";i:500;s:4:\"vpcm\";i:500;s:4:\"vncm\";i:500;s:3:\"pem\";i:500;}' WHERE r_id = 1 LIMIT 1";

$SM_DB[] = "UPDATE web_settings SET smline_version = '1.1 Prime' LIMIT 1";

require'../mysqli_start.php';

if($mysqli->connect_errno) die('Error de conexi&oacute;n: '.$mysqli->connect_errno.', tus datos en el archivo <strong>mysqli_start.php</strong> son incorrectos');
elseif($mysqli->error) die('Error SQL: '.$mysqli->error);

foreach($SM_DB as $val){
	$mysqli->query($val);
}

echo 'Haz pasado de SMline 1.0 a 1.1 correctamente, ya puedes eliminar este archivo!';

ob_end_flush();
?>