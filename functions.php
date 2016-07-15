<?php
    
function hex2rgb($hex)
{
    $hex = str_replace("#", "", $hex);
 
    if(strlen($hex) == 3)
    {
       $r = hexdec(substr($hex,0,1).substr($hex,0,1));
       $g = hexdec(substr($hex,1,1).substr($hex,1,1));
       $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    }
    else 
    {
       $r = hexdec(substr($hex,0,2));
       $g = hexdec(substr($hex,2,2));
       $b = hexdec(substr($hex,4,2));
    }
    
    $rgb = array('r' => $r, 'g' => $g, 'b' => $b);
 
    return $rgb; // returns an array with the rgb values
}

function format_name($string)
{
    return strtolower(str_replace(' ', '-', $string));
}

?>