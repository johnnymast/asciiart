<?php


namespace JM\ASCII\Factories;

use JM\ASCII\Exceptions\NoSuchFileException;
use JM\ASCII\Interfaces\ImageInterface;
use JM\ASCII\Settings;
use JM\ASCII\Image;


class ImageFactory
{
    public static function create(Settings $settings): ImageInterface
    {
        if (!file_exists($settings->source_file)) {
            throw new NoSuchFileException("No such file or directory.");
        }

        $image = new Image($settings->source_file);

        if ($settings->target_width > 0 && $settings->target_height > 0) {
            $image = $image->clone(
              $settings->target_width,
              $settings->target_height
            );
        }

        return $image;
    }

}