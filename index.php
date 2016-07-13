<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

function image2ascii($image)
{
    // return value
    $ret = '';

    $image = file_get_contents($image);
    $img = imagecreatefromstring($image);

    // get width and height
    $width = imagesx($img);
    $height = imagesy($img);

    for($h=0;$h<$height;$h++){
        for($w=0;$w<=$width;$w++){
            $rgb = @imagecolorat($img, $w, $h);
            $a = ($rgb >> 24) & 0xFF;
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $a = abs(($a / 127) - 1);
            if($w == $width){
                $ret .= '<br>';
            }else{
                $ret .= '<span style="color:rgba('.$r.','.$g.','.$b.','.$a.');">#</span>';
            }
        }
    }
    return $ret;
}


// an image to convert
$image = 'http://www.genvid.com/moonstruck/downloads/mk2-logo.gif';

// do the conversion
$ascii = image2ascii($image);

// and show the world
//echo $ascii;

