<?php


namespace JM\ASCII;


use JM\ASCII\Factories\ImageFactory;
use JM\ASCII\Interfaces\ImageInterface;

class Generator
{
    public static function output(ImageInterface $image)
    {
        $width = $image->getWidth();
        $height = $image->getHeight();
        $resource = $image->getResource();
        $ret = '';

        $normal = "\033[38;5;%sm";
        $bold = "\033[1;38;5;%sm";
        $reset = "\033[0m";
        $bg = 38;

        for ($h = 0; $h < $height; $h++) {
            for ($w = 0; $w <= $width; $w++) {
                $rgb = @imagecolorat($resource, $w, $h);
                $a = ($rgb >> 24) & 0xFF;
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $a = abs(($a / 127) - 1);

                $ret .=  "\x1b[${bg};2;${r};${g};${b}m#";
            }
            $ret .= PHP_EOL;
        }

        echo $ret;
    }

}