<?php

namespace App\Collage;

use Closure;
use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Tzsk\Collage\Contracts\CollageGenerator;

class TwelveImage extends CollageGenerator
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
        $this->check(12);

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
        $this->canvas->insert($four->fit($width, $height), 'top-left', 0, intval($this->file->getHeight() / 4));

        $five = $this->images->get(4);
        $this->canvas->insert($five->fit($width, $height), 'top-center', 0, intval($this->file->getHeight() / 4));

        $six = $this->images->get(5);
        $this->canvas->insert($six->fit($width, $height), 'top-right', 0, intval($this->file->getHeight() / 4));

        $seven = $this->images->get(6);
        $this->canvas->insert($seven->fit($width, $height), 'top-left', 0, intval($this->file->getHeight() / 2));

        $eight = $this->images->get(7);
        $this->canvas->insert($eight->fit($width, $height), 'top-center', 0, intval($this->file->getHeight() / 2));

        $nine = $this->images->get(8);
        $this->canvas->insert($nine->fit($width, $height), 'top-right', 0, intval($this->file->getHeight() / 2));

        $ten = $this->images->get(9);
        $this->canvas->insert($ten->fit($width, $height), 'bottom-left');

        $eleven = $this->images->get(10);
        $this->canvas->insert($eleven->fit($width, $height), 'bottom-center');

        $twelve = $this->images->get(11);
        $this->canvas->insert($twelve->fit($width, $height), 'bottom-right');
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
        $height = $this->file->getHeight() / 4 - ceil($this->file->getPadding() * 0.75);

        return [$width, $height];
    }
}
