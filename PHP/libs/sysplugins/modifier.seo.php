<?php 
/** 
 * Smarty plugin 
 * @package Smarty 
 * @subpackage plugins 
 */ 


/** 
 * Smarty number_format modifier plugin 
 * 
 * Type:     modifier<br> 
 * Name:     number_format<br> 
 * Purpose:  returns a formatted number as of php number_format 
 * @author   ulyxes <zulisse at email dot it> 
 * @param string 
 * @param string 
 * @param string 
 * @param string 
 * @return string 
 */ 
function smarty_modifier_seo($string) 
{ 
	$espanol = array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
	$ingles = array('a','e','i','o','u','n','A','E','I','O','U','N');
	$string = str_ireplace($espanol,$ingles,$string);
	$string = trim($string);
	$string = trim(preg_replace('/[^ A-Za-z0-9_]/', '-', $string));
	$string = preg_replace('/[ \t\n\r]+/', '-', $string);
	$string = str_replace(' ', '-', $string);
	$string = preg_replace('/[ -]+/', '-', $string);
	return $string;
} 

/* vim: set expandtab: */ 

?> 