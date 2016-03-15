<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
function cleanInput($input) {
	$search = array(
		'@< [/!]*?[^<>]*?>@si',
		'@< ![sS]*?--[ tnr]*>@',
		'/(?i)\<script\>(.*?)\<\/script\>/i',
		'/(?i)\<script (.*?)\>(.*?)\<\/script>/i',
		'/(?i)\<style\>(.*?)\<\/style\>/i',
		'/(?i)\<style (.*?)\>(.*?)\<\/style>/i'
	);

	$output = preg_replace($search, '', $input);
	return $output;
}

function secure($var, $xss = false, $is_bbcode = false, $fullsecure = true){
	global $mysqli;
	$var = function_exists('magic_quotes_gpc') ? stripslashes($var) : $var;
	if(!$is_bbcode) $var = cleanInput($var);
	$var = $mysqli->real_escape_string($var);
	if($xss) $var = htmlspecialchars($var);
	if($fullsecure) return strip_tags($var);
	return $var;
}

function json($data, $type = 'encode'){
	require_once'PHP/libs/JSON.php';
	$json = new Services_JSON;
	if($type == 'encode') return $json->encode($data);
	elseif($type == 'decode') return $json->decode($data);            
}

function es_nulo($text){
	$text = str_ireplace(array('\n','\t',' ', chr(0xC2), chr(0xA0)),'',$text);
	if(empty($text)) return true;
	else return false;
}
	
function seo($string){
	$espanol = array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
	$ingles = array('a','e','i','o','u','n','A','E','I','O','U','N');
	$string = str_ireplace($espanol,$ingles,$string);
	$string = trim($string);
	$string = trim(preg_replace('/[^ A-Za-z0-9_]/', '-', $string));
	$string = preg_replace('/[ \t\n\r]+/', '-', $string);
	$string = str_replace(' ', '-', $string);
	$string = preg_replace('/[ -]+/', '-', $string);
	$string = strtolower($string);
	return $string;
}

function hace($ptime){
	if(empty($ptime)) return 'Nunca';
    $etime = time() - $ptime;
    if ($etime < 1) return 'Hace unos instantes';
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'a&ntilde;o',
                30 * 24 * 60 * 60       =>  'mes',
                24 * 60 * 60            =>  'd&iacute;a',
                60 * 60                 =>  'hora',
                60                      =>  'minuto',
                1                       =>  'segundo'
                );
    foreach ($a as $secs => $str){
        $d = $etime / $secs;
        if ($d >= 1){
            $r = round($d);
			$end = $str == 'mes' ? 'es' : 's';
            return 'Hace '.$r . ' ' . $str . ($r > 1 ? $end : '');
        }
    }
}

function get_meta_description($body, $title){
	$text = htmlentities($body, ENT_NOQUOTES);
		//$text = nl2br($body);
		$a = array(
			"/(?i)\[i\](.*?)\[\/i\]/i",
			"/(?i)\[b\](.*?)\[\/b\]/i",
			"/(?i)\[u\](.*?)\[\/u\]/i",
			"/(?i)\[hr\]/i",
			"/(?i)\[swf\=(.+?)\]/i",
			"/(?i)\[video\](.*?)=(.*?)\[\/video\]/i",
			"/(?i)\[align\=([a-z]+)\]([^\a]+?)\[\/align\]/i",
			"/(?i)\[size\=([0-9]{1,2})\]([^\a]+?)\[\/size\]/i",
			"/(?i)\[font\=([^\a]+?)\]([^\a]+?)\[\/font\]/i",
			"/(?i)\[color\=([\#]?[0-9a-f]{3}|[\#]?[0-9a-f]{6}|[a-z]{3,})\]([^\a]+?)\[\/color\]/i",
			"/(?i)\[quote\=([^\n\r\t\<\>]+?)\|([0-9]+?)\]([^\a]+?)\[\/quote\]/i",
			"/(?i)\[img\](http|https|ftp|irc|ed2k|gopher|telnet)?(\:\/\/)?([^\<\>[:space:]]+)\[\/img\]/i",  
			"/(?i)\[img\=(http|https|ftp|irc|ed2k|gopher|telnet)?(\:\/\/)?([^\<\>[:space:]]+)\]/i", 
			"/(?i)(\[url\])(http|https|ftp|irc|ed2k|gopher|telnet)(\:\/\/)([^\<\>[:space:]]+?)(\[\/url\])/i",
			"/(?i)\[url\=(http|https|ftp|irc|ed2k|gopher|telnet|gopher|telnet)(\:\/\/)([^\<\>[:space:]]+?)\](.+?)(\[\/url\])/i",
			"/(?i)\[code\](.*?)\[\/code\]/i",
	   ); 

	   $b = array("$1","$1","$1","","","","$2","$2","$2","$2>","","","","","","$1"); 
		$text = preg_replace($a, $b, $text);
		$text = special_codes(trim($text));
		if(strlen($text) < 15 && $title) return $title;
		else return $text;
}

function special_codes($text){;
		$text = str_replace('<br />', '', $text);
		$text = str_replace('\r', '', $text);
		$text = str_replace(array(0x0A,0x20,0x09,0x0D,0x00,0x0B), '', $text);
		$text = str_replace('\"', "'", $text);
		$text = str_replace("\'", "'", $text);
		$text = str_replace('"', "'", $text);
		if(substr($text, 0, 1) == ' ') $text = $text = substr($text, 1);
		return $text;
	}
	
function pagination($page, $registros, $max, $url, $border = true){
	$return = '<div class="paginas pag_recent" align="center"'.($border == false ? ' style="border:none;"' : '').'>';
	if(($page - 1) > 0) $return .= '<a id="btn" title="Anterior" href="'.$url.'page='.($page - 1).'">&#171;</a>';
	$total_pages = ceil($registros / $max);
	for ($i=1; $i<=$total_pages; $i++){
		if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
		else{
			if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" href="'.$url.'page='.$i.'">'.$i.'</a>';
		}
	}
	if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" href="'.$url.'page='.($page + 1).'">&#187;</a>';
	$return .= '</div>';
	return $return;
}

function ira($href){
	$dire = urldecode($href);
	header("Location: $dire");
	exit();
}
?>