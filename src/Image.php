<?php


namespace JM\ASCII;


use JM\ASCII\Interfaces\ImageInterface;

class Image implements ImageInterface
{
    /**
     * Image width
     *
     * @var int
     */
    protected $width = 0;

    /**
     * Image height
     *
     * @var int
     */
    protected $height = 0;

    /**
     * Image constructor.
     *
     * @param mixed $source The source of the image.
     */
    public function __construct($source)
    {

        if (is_resource($source)) {
            $this->resource = $source;
        } else {
            $this->resource = imagecreatefromstring(file_get_contents($source));
        }

        $this->width = imagesx($this->resource);
        $this->height = imagesy($this->resource);
    }

    /**
     * @return false|mixed|resource
     */
    public function getResource()
    {
        return $this->resource;
    }


    /**
     * Return the image width.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Return the image height.
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }


    public function save()
    {
        // TODO: Implement save() method.
    }

    public function clone($width, $height)
    {
        $percent = 0.50;
        $newwidth = $this->width * $percent;
        $newheight = $this->height * $percent;
        $newwidth = $width;
        $newheight = $height;


        $src = $this->resource;
        $dst = imagecreatetruecolor($newwidth, $newheight);

        $background = imagecolorallocate($dst, 0, 0, 0);
//
        ImageColorTransparent($dst, $background); // make the new temp image all transparent
        imagealphablending($dst, false); // turn off the alpha blending to keep the alpha channel

        imagecopyresized($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $this->width, $this->height);

        imagepng($dst, __DIR__.'/../out.png');
        return new Image($dst);
    }

}