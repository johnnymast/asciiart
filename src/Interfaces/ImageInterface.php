<?php


namespace JM\ASCII\Interfaces;


interface ImageInterface
{
    /**
     * ImageFactory constructor.
     *
     * @param mixed $source
     */
    public function __construct($source);

    /**
     * @return mixed
     */
    public function getResource();

    /**
     * @return int
     */
    public function getWidth();

    /**
     * @return int
     */
    public function getHeight();

    /**
     * Create a clone of the image.,
     *
     * @param int $width  Target width of the clone.
     * @param int $height Target Height of the clone.
     *
     * @return mixed
     */
    public function clone($width, $height);

    /**
     * @return mixed
     */
    public function save();
}