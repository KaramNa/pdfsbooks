<?php

namespace App\Collage;

use Closure;
use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Tzsk\Collage\Contracts\CollageGenerator;

class NineImage extends CollageGenerator
{
    /**
     * @var Image
     */
    protected $canvas;

    /**
     * @param Closure $closure
     *
     * @return \Intervention\Image\Image
     */
    public function create($closure = null)
    {
        $this->check(9);

        $height = $this->file->getHeight() - $this->file->getPadding();
        $width = $this->file->getWidth() - $this->file->getPadding();

        $this->canvas = ImageManagerStatic::canvas($width, $height);

        $this->makeSelection($closure);

        return ImageManagerStatic::canvas(
            $this->file->getWidth(),
            $this->file->getHeight(),
            $this->file->getColor()
        )->insert($this->canvas, 'center');
    }

    /**
     * Process all images.
     */
    public function grid()
    {
        list($width, $height) = $this->getSmallSize();

        $one = $this->images->get(0);
        $this->canvas->insert($one->fit($width, $height), 'top-left');

        $two = $this->images->get(1);
        $this->canvas->insert($two->fit($width, $height), 'top-center');

        $three = $this->images->get(2);
        $this->canvas->insert($three->fit($width, $height), 'top-right');

        $four = $this->images->get(3);
        $this->canvas->insert($four->fit($width, $height), 'center-left');

        $five = $this->images->get(4);
        $this->canvas->insert($five->fit($width, $height), 'center-center');

        $six = $this->images->get(5);
        $this->canvas->insert($six->fit($width, $height), 'center-right');

        $seven = $this->images->get(6);
        $this->canvas->insert($seven->fit($width, $height), 'bottom-left');

        $eight = $this->images->get(7);
        $this->canvas->insert($eight->fit($width, $height), 'bottom-center');

        $nine = $this->images->get(8);
        $this->canvas->insert($nine->fit($width, $height), 'bottom-right');
    }

    /**
     * @param Closure $closure
     */
    protected function makeSelection($closure = null)
    {
        if ($closure) {
            call_user_func($closure, $this);
        } else {
            $this->grid();
        }
    }

    /**
     * @return array
     */
    protected function getSmallSize()
    {
        $width = $this->file->getWidth() / 3 - ceil($this->file->getPadding() * 0.75);
        $height = $this->file->getHeight() / 3 - ceil($this->file->getPadding() * 0.75);

        return [$width, $height];
    }
}
