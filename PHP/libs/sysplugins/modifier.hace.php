<?php
/** 
 * Smarty plugin 
 * @package Smarty 
 * @subpackage plugins 
 * @author David077
 */ 


/** 
 * Smarty hace modifier plugin 
 * 
 * Type:     modifier<br> 
 * Name:     hace 
 * Purpose:  substring date in php 
 * @param string 
 * @return string 
 */ 
function smarty_modifier_hace($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return 'Hace unos instantes';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'a&ntilde;o',
                30 * 24 * 60 * 60       =>  'mes',
                24 * 60 * 60            =>  'd&iacute;a',
                60 * 60                 =>  'hora',
                60                      =>  'minuto',
                1                       =>  'segundo'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
			$end = $str == 'mes' ? 'es' : 's';
            return 'Hace '.$r . ' ' . $str . ($r > 1 ? $end : '');
        }
    }
}

/* vim: set expandtab: */

?>
