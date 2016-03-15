<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');

$key = base64_encode(str_ireplace(array('http://', 'www.'), '', $web['url']));

function url_content($url){
		
	   if(function_exists('curl_init')){
    		$useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.9) Gecko/2008052906 Firefox/3.0';
    		$ch = curl_init();  
    		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    		curl_setopt($ch,CURLOPT_URL,$url);
    		curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    		$result = curl_exec($ch);
    		curl_close($ch); 
        }
		
		if(!$result) $result = @file_get_contents($url);
		return $result;
	}

switch($action){
	case 'news':
		echo url_content('http://smline.net/SMnews/get_news.php?key='.$key);
	break;
	case 'secure':
		echo url_content('http://smline.net/SMnews/get_news.php?getype=1&key='.$key);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>