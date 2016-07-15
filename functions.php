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

function minify_hex($hex)
{
    if(

      ( substr($hex,0,1) === substr($hex,1,1) )

      &&

      ( substr($hex,2,1) === substr($hex,3,1) )

      &&

      ( substr($hex,4,1) === substr($hex,5,1) )
    )
    {
        $hex = substr($hex,0,1) . substr($hex,2,1)  . substr($hex,4,1);
    }

    return $hex;
}

function validate_hex($hex)
{
    return preg_match('/^[a-f0-9]{6}$/i', $hex);
}

?>